<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.headers.inventoryCard1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
            <a href="<?php echo e(url('inventory'), false); ?>" class="btn btn-secondary mb-5">Go to View Inventory</a>
            <a href="<?php echo e(url('deploy'), false); ?>" class="btn btn-secondary mb-5">Go to Deploy Inventory</a>
            <a href="<?php echo e(url('return'), false); ?>" class="btn btn-secondary mb-5">Go to Return Inventory</a>
				<div class="card shadow">
						<div class="card-header">
                            
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Unreported Mark as Lost/Damaged</h1>
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            
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
                            </div>
						</div>
						<div class="card-body">
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush" id="myTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Event Name</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Borrow Date/Time</th>
                                            
                                            <th scope="col">Event Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($i->status == 5): ?>
                                        <tr>
                                            <td><?php echo e($i->event_name, false); ?></td>
                                            <td><?php echo e($i->venue, false); ?></td>
                                            <td><?php echo e(Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a'), false); ?></td>
                                            
                                            <td><?php echo e($i->status_name, false); ?> </td>
                                            <td>
                                                <a class="" href="<?php echo e(url('markLostDamaged/'.$i->event_id), false); ?>">
                                                    <button class="btn btn-block btn-sm"><i class="ni ni-zoom-split-in"></i> &nbsp; Report Reason</button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                    
                                    
                            </div>
                        </div>
		        
		    </div>
		</div>
    </div>
    




    <div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
                            
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Reported Mark as Lost/Damaged</h1>
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="card-body">
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush" id="myTable1">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Event Name</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Borrow Date/Time</th>
                                            
                                            <th scope="col">Event Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($i->status >= 6): ?>
                                        <tr>
                                            <td><?php echo e($i->event_name, false); ?></td>
                                            <td><?php echo e($i->venue, false); ?></td>
                                            <td><?php echo e(Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a'), false); ?></td>
                                            
                                            <td><?php echo e($i->status_name, false); ?> </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                    
                                    
                            </div>
                        </div>
		        
		    </div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href=". /resources/DataTables/datatables.min.css"/>
    <script type="text/javascript" src=". /resources/DataTables/datatables.min.js"></script>
    

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order":["2"]
            });
            $('#myTable1').DataTable({
                "order":["2"]
            });
        } );
    </script>

    

    

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>