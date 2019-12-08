    <nav class="navbar navbar-top navbar-expand-md">
        <div class="container-fluid">
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ url('home') }}">Dashboard</a>
            <ul class="navbar-nav align-items-center ml-auto pull-right">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img class="mb-0" alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                            </span>
                            <div class="text-white media-body">
                                <span class="text-sm font-weight-bold">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>