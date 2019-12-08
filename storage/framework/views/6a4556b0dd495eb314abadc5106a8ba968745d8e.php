<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand pt-0" href="<?php echo e(url('home')); ?>">
            <img src="<?php echo e(asset('argon')); ?>/img/brand/cvj.png" class="navbar-brand-img img-responsive" alt="..." height="150%" width="50%">
        </a>

        <!-- User -->
        
        <!-- Collapse -->
        <div class="collapse navbar-collapse w3-animate-left" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="<?php echo e(url('home')); ?>">
                            <img src="<?php echo e(asset('argon')); ?>/img/brand/cvj.png">
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
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="<?php echo e(__('Search')); ?>" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <?php if(auth()->user()->userType == 1): ?>
                <!-- admin Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('home')); ?>">
                            <i class="ni ni-tv-2 text-primary"></i> <?php echo e(__('Dashboard')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('events')); ?>">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> <?php echo e(__('Events')); ?>

                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                            <i class="ni ni-collection text-red"></i>
                            <span class="nav-link-text">Manage Users</span>
                        </a>
                        <div class="collapse" id="navbar-dashboards" style>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(url('users')); ?>" class="nav-link">
                                            <i class="ni ni-bullet-list-67 text-blue"></i>View Users</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(url('users/create')); ?>" class="nav-link">
                                        <i class="ni ni-delivery-fast text-green"></i>Create Users</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power text-info"></i>
                            <?php echo e(__('Logout')); ?>

                        </a>
                    </li>
                </ul>
            <?php endif; ?>
            <?php if(auth()->user()->userType == 2): ?>
                    <!-- inventory Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(url('home')); ?>">
                                <i class="ni ni-tv-2 text-primary"></i> <?php echo e(__('Dashboard')); ?>

                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                                <i class="ni ni-collection text-red"></i>
                                <span class="nav-link-text">Manage Inventory</span>
                            </a>
                            <div class="collapse" id="navbar-dashboards" style>
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('inventory')); ?>" class="nav-link">
                                                <i class="ni ni-bullet-list-67 text-blue"></i>View Inventory</a>
                                    </li>
                                    <li class="nav-item">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#dishes" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                                            <i class="ni ni-collection text-red"></i>
                                            <span class="nav-link-text">Manage Dishes</span>
                                        </a>
                                        <div class="collapse" id="dishes" style>
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="<?php echo e(url('dishes')); ?>" class="nav-link">
                                                        <i class="ni ni-bullet-list-67 text-blue"></i>View Dishes</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?php echo e(url('disabled-dishes')); ?>" class="nav-link">
                                                        <i class="ni ni-archive-2 text-purple"></i>Disabled Dishes</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('deploy')); ?>" class="nav-link">
                                            <i class="ni ni-delivery-fast text-green"></i> Deploy Inventory</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('returnInventory')); ?>" class="nav-link">
                                            <i class="ni ni-archive-2 text-purple"></i>Inventory Return</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('outsource')); ?>" class="nav-link">
                                            <i class="ni ni-calendar-grid-58 text-yellow"></i>Outsource Items</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('archive')); ?>" class="nav-link">
                                            <i class="ni ni-archive-2 text-red"></i> Archive</a>
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
                                            <a href="<?php echo e(url('expenseReports')); ?>" class="nav-link">
                                                    <i class="ni ni-bullet-list-67 text-blue"></i>View Event Expense Reports</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('quotationReports')); ?>" class="nav-link">
                                                <i class="ni ni-bullet-list-67 text-blue"></i>View Event Qutation Reports</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(url('inventory/create')); ?>">
                                <i class="ni ni-collection text-red"></i> <?php echo e(__('Add Inventory')); ?>

                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ni ni-button-power text-info"></i>
                                <?php echo e(__('Logout')); ?>

                            </a>
                        </li>
                    </ul>
            <?php endif; ?>
            <?php if(auth()->user()->userType == 3): ?>
                <!-- eventmanager Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('home')); ?>">
                            <i class="ni ni-tv-2 text-primary"></i> <?php echo e(__('Dashboard')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('confirmevents')); ?>">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> <?php echo e(__('Events')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('bookevent')); ?>">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> <?php echo e(__('Book Event')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('event_budgets')); ?>">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> <?php echo e(__('Event Budgets')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power text-info"></i>
                            <?php echo e(__('Logout')); ?>

                        </a>
                    </li>
                </ul>
            <?php endif; ?>
            <?php if(auth()->user()->userType == 4): ?>
                <!-- eventmanager Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('home')); ?>">
                            <i class="ni ni-tv-2 text-primary"></i> <?php echo e(__('Dashboard')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('events')); ?>">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> <?php echo e(__('Events')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('bookevent')); ?>">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> <?php echo e(__('Book Event')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power text-info"></i>
                            <?php echo e(__('Logout')); ?>

                        </a>
                    </li>
                </ul>
            <?php endif; ?>
            <?php if(auth()->user()->userType == 5): ?>
                 <!-- client Navigation -->
                 <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('home')); ?>">
                            <i class="ni ni-tv-2 text-primary"></i> <?php echo e(__('Dashboard')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('bookevent')); ?>">
                            <i class="ni ni-calendar-grid-58 text-yellow"></i> <?php echo e(__('Create Booking')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-dashboards1" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                            <i class="ni ni-collection text-red"></i>
                            <span class="nav-link-text">Manage Clients</span>
                        </a>
                        <div class="collapse" id="navbar-dashboards1" style>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(url('client')); ?>" class="nav-link">
                                            <i class="ni ni-bullet-list-67 text-blue"></i>View List of Clients</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(url('client/create')); ?>" class="nav-link">
                                        <i class="ni ni-single-02 text-blue"></i>Create Client Reference</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo e(url('list_events')); ?>">
                             <i class="ni ni-calendar-grid-58 text-green"></i> List Events
                         </a>
                     </li>
                     <li class="nav-item">
                            <a class="nav-link" href="#manpower" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                                    <i class="ni ni-collection text-red"></i>
                                    <span class="nav-link-text">Manpower</span>
                                </a>
                                <div class="collapse" id="manpower" style>
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('schedules')); ?>" class="nav-link">
                                                <i class="ni ni-bullet-list-67 text-blue"></i>Schedule List</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('manpowers')); ?>" class="nav-link">
                                                <i class="ni ni-bullet-list-67 text-blue"></i>Manpower List</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('disabled-manpower')); ?>" class="nav-link">
                                                <i class="ni ni-archive-2 text-purple"></i>Disabled Manpower</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                    <li class="nav-item">
                        <a href="http://cvj.test:3000/logout" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power text-info"></i>
                            <?php echo e(__('Logout')); ?>

                        </a>
                    </li>
                </ul>

            <?php endif; ?>

            <!-- Divider -->
            
            <!-- Navigation -->

        </div>
    </div>
</nav>
