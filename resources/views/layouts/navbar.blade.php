<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@php
    $greet = '';
    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date('H');
    /* Set the $timezone variable to become the current timezone */
    $timezone = date('e');
    /* If the time is less than 1200 hours, show good morning */
    if ($time < '12') {
        $greet = 'Good morning';
    } /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */ elseif ($time >= '12' && $time < '17') {
        $greet = 'Good afternoon';
    } /* Should the time be between or equal to 1700 and 1900 hours, show good evening */ elseif ($time >= '17' && $time < '19') {
        $greet = 'Good evening';
    } /* Finally, show good night if the time is greater than or equal to 1900 hours */ elseif ($time >= '19') {
        $greet = 'Good night';
    }
@endphp
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <div>
        <h6 class="top-time"> Welcome back, {{ Auth::user()->name }} </h6>
        <span style="font-weight: 400; font-size: 16.8194px; line-height: 23px;color: #FFFFFF;">{{ $greet }},
            good
            luck! </span>
    </div>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown">
            {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex"> --}}
            <a class="user-panel mt-3 pb-3 mb-3 d-flex nav-link" data-toggle="dropdown" href="#">
                <div class="image">
                    <img src="{{ asset('viewly_assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                {{-- <span class="dropdown-item dropdown-header">{{ Auth::user()->name }} - Role # {{ Auth::user()->roles[0]->name }}</span> --}}
                <span class="dropdown-item dropdown-header">{{ Auth::user()->name }}</span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center" class="dropdown-item" href="{{ url('view-profile') }}">
                    <i class="fas fa-user-cog mr-2"></i>
                    Settings
                </a>
                <a href="#" class="dropdown-item text-center" class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt mr-2"></i>
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                {{-- <div class="dropdown-divider"></div> --}}
            </div>
            {{-- </div> --}}
        </li>
    </ul>
</nav>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<!-- /.navbar -->
