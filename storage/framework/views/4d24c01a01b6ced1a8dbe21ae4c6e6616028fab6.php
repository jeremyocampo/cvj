<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(config('app.name', 'CVJ')); ?></title>
    <link href="<?php echo e(asset('argon')); ?>/img/brand/favicon.png" rel="icon" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="<?php echo e(asset('argon')); ?>/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="<?php echo e(asset('argon')); ?>/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo e(asset('argon')); ?>/css/argon.css?v=1.0.0" rel="stylesheet">

    <?php echo $__env->yieldContent('css'); ?>

</head>
    <body class="<?php echo e($class ?? ''); ?>">
        <?php echo $__env->make('supplier.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="main-content">
            <nav class="navbar navbar-top navbar-expand-md">
                <div class="container-fluid">
                    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="<?php echo e(url('home')); ?>">Dashboard</a>
                    <ul class="navbar-nav align-items-center ml-auto pull-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="<?php echo e(asset('argon')); ?>/img/theme/team-1-800x800.jpg">
                                    </span>
                                    <div class="text-white media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold"><?php echo e(auth()->user()->name); ?></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <script src="<?php echo e(asset('argon')); ?>/vendor/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo e(asset('argon')); ?>/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        <?php echo $__env->yieldContent('js'); ?>
        
        <!-- Argon JS -->
        <script src="<?php echo e(asset('argon')); ?>/js/argon.js?v=1.0.0"></script>
    </body>
</html>