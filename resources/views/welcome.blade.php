@extends('layouts.app')
@section('content')
    <section class="hero">
        <div class="container">
            <div class="hero-wrapper row mt-20">
                <div class="col-md-6 hero-main-single">
                    <div class="hero-single-card">
                        <a href="{{route('registration')}}">
                            <p><i class="fa-regular fa-circle-check"></i><strong>Vaccine Registration</strong></p>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 hero-main-single">
                    <div class="hero-single-card">
                        <a href="{{route('vaccine.status')}}">
                            <p><i class="fa-regular fas fa-search"></i><strong>Vaccine Status</strong></p>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
