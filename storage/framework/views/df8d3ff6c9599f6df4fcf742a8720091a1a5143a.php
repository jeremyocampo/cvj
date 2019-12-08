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
                                            <h1 class="mb-0">Report Lost/Damaged</h1>
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
                                        <?php echo e(Form::submit('Deploy Items', ['class' => 'btn btn-success'])); ?>

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
                                            
                                                
                                                    <input type="hidden" name="event_id" id="event_id" value="<?php echo e($event->event_id); ?>">
                                                    <label> Event Name </label><input class="form-control" type="text" disabled value="<?php echo e($event->event_name); ?>">
                                                    <input type="hidden" class="form-control" value="<?php echo e($event->event_name); ?>" name="event_name" id="event_name"></form>
                                                    <label> Venue </label> <input class="form-control" type="text" disabled value="<?php echo e($event->venue); ?>">
                                                    <input type="hidden" class="form-control" value="<?php echo e($event->venue); ?>" name="qty" id="qty"></form>
                                                    <label> Date </label> <input class="form-control" type="text" disabled value="<?php echo e(Carbon\Carbon::parse($event->event_start)->format('F j, Y      g:i a')); ?>"> 
                                                    <input type="hidden" class="form-control" value="<?php echo e($event->event_start); ?>" name="event_start" id="qty"></form>
                                                    <label> Package </label><input class="form-control" type="text" disabled value="<?php echo e($event->package_name); ?>"> 
                                                    <input type="hidden" class="form-control" value="<?php echo e($event->package_name); ?>" name="package_name" id="package_name"></form>
                                                
                                            
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                Assigned Personel In-charge: <font color="red">*</font>
                                                <select class="form-control" name="employeeAssigned" required>
                                                    <option disabled selected > -Please Assign an Employee- </option>
                                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($a->employee_id); ?>"> <?php echo e($a->employee_FN); ?> <?php echo e($a->employee_LN); ?></option>
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
                                                    <th>Barcode</th>
                                                    <th>Quantity Reported</th>
                                                    <th>Status</th>
                                                    <th>Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php $__currentLoopData = $lostDamaged; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <input type="hidden" name="item_id<?php echo e($i->inventory_id); ?>" id="item_id" value="<?php echo e($i->inventory_id); ?>">
                                                    <td> <?php echo e($i->inventory_name); ?></td>
                                                <input type="hidden" class="form-control" value="<?php echo e($i->inventory_name); ?>" name="inventory_name<?php echo e($i->inventory_id); ?>" id="inventory_name"></form>
                                                    <td> <?php echo e($i->category_name); ?> </td>
                                                    <td> <?php echo e($i->color_name); ?> </td>
                                                    <td> <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->barcode, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />'; ?></td>
                                                    <input type="hidden" class="form-control" value=" <?php echo e($i->barcode); ?>" name="barcode" id="barcode"></form>
                                                    <td> <?php echo e($i->qty); ?></td>
                                                    <input type="hidden" class="form-control" value="<?php echo e($i->qty); ?>" name="qty" id="qty"></form> 
                                                    <td>
                                                        <select name="status" id="status" class="form-control" required>
                                                            <option selected disabled>- Please Select Status -</option>
                                                            <option value = 1>Lost</option>
                                                            <option value = 2>Damaged</option>
                                                        </select>
                                                        <font color="red">*</font>
                                                    </td>
                                                    <td>
                                                        <textarea name="reason" id="reason" cols="30" rows="10" placeholder="Please Input Reason for Loss/Damage" required>
                                                        </textarea>
                                                        <font color="red">*</font>
                                                    </td>
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
                                    <a href="<?php echo e(url('deploy')); ?>" class="btn btn-default">Back</a>
                            </div>
                        </div>
                        
		<?php echo Form::close(); ?>

		</div>
        </div>
        
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>