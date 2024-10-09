@extends('layouts.app')
@section('content')
    <section class="reg-form-sec">
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Check Your Current Registration Status</h4>
                        </div>
                        @if(request()->has('nid'))
                            <div class="card-body">
                                {!! $status !!}
                            </div>
                        @endif
                        <div class="card-body">
                            <form method="get" action="{{ route('vaccine.status') }}">

                                <div class="form-group mt-2">
                                    <label for="nid">Enter Your Nid No <strong class="text-danger">*</strong></label>
                                    <input
                                        name="nid"
                                        type="text"
                                        class="form-control"
                                        id="nid"
                                        placeholder="Enter your NID no"
                                        required
                                        min="10"
                                        value="{{request()->has('nid')?request()->get('nid'):''}}"
                                    />
                                </div>

                                <div class="form-group mt-3">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-block float-end"
                                    >
                                        Search
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
