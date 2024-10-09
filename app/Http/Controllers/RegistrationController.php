<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Models\VaccineCenter;
use App\Notifications\VaccineScheduleNotification;
use App\Services\RegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registration()
    {
        $pageTitle = 'Registration';
        $vaccineCenters = VaccineCenter::all();

        return view('pages.registration', compact('vaccineCenters', 'pageTitle'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request)
    {
        //Check vaccine center
        $vaccineCenter = VaccineCenter::find($request->vaccine_center_id);

        if (isset($vaccineCenter)) {
            $getScheduleDate = RegistrationService::GetScheduledDate($vaccineCenter);
        }

        DB::beginTransaction();
        try {

            $user = User::create([
                'name' => $request->name,
                'nid' => $request->nid,
                'email' => $request->email,
                'vaccine_center_id' => $vaccineCenter->id,
                'scheduled_date' => $getScheduleDate,
                'status' => 'scheduled',
            ]);

            //Send mail notification to the user

            //$user->notify(new VaccineScheduleNotification($user));

            DB::commit();

            return backWithSuccess('Vaccine Registration has been complete successfully!! Check your email for schedule date');
        } catch (\Exception $e) {
            DB::rollBack();
            return backWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function vaccineStatus()
    {
        $pageTitle = 'Registration';

        $status = '';

        if (request()->has('nid')) {
            $nidNo = request()->get('nid');
            $user = User::where('nid', $nidNo)->first();

            if (!$user) {
                $status = 'User Not Registration yet. Please click this link to complete the registration <a href="' .
                    url('registration') . '">Registration</a>';
            } else {
                $status = 'Status:: <strong>Not Scheduled</strong>';
                if ($user->scheduled_date) {
                    $currentDate = date('Y-m-d');

                    if ($user->scheduled_date < $currentDate) {
                        $status = 'Status:: <strong>Vaccinated</strong>';
                    } else {
                        $status = 'Status:: <strong>Scheduled</strong>';
                    }
                }
            }
        }

        return view('pages.search', compact('pageTitle', 'status'));
    }

}
