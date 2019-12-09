<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'CVJ Events Management')); ?></title>
        <!-- Favicon -->
        <link href="<?php echo e(asset('argon')); ?>/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <script
                src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous"></script>
        <!-- Icons -->

        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo e(asset('argon/vendor/nucleo/css/nucleo.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('argon')); ?>/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="<?php echo e(asset('argon')); ?>/css/argon.css?v=1.0.0" rel="stylesheet">
        <script type="text/javascript">
            function Pager(tableName, itemsPerPage) {
                this.tableName = tableName;
                this.itemsPerPage = itemsPerPage;
                this.currentPage = 1;
                this.pages = 0;
                this.inited = false;
                this.showRecords = function(from, to) {
                    var rows = document.getElementById(tableName).rows;
                    // i starts from 1 to skip table header row
                    for (var i = 1; i < rows.length; i++) {
                        if (i < from || i > to)
                            rows[i].style.display = 'none';
                        else
                            rows[i].style.display = '';
                    }
                }
                this.showPage = function(pageNumber) {
                    if (!this.inited) {
                        alert("not inited");
                        return;
                    }
                    var oldPageAnchor = document.getElementById('pg' + this.currentPage);
                    oldPageAnchor.className = 'pg-normal';
                    this.currentPage = pageNumber;
                    var newPageAnchor = document.getElementById('pg' + this.currentPage);
                    newPageAnchor.className = 'pg-selected';
                    var from = (pageNumber - 1) * itemsPerPage + 1;
                    var to = from + itemsPerPage - 1;
                    this.showRecords(from, to);
                }
                this.prev = function() {
                    if (this.currentPage > 1)
                        this.showPage(this.currentPage - 1);
                }
                this.next = function() {
                    if (this.currentPage < this.pages) {
                        this.showPage(this.currentPage + 1);
                    }
                }
                this.init = function() {
                    var rows = document.getElementById(tableName).rows;
                    var records = (rows.length - 1);
                    this.pages = Math.ceil(records / itemsPerPage);
                    this.inited = true;
                }
                this.showPageNav = function(pagerName, positionId) {
                    if (!this.inited) {
                        alert("not inited");
                        return;
                    }
                    var element = document.getElementById(positionId);
                    var pagerHtml = '<span class="btn btn-sm btn-primary" style="float:left; background-color:#DCDCDC; font-size:90%; color:gray" onclick="' + pagerName + '.prev();" class=""><b>&nbsp; « Prev &nbsp;</b></span> ';
                    for (var page = 1; page <= this.pages; page++)
                        pagerHtml += '<span style="font-size:90%;" id="pg' + page + '" class="pg-normal" onclick="' + pagerName + ' .showPage(' + page + ');"> <b>&emsp;' + page + '</b></span> ';
                    pagerHtml += '<span class="btn btn-sm btn-primary" style="float:right; background-color:#DCDCDC; font-size:90%; color:gray" onclick="' + pagerName + '.next();" class=""><b>&nbsp; Next » &nbsp;</b></span>';
                    element.innerHTML = pagerHtml;
                }
            }
    </script>
    <script>
            function searchTable() {
                // Declare variables 
                var input, filter, table, tr, td, i;
                input = document.getElementById("myInput");

                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    // tr = table.getElementsByClassName("mamamo");
                    th = table.getElementsByTagName("th");
        
                    // Loop through all table rows, and hide those who don't match the search query
                    for (i = 1; i < tr.length; i++) {
                        tr[i].style.display = "none";
                        for (var j = 0; j <= th.length; j++) {
                            td = tr[i].getElementsByTagName("td")[j];
                            if (td) {
                                if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1) {
                                    tr[i].style.display = "";
                                    break;
                                }
                            }
                        }
                    }
                    //document.getElementById("myInput").value = "";
                    
            }
        </script>
        
    </head>
    <body class="<?php echo e($class ?? ''); ?>">
        <?php if(auth()->guard()->check()): ?>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
            
            <?php echo $__env->make('layouts.navbars.adminSidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        
        <div class="main-content">
            <?php echo $__env->make('layouts.navbars.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <?php if(auth()->guard()->guest()): ?>
            <?php echo $__env->make('layouts.footers.guest', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        <script src="<?php echo e(asset('argon')); ?>/vendor/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo e(asset('argon')); ?>/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        <?php echo $__env->yieldPushContent('js'); ?>
        
        <!-- Argon JS -->
        <script src="<?php echo e(asset('argon')); ?>/js/argon.js?v=1.0.0"></script>
    </body>
</html>