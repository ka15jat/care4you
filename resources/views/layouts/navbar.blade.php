<nav class="navbar navbar-expand-lg navbar-light" style="background-color:var(--navBg);">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container-fluid ">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Residents
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                        style="background-color:var(--lightblue);">
                        <li><a class="dropdown-item" href="{{ route('residentForm') }}">Create Resident</a></li>
                        <li><a class="dropdown-item" href="{{ route('residentEdit') }}">View Resident</a></li>
                        <li><a class="dropdown-item" href="{{ route('sessionForm') }}">Session Form</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('staffView') }}">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('training') }}">Training</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reportIncident') }}">Report Incident</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('support') }}">Support</a>
                </li>
            </ul>
            <a class="btn btn-danger" type="submit" href='{{ route('logout') }}'>Logout</a>
        </div>
    </div>
</nav>
