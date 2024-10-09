<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('assets/images/logo.png')}}" class="logo" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link {{\Route::current()->getName()=='/' ? 'active' : ''}}" aria-current="page"
                           href="{{URL::to('/')}}">Home</a>
                        <a class="nav-link {{\Route::current()->getName()=='registration' ? 'active' : ''}}"
                           href="{{route('registration')}}">Registration</a>
                        <a class="nav-link {{\Route::current()->getName()=='vaccine.status' ? 'active' : ''}}"
                           href="{{route('vaccine.status')}}">Vaccine Status</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
