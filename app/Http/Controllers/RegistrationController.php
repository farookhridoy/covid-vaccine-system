<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Models\VaccineCenter;
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

        DB::beginTransaction();
        try {

            $user = User::create([
                'name' => $request->name,
                'nid' => $request->nid,
                'email' => $request->email,
                'vaccine_center_id' => $vaccineCenter->id,
                'status' => 'not_scheduled',
            ]);

            DB::commit();

            return backWithSuccess('Vaccine Registration has been complete successfully!! We will send you an notification on your email before your vaccinate date');

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
        $pageTitle = 'Vaccine Status';

        $status = '';

        if (request()->has('nid')) {

            $user = User::with('vaccineCenter')->where('nid', request()->get('nid'))->first();

            if (!$user) {
                $status = 'User not registration yet. Please click this link to complete the registration <a href="' .
                    url('registration') . '">Registration</a>';
            } else {

                if ($user->scheduled_date) {
                    $currentDate = date('Y-m-d');

                    if ($user->scheduled_date <= $currentDate) {
                        $status = 'Status:: <strong>Vaccinated</strong>';
                    } else {
                        $status .= 'Status:: <strong>Scheduled</strong><br>';
                        $status .= 'Date:: <strong>' . date('d M Y', strtotime($user->scheduled_date)) . '</strong><br>';
                        $status .= 'Center:: <strong>' . $user->vaccineCenter->name . '</strong><br>';
                        $status .= 'Address:: <strong>' . $user->vaccineCenter->address ?? '' . '</strong>';
                    }
                } else {
                    $status = 'Status:: <strong>Not Scheduled</strong>';
                }

            }
        }

        return view('pages.search', compact('pageTitle', 'status'));
    }

}
