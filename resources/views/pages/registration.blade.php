@extends('layouts.app')
@section('content')
    <section class="reg-form-sec">
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Registration Form</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('registration.store') }}">
                                @csrf
                                <div class="form-group mt-2">
                                    <label for="name">Name <strong class="text-danger">*</strong></label>
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        placeholder="Enter your name"
                                        required
                                    />
                                </div>

                                <div class="form-group mt-2">
                                    <label for="email">Email <strong class="text-danger">*</strong></label>
                                    <input
                                        name="email"
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        placeholder="Enter Email"
                                        required
                                    />
                                </div>
                                <div class="form-group mt-2">
                                    <label for="nid">Nid No <strong class="text-danger">*</strong></label>
                                    <input
                                        name="nid"
                                        type="text"
                                        class="form-control"
                                        id="nid"
                                        placeholder="Enter your NID no"
                                        required
                                    />
                                </div>
                                <div class="form-group mt-2">
                                    <label for="vaccine_center_id">Select Center</label>
                                    <select name="vaccine_center_id" id="vaccine_center_id"
                                            class="form-control select2">
                                        @foreach($vaccineCenters as $center)
                                            <option value="{{ $center->id }}">{{ $center->name }}
                                                (Capacity: {{ $center->capacity }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-block float-end"
                                    >
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
