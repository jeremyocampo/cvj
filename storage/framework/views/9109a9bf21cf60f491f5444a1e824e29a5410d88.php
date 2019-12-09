<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.headers.inventoryCard1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						<?php echo Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'autocomplete' =>'off']); ?>

						<div class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<h1 class="">Add Item to Inventory</h1>
									</div>

								</div>
						</div>
						<div class="card-body border-0">
							
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="alert alert-danger" role="alert">
									<button type = button data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
										<?php echo e($error); ?><br>
								</div>
										
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if(session()->has('warning')): ?>
                                    <br>
                                    <div class="alert alert-warning" role="alert">
                                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                        <?php echo e(session()->get('warning')); ?><br>
                                    </div>
                                <?php endif; ?>
							
							<div class="row">
								<div class="col-md-12 mb-3">
									<label class="form-label">Inventory Name</label>
									<?php echo e(Form::text('inventory_name', '',['class' => 'form-control', 'placeholder' => 'Inventory Name'] )); ?>

								</div>
								<div class="col-md-9 mb-3">
										<label class="form-label">Category</label>
										<select id="category" name="category" class="form-control" placeholder="Category" onchange="filterDropdown()" required>
												<option value = 0 selected disabled>Please Select a Category</option>
												<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option id="category-<?php echo e($category->category_no); ?>" value="<?php echo e($category->category_no); ?>"><?php echo e($category->category_name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
								</div>
								<div class="col-md-3 mb-3"></div>
								<div class="col-md-9 mb-3">
									<label class="form-label">Color</label>
									<select id="color" name="color" class="form-control" placeholder="Color" required>
											<option value = 0 selected disabled>Please Select a Color</option>
											<?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option id="category-<?php echo e($color->color_id); ?>" value="<?php echo e($color->color_id); ?>"><?php echo e($color->color_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
								<div class="col-md-3 mb-3"></div>
								<div class="col-md-9 mb-3">
									<label class="form-label">Size</label>
									<select id="color" name="size" class="form-control" placeholder="Size" required>
                                        <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($size->size_id); ?>" id="size"><?php echo e($size->size_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
								</div>
								<div class="col-md-3 mb-3"></div>
								<div class="col-md-5 mb-3">
									<label class="form-label">Item Quantity</label>
									<?php echo e(Form::number('quantity', '',['class' => 'form-control', 'placeholder' => 'Starting Quantity'] )); ?>

								</div>
								<div class="col-md-4 mb-3">
									<label class="form-label">Item Threshold</label>
									<?php echo e(Form::number('threshold', '',['class' => 'form-control', 'placeholder' => 'Minimum Threshold'] )); ?>

								</div>
								<div class="col-md-3"></div>
								<div class="col-md-4 mb-3">
									<label class="form-label">Item Price (Php)</label>
									<?php echo e(Form::number('price', '',['class' => 'form-control', 'placeholder' => 'Item Price' , 'type' => 'number' , 'min' => 1 , 'step' => 0.01] )); ?>

								</div>
                                <div class="col-md-4">
                                    <label>
                                        Shelf Life
                                    </label>
                                    <input type="text" class="form-control" name="shelf_life" placeholder="Shelf Life" required />
                                </div>
                                <div class="col-md-4">
                                    <label>Returnable Item</label>
                                    <select class="form-control" name="returnable_item" required>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Suppliers</label>
                                    <select class="form-control" name="supplier_id" required>
                                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($supplier->supplier_id); ?>"><?php echo e($supplier->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
								</div>
								<div class="col-md-4 mb-3">
									<label class="form-label">Description</label>
									<input type="textarea" name="description" class="form-control" placeholder="Please Input Item Description">
								</div>
							</div>
						</div>
						<div class="card-footer text-muted">
								

								<div class="text-right">
								
								<?php echo e(Form::submit('Add Item', ['class' => 'btn btn-success'])); ?>

								<a href="<?php echo e(url('inventory')); ?>" class="btn btn-default">Back</a>
								 
								</div>
						</div>
							<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<script>
	function getSelected(){

		// // get references to select list and display text box
		// var sel = document.getElementById('category');
		// var el = document.getElementById('display');

		// function getSelectedOption(sel) {
		// 	var opt;
		// 	for ( var i = 0, len = sel.options.length; i < len; i++ ) {
		// 		opt = sel.options[i];
		// 		if ( opt.selected === true ) {
		// 			break;
		// 		}
		// 	}
		// 	return opt;

		// assign onclick handlers to the buttons
		// document.getElementById('showVal').onclick = function () {
		// 	el.value = sel.value;    
		// }
	}
	$('#selectField').change(function(){
    if($('#selectField').val() == 'N'){
        $('#secondaryInput').hide();
    } else {
        $('#secondaryInput').show();
	}
	});


</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>