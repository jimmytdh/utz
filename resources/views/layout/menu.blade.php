<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand navbar-web" href="#"><font class="text-warning">Ultrasound</font> Information and Scheduling System</a>
        <a class="navbar-brand navbar-mobile" href="#">UTZPISS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item {{ request()->is('patients') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/patients') }}"><i class="fa fa-users"></i> Patients</a>
                </li>
                <li class="nav-item {{ request()->is('schedule') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/schedule') }}"><i class="fa fa-calendar"></i> Schedule</a>
                </li>

                <li class="nav-item dropdown {{ request()->is('settings/*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fa fa-gears"></i> Settings
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item {{ request()->is('settings/doctors') ? 'active' : '' }}" href="{{ url('/settings/doctors') }}"><i class="fa fa-user-md mr-1"></i> Doctors</a>
                        @if(Session::get('level')=='admin')
                        <a class="dropdown-item {{ request()->is('settings/users') ? 'active' : '' }}" href="{{ url('/settings/users') }}"><i class="fa fa-users mr-1"></i> Users</a>
                        <a class="dropdown-item {{ request()->is('settings/info') ? 'active' : '' }}" href="{{ url('/settings/info') }}"><i class="fa fa-info-circle mr-1"></i> System Information</a>
                        @endif
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>