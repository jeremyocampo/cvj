<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.headers.inventoryCard1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
                            
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Return Inventory</h1>
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
                            </div>
						</div>
						<div class="card-body">
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Event Name</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Borrow Date/Time</th>
                                            
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($i->status <= 4): ?>
                                        <tr>
                                            <td><?php echo e($i->event_name); ?></td>
                                            <td><?php echo e($i->venue); ?></td>
                                            <td><?php echo e(Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a')); ?></td>
                                            
                                            <td><?php echo e($i->status_name); ?> </td>
                                            <td>
                                                <a class="" href="<?php echo e(url('returnInventory/'.$i->event_id)); ?>" >
                                                    <button class="btn btn-block btn-sm"><i class="ni ni-zoom-split-in"></i> &nbsp; Return Event Inventory</button>
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
                                    <a href="<?php echo e(url('inventory')); ?>" class="btn btn-secondary">Back to View Inventory</a>
                                    
                            </div>
                        </div>
		        
		    </div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>