<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="<?php echo e(url('home')); ?>">
            <img src="<?php echo e(asset('argon')); ?>/img/brand/cvj.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="<?php echo e(asset('argon')); ?>/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse w3-animate-left" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="<?php echo e(url('home')); ?>">
                            <img src="<?php echo e(asset('argon')); ?>/img/brand/blue.png">
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
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('home')); ?>">
                        <i class="ni ni-tv-2 text-primary"></i> <?php echo e(__('Dashboard')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(url('suppliers')); ?>" class="nav-link">
                        <i class="ni ni-archive-2 text-primary"></i>
                        Suppliers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="" aria-expanded="false" aria-controls="">
                        <i class="ni ni-collection text-red"></i>
                        <span class="nav-link-text">Manage Accounts</span>
                    </a>
                    <div class="collapse" id="navbar-dashboards" style>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(url('createUser')); ?>" class="nav-link">
                                        <i class="ni ni-bullet-list-67 text-blue"></i>Create User Account</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('createEmployee')); ?>" class="nav-link">
                                    <i class="ni ni-delivery-fast text-green"></i> Create Employee Account</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('accounts')); ?>" class="nav-link">
                                    <i class="ni ni-archive-2 text-purple"></i>Manage User Accounts</a>
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
            <!-- Divider -->
            
            <!-- Navigation -->
            
        </div>
    </div>
</nav>