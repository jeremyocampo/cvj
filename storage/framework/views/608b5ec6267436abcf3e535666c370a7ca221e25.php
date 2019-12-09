<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.headers.inventoryCard', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid mt--7">
        
        <div class="col-xl-12 mb-5">
            <div class="card shadow " >
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-xs-5">
                                    <h1 class="mb-0">Manpower List</h1>
                                </div>
                                <div class="col-xs-2">
                                    &nbsp;&nbsp;
                                </div>
                                <div class="col-xs-4">
                                    <a href="manpowers/create" class="btn btn-sm btn-primary"> + Add Item</a>
                                </div>
                            </div>
                        </div>
                        <div class="col text-right"> </div>
                        <div class="col text-left">
                            <div class="col-xs-5">
                                <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(session()->has('success')): ?>
                                <br>
                                <div class="alert alert-success" role="alert">
                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                    <?php echo e(session()->get('success')); ?><br>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->has('deleted')): ?>
                                <br>
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                    <?php echo e(session()->get('deleted')); ?><br>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
                <div class="card-body">



                    <div class="table-responsive mb-3">
                        <!-- Projects table -->

                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                            <thead class="thead-light">
                            <tr>

                                <th >Shift Name</th>
                                <th >Name</th>
                                
                                <th >Employee Type</th>
                                <th>Email</th>
                                <th>Agency</th>
                                <th >Contact No</th>
                                <th >Address</th>
                                <th >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $manpowers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manpower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($manpower->schedule->shift_name); ?></td>
                                    <td>
                                        <?php echo e($manpower->employee_ln . ", " . $manpower->employee_fn); ?>

                                    </td>
                                    <td>
                                        <?php echo e($manpower->employee_type); ?>

                                    </td>
                                    <td><?php echo e($manpower->email); ?></td>
                                    <td> <?php echo e($manpower->agency->agency_name); ?></td>
                                    <td><?php echo e($manpower->contact_no); ?></td>
                                    <td><?php echo e($manpower->address); ?></td>
                                    <td class="popup">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                <div class=" dropdown-header noti-title">
                                                    <h6 class="text-overflow m-0"><?php echo e(__('Please Select an Action!')); ?></h6>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="<?php echo e(url('manpowers/'.$manpower->id)); ?>" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span><?php echo e(__('View Manpower Details')); ?></span>
                                                </a>
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-<?php echo e($manpower->id); ?>').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span><?php echo e(__('Disable Manpower')); ?></span>
                                                    <?php echo Form::open(['action' => ['ManpowerController@destroy', $manpower->id], 'method' => 'POST', 'id' => 'delete-form-'.$manpower->id]); ?>

                                                    <?php echo e(Form::hidden('_method','DELETE')); ?>

                                                    <?php echo Form::close(); ?>

                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center"></div>
                    <script type="text/javascript">
                        <!--
                        var pager = new Pager('myTable', 5);
                        pager.init();
                        pager.showPageNav('pager', 'pageNavPosition');
                        pager.showPage(1);
                    </script>
                </div>
            </div>
            <!--pagination-->

            <!--pagination-->

        </div>


        
        
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');

        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            document.location.reload(true);

        }
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>