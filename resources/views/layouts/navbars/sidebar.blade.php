<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ url('home') }}">
            <img src="{{ asset('argon') }}/img/brand/cvj.png" class="navbar-brand-img img-responsive" alt="..." height="150%" width="50%">
        </a>

        <!-- User -->
        {{-- <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
             <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul> --}}
        <!-- Collapse -->
        <div class="collapse navbar-collapse w3-animate-left" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ url('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/cvj.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            @if(auth()->user()->userType == 1)
                <!-- admin Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('home') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('events') }}">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> {{ __('Events') }}
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ url('inventory') }}">
                            <i class="ni ni-collection text-red"></i> {{ __('Inventory Management') }}
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                            <i class="ni ni-collection text-red"></i>
                            <span class="nav-link-text">Manage Users</span>
                        </a>
                        <div class="collapse" id="navbar-dashboards" style>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ url('users') }}" class="nav-link">
                                            <i class="ni ni-bullet-list-67 text-blue"></i>View Users</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('users/create') }}" class="nav-link">
                                        <i class="ni ni-delivery-fast text-green"></i>Create Users</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power text-info"></i>
                            {{__('Logout') }}
                        </a>
                    </li>
                </ul>
            @endif
            @if(auth()->user()->userType == 2)
                    <!-- inventory Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('home') }}">
                                <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('events') }}">
                                <i class="ni ni-calendar-grid-58 text-yellow"></i> {{ __('Events') }}
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                                <i class="ni ni-collection text-red"></i>
                                <span class="nav-link-text">Manage Inventory</span>
                            </a>
                            <div class="collapse" id="navbar-dashboards" style>
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('inventory') }}" class="nav-link">
                                                <i class="ni ni-bullet-list-67 text-blue"></i>View Inventory</a>
                                    </li>
                                    <li class="nav-item">
                                    <li class="nav-item">
                                        <a href="{{ url('food') }}" class="nav-link">
                                        <i class="ni ni-archive-2 text-purple"></i>View Food Inventory</a>
                                    </li>
                                        <a href="{{ url('deploy') }}" class="nav-link">
                                            <i class="ni ni-delivery-fast text-green"></i> Deploy Inventory</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('returnInventory') }}" class="nav-link">
                                            <i class="ni ni-archive-2 text-purple"></i>Inventory Return</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('outsource') }}" class="nav-link">
                                            <i class="ni ni-calendar-grid-58 text-yellow"></i>Outsource Items</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('archive') }}" class="nav-link">
                                            <i class="ni ni-archive-2 text-red"></i> Archive</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#manpower" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                                <i class="ni ni-collection text-red"></i>
                                <span class="nav-link-text">Manpower</span>
                            </a>
                            <div class="collapse" id="manpower" style>
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('schedules') }}" class="nav-link">
                                            <i class="ni ni-bullet-list-67 text-blue"></i>Schedule List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('manpowers') }}" class="nav-link">
                                            <i class="ni ni-bullet-list-67 text-blue"></i>Manpower List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('disabled-manpower') }}" class="nav-link">
                                            <i class="ni ni-archive-2 text-purple"></i>Disabled Manpower</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#dishes" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                                <i class="ni ni-collection text-red"></i>
                                <span class="nav-link-text">Manage Dishes</span>
                            </a>
                            <div class="collapse" id="dishes" style>
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('dishes') }}" class="nav-link">
                                            <i class="ni ni-bullet-list-67 text-blue"></i>View Dishes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('disabled-dishes') }}" class="nav-link">
                                            <i class="ni ni-archive-2 text-purple"></i>Disabled Dishes</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                                <a class="nav-link" href="#navbar-dashboards1" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                                    <i class="ni ni-collection text-red"></i>
                                    <span class="nav-link-text">Manage Reports</span>
                                </a>
                                <div class="collapse" id="navbar-dashboards1" style>
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ url('expenseReports') }}" class="nav-link">
                                                    <i class="ni ni-bullet-list-67 text-blue"></i>View Event Expense Reports</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('quotationReports') }}" class="nav-link">
                                                <i class="ni ni-bullet-list-67 text-blue"></i>View Event Qutation Reports</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('inventory/create') }}">
                                <i class="ni ni-collection text-red"></i> {{ __('Add Inventory') }}
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ni ni-button-power text-info"></i>
                                {{__('Logout') }}
                            </a>
                        </li>
                    </ul>
            @endif
            @if(auth()->user()->userType == 3)
                <!-- eventmanager Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('home') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('confirmevents') }}">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> {{ __('Events') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('bookevent') }}">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> {{ __('Book Event') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('event_budgets') }}">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> {{ __('Event Budgets') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power text-info"></i>
                            {{__('Logout') }}
                        </a>
                    </li>
                </ul>
            @endif
            @if(auth()->user()->userType == 4)
                <!-- eventmanager Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('home') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('events') }}">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> {{ __('Events') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('bookevent') }}">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> {{ __('Book Event') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power text-info"></i>
                            {{__('Logout') }}
                        </a>
                    </li>
                </ul>
            @endif
            @if(auth()->user()->userType == 5)
                 <!-- client Navigation -->
                 <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('home') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('bookevent') }}">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> {{ __('Create Booking') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power text-info"></i>
                            {{__('Logout') }}
                        </a>
                    </li>
                </ul>

            @endif

            <!-- Divider -->
            {{-- <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Navbar Heading Text</h6> --}}
            <!-- Navigation -->

        </div>
    </div>
</nav>
