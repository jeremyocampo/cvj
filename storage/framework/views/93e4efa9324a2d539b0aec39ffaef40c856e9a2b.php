<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.headers.inventoryCard1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid mt--7">
            
            <div class="col-xl-12 mb-5">
                <div class="card shadow " >
                    <div class="card-header ">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="row">
                                <div class="col-xs-5">
                                    <h1 class="mb-0">Current Inventory</h1>
                                </div>
                                <div class="col-xs-2">
                                        &nbsp;&nbsp;
                                </div>
                                <div class="col-xs-4">
                                    <a href="inventory/create" class="btn btn-sm btn-primary"> + Add Item</a>
                                </div>
                                </div>
                            </div>
                            <div class="col text-right"> </div>
                            <div class="col text-left">
                                <div class="col-xs-5"> 
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(session()->has('success')): ?>
                                
                                    <br>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                        <?php echo e(session()->get('success'), false); ?><br>
                                    </div>
                                <?php endif; ?>
                                <?php if(session()->has('deleted')): ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                        <?php echo e(session()->get('deleted'), false); ?><br>
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
                                    <th >Item name</th>
                                    
                                    <th >Category</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th >Quantity</th>
                                    <th >Threshold</th>
                                    <th >Last Modified (YY-MM-DD)</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  

                                ?>
                                <?php $__currentLoopData = $joinedInventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($i->status > 0): ?>
                                <tr>
                                    
                                    <td>
                                        <a href="<?php echo e(url('inventory/'.$i->inventory_id), false); ?>" class="dropdown-item">
                                            <?php echo e($i->inventory_name, false); ?>

                                        </a>
                                    </td>    
                                    <td><?php echo e($i->category_name, false); ?></td>
                                    <td><?php echo e($i->color_name, false); ?></td>
                                    <td> <?php echo e($i->size, false); ?></td>
                                    <td><?php echo e($i->quantity, false); ?></td>
                                    <td><?php echo e($i->threshold, false); ?></td>
                                    
                                   
                                    <td><?php echo e($i->last_modified, false); ?></td>
                                    <td class="popup">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                <div class=" dropdown-header noti-title">
                                                    <h6 class="text-overflow m-0"><?php echo e(__('Please Select an Action!'), false); ?></h6>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="<?php echo e(url('inventory/'.$i->inventory_id), false); ?>" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span><?php echo e(__('View Item Details'), false); ?></span>
                                                </a>

                                                <a href="<?php echo e(url('inventory/'.$i->inventory_id.'/edit'), false); ?>" class="dropdown-item">
                                                    <i class="ni ni-fat-add"></i>
                                                    <span><?php echo e(__('Replenish Item'), false); ?></span>
                                                </a>
                                                
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-<?php echo e($i->inventory_id, false); ?>').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span><?php echo e(__('Remove from Inventory'), false); ?></span>
                                                    <?php echo Form::open(['action' => ['InventoryController@destroy', $i->inventory_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->inventory_id]); ?>

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
                    <!--pagination-->
                    
                    <!--pagination-->

                    </div>


                    


                    <div class="col-xl-12 mb-5">
                        <div class="card shadow " >
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h1 class="mb-0">Critical Inventory</h1> &nbsp;&nbsp;
                                            </div>
                                            
                                        </div>
                                    </div>
                                   
                                    <div class="col text-left">
                                       
                                            <div class="col-xs-5">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                    
                            <div class="card-body">
        
                            
        
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                
                                <table class="table table-bordered align-items-center table-flush mb-4" id="myTable1">
                                    <thead class="thead-light">
                                        <tr>
                                            <th >Item name</th>
                                            
                                            
                                            <th >Quantity</th>
                                            <th >Threshold</th>
                                            
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $criticalInventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($b->status > 0): ?>
                                        <tr>
                                            <td scope="col"><?php echo e($b->inventory_name, false); ?></td>
                                            
                                            <td scope="col"><?php echo e($b->quantity, false); ?></td>
                                            <td scope="col"><?php echo e($b->threshold, false); ?></td>
                                            
                                            
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
                            <!--pagination-->
                            
                            <!--pagination-->
        
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
    
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href=". /resources/DataTables/datatables.min.css"/>
    <script type="text/javascript" src=". /resources/DataTables/datatables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#myTable1').DataTable();
            // $('#myTable2').DataTable();
        } );
    </script>
    
    
    

    

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>