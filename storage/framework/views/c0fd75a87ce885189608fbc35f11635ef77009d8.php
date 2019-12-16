   


<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.headers.cards', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    
    <div class="container-fluid mt--7">
        <div class="row">
        </div>
        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Events Today</h3>
                            </div>
                            <div class="col text-right">
                            <a href="" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Venue</th>
                                    <th scope="col">Borrow Date/Time</th>
                                    <th scope="col">Return Date/Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($i->status > 0): ?>
                                <tr>
                                    <td><?php echo e($i->event_name, false); ?></td>
                                    <td><?php echo e($i->venue, false); ?></td>
                                    <td><?php echo e($i->event_start, false); ?></td>
                                    <td><?php echo e($i->event_end, false); ?></td>
                                    <td><?php echo e($i->status_name, false); ?> </td>
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
                                                <a href="<?php echo e(url('inventory/'.$i->event_name), false); ?>" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span><?php echo e(__('View Event Details'), false); ?></span>
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

        


        <div class="row mt-5">
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Upcoming Events</h3>
                                </div>
                                <div class="col text-right">
                                <a href="" class="btn btn-sm btn-primary">See all</a>
                                </div>
                            </div>
                        </div>
                        <div class="table table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Event Name</th>
                                        <th scope="col">Venue</th>
                                        <th scope="col">Borrow Date/Time</th>
                                        <th scope="col">Return Date/Time</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Jeremy's Birthday Bash</td>
                                        <td>CVJ Catering Ground Floor</td>
                                        <td>March 25, 2020</td>
                                        <td>March 25, 2020</td>
                                        <td>Processing</td>
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
                                                    <a href="<?php echo e(url('inventory/1'), false); ?>" class="dropdown-item">
                                                        <i class="ni ni-zoom-split-in"></i>
                                                        <span><?php echo e(__('View Event Details'), false); ?></span>
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
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
                                <h3 class="mb-0">Critical Items</h3>
                            </div>
                            <div class="col text-right">
                            <a href="<?php echo e(url("inventory"), false); ?>" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>