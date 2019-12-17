<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.headers.inventoryCard1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-10 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
                            
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Deploy Inventory</h1>
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                        </div>
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
                        
                        <?php echo Form::open(['action' => ['DeployInventoryController@store'], 'method' => 'POST']); ?>

                        
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title">Are you sure you want to continue?</h1>
                                    </div>
                                    <div class="modal-body">
                                        <p>Please check all necessary details before you continue.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <?php echo e(Form::submit('Deploy Items', ['class' => 'btn btn-success']), false); ?>

                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="card-body">
                                <div class="table-responsive mb-3">
                                    <!-- Projects table -->
                                    <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-5 mb-5">
                                            <div class="row">
                                                <div class="col-md-12 mb-7">
                                            <?php $__currentLoopData = $event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                    <input type="hidden" name="event_id" id="event_id" value="<?php echo e($i->event_id, false); ?>">
                                                    <label> Event Name </label><input class="form-control" type="text" disabled value="<?php echo e($i->event_name, false); ?>">
                                                    <input type="hidden" class="form-control" value="<?php echo e($i->event_name, false); ?>" name="event_name" id="event_name"></form>
                                                    <label> Venue </label> <input class="form-control" type="text" disabled value="<?php echo e($i->venue, false); ?>">
                                                    <input type="hidden" class="form-control" value="<?php echo e($i->venue, false); ?>" name="qty" id="qty"></form>
                                                    <label> Date </label> <input class="form-control" type="text" disabled value="<?php echo e(Carbon\Carbon::parse($i->event_start)->format('F j, Y      g:i a'), false); ?>"> 
                                                    <input type="hidden" class="form-control" value="<?php echo e($i->event_start, false); ?>" name="event_start" id="qty"></form>
                                                    <label> Package </label><input class="form-control" type="text" disabled value="<?php echo e($i->package_name, false); ?>"> 
                                                    <input type="hidden" class="form-control" value="<?php echo e($i->package_name, false); ?>" name="package_name" id="package_name"></form>
                                                
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                Assigned Personel In-charge: <font color="red">*</font>
                                                <select class="form-control" name="employeeAssigned" required>
                                                    <option disabled selected > -Please Assign an Employee- </option>
                                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($a->id, false); ?>"> <?php echo e($a->employee_fn, false); ?> <?php echo e($a->employee_ln, false); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th>Category</th>
                                                    <th>Color</th>
                                                    
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <input type="hidden" name="item_id<?php echo e($i->inventory_id, false); ?>" id="item_id" value="<?php echo e($i->inventory_id, false); ?>">
                                                    <td> <?php echo e($i->inventory_name, false); ?></td>
                                                <input type="hidden" class="form-control" value="<?php echo e($i->inventory_name, false); ?>" name="inventory_name<?php echo e($i->inventory_id, false); ?>" id="inventory_name"></form>
                                                    <td> <?php echo e($i->category_name, false); ?> </td>
                                                    <td> <?php echo e($i->color_name, false); ?> </td>
                                                    
                                                    <input type="hidden" class="form-control" value=" <?php echo e($i->sku, false); ?>" name="barcode" id="barcode"></form>
                                                    <td> <?php echo e($i->qty, false); ?></td>
                                                    <input type="hidden" class="form-control" value="<?php echo e($i->qty, false); ?>" name="qty" id="qty"></form> 
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    
                                    </div>
                                </div>
                                </div>

                                
                                </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Deploy</button>
                                    <a href="<?php echo e(url('deploy'), false); ?>" class="btn btn-default">Back</a>
                            </div>
                        </div>
                        
		<?php echo Form::close(); ?>

		</div>
        </div>
        
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>