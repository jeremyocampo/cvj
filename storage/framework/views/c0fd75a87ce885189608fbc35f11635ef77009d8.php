<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.headers.cards', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <div class="container-fluid mt--7">
        <div class="row">
        </div>
        <div class="row mt-5">
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1>Events Today</h1> 
                            </div>
                            <div class="col text-right">
                                <b><h1><?php echo e(Carbon\Carbon::parse($currDate)->format('F j, Y '), false); ?></h1></b>\
                                
                            </div>
                        </div>
                    </div>
                    <div class="table table-responsive">
                        <!-- Projects table -->
                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Venue</th>
                                    <th scope="col">Event Date/Time</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $eventsToday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($i->status > 0): ?>
                                <tr>
                                    <td><?php echo e($i->event_name, false); ?></td>
                                    <td><?php echo e($i->venue, false); ?></td>
                                    <td><?php echo e($i->event_start, false); ?></td>
                                    
                                </tr>
                                
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        

        


        
                <div class="col-xl-6">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h1 class="mb-0">Upcoming Events</h1>
                                </div>
                                <div class="col text-right">
                                </div>
                            </div>
                        </div>
                        <div class="table table-responsive" >
                            <!-- Projects table -->
                            <table class="table table-bordered align-items-center table-flush mb-4" id="myTable1">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Event Name</th>
                                        <th scope="col">Venue</th>
                                        <th scope="col">Event Date/Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($i->status >= 3): ?>
                                    <tr>
                                        <td><?php echo e($i->event_name, false); ?></td>
                                        <td><?php echo e($i->venue, false); ?></td>
                                        <td><?php echo e($i->event_start, false); ?></td>
                                        
                                    </tr>
                                    
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>






        

        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Items Below Threshold</h3>
                            </div>
                            <div class="col text-right">
                            <a href="<?php echo e(url("inventory"), false); ?>" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table table-responsive">
                        <!-- Projects table -->
                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable2">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Threshold</th>
                                    <th scope="col">Quantity in Stock</th>
                                    <th scope="col">Price per Item</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $criticalInventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($b->status > 0): ?>
                                <tr>
                                    <td scope="col"><?php echo e($b->inventory_name, false); ?></td>
                                    <td scope="col"><?php echo e($b->threshold, false); ?></td>
                                    <td scope="col"><?php echo e($b->quantity, false); ?></td>
                                    <td scope="col"><?php echo e($b->price, false); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                <div class=" dropdown-header noti-title">
                                                    <h6 class="text-overflow m-0"><?php echo e(__('Please Select an Action!'), false); ?></h6>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="<?php echo e(url('inventory/'.$b->inventory_id), false); ?>" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span><?php echo e(__('View Event Details'), false); ?></span>
                                                </a>

                                                <a href="<?php echo e(url('inventory/'.$b->inventory_id.'/edit'), false); ?>" class="dropdown-item">
                                                    <i class="ni ni-fat-add"></i>
                                                    <span><?php echo e(__('Replenish Item'), false); ?></span>
                                                </a>
                                                
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-<?php echo e($b->inventory_id, false); ?>').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span><?php echo e(__('Remove from Inventory'), false); ?></span>
                                                    <?php echo Form::open(['action' => ['InventoryController@destroy', $b->inventory_id], 'method' => 'POST', 'id' => 'delete-form-'.$b->inventory_id]); ?>

                                                        <?php echo e(Form::hidden('_method','DELETE'), false); ?>

                                                    <?php echo Form::close(); ?>

                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        

        
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('argon'), false); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(asset('argon'), false); ?>/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href=". /resources/DataTables/datatables.min.css"/>
    <script type="text/javascript" src=". /resources/DataTables/datatables.min.js"></script>
    

    

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#myTable1').DataTable();
            $('#myTable2').DataTable();
        } );
    </script>

    <script type="text/javascript">
    var timestamp = '<?=time();?>';
    function updateTime(){
        $('#time').html(Date(timestamp));
        timestamp++;
    }
    
    $(function(){
        setInterval(updateTime, 1000);
    });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>