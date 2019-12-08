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
                        
                        <?php echo Form::open(['action' => ['MarkLostDamagedController@store'], 'method' => 'POST']); ?>

                        
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
                                        <div class="col-md-4 mb-5">
                                            <div class="row">
                                                <div class="col-md-12 mb-7">
                                            
                                                
                                                    <input type="hidden" name="event_id" id="event_id" value="<?php echo e($event->event_id); ?>">
                                                    <label> Event Name </label>
                                                    <h1><?php echo e($event->event_name); ?></h1>
                                                    <input type="hidden" class="form-control" value="<?php echo e($event->event_name); ?>" name="event_name" id="event_name"></form>
                                                    <label> Venue </label> 
                                                    <h1><?php echo e($event->venue); ?></h1>
                                                    <input type="hidden" class="form-control" value="<?php echo e($event->venue); ?>" name="qty" id="qty"></form>
                                                    <label> Date of Event </label>
                                                    <h1><?php echo e(Carbon\Carbon::parse($event->event_start)->format('F j, Y      g:i a')); ?></h1> 
                                                    <input type="hidden" class="form-control" value="<?php echo e($event->event_start); ?>" name="event_start" id="qty"></form>
                                                    <label> Package </label>
                                                    <h1><?php echo e($event->package_name); ?></h1>
                                                    <input type="hidden" class="form-control" value="<?php echo e($event->package_name); ?>" name="package_name" id="package_name"></form>
                                                
                                            
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                        <label> Assigned Personel In-charge: </label>
                                                        <h1><?php echo e($employee->employee_FN. ' ' .$employee->employee_LN. ' ('. $employee->contact_no.')'); ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
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
                                                    <td> 
                                                        <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->barcode, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />'; ?>

                                                        <br><?php echo e($i->barcode); ?>

                                                    </td>
                                                    
                                                    <input type="hidden" class="form-control" value=" <?php echo e($i->barcode); ?>" name="barcode" id="barcode"></form>
                                                    <td> <?php echo e($i->qty); ?></td>
                                                    <input type="hidden" class="form-control" value="<?php echo e($i->qty); ?>" name="qty" id="qty"></form> 
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                
                                                                <select name="status-<?php echo e($i->inventory_id); ?>" id="status" class="form-control statusLD" required>
                                                                    <option selected disabled>- Please Select Status -</option>
                                                                    <option value = 1>Lost</option>
                                                                    <option value = 2>Damaged</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                    <font color="red">*</font>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <textarea name="reason-<?php echo e($i->inventory_id); ?>" id="reason" cols="30" rows="10" placeholder="Please Input Reason for Loss/Damage" required>
                                                                </textarea>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <font color="red">*</font>
                                                            </div>
                                                        </div>
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
                                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Report</button>
                                    <a href="<?php echo e(url('deploy')); ?>" class="btn btn-default">Back</a>
                            </div>
                        </div>
                        
		<?php echo Form::close(); ?>

		</div>
        </div>
        
	</div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script>
        // $('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');

        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            document.location.reload(true);
            
            // var restorepage = document.body.innerHTML;
            // var printcontent = document.getElementById().innerHTML;
            // document.body.innerHTML = printcontent;
            // window.print();
            // document.body.innerHTML = restorepage;
        }
	</script>
	<script>
		$( document ).ready(function() {
			// var barcode = document.getElementById('barcodeInput').value;
			document.getElementById('status').onchange = function checkBarcode(){

				var barcode = document.getElementById('barcodeInput').value;
				
				var barcodeId = "qtyReturn"+barcode+"";
				var lostbarcodeId = "qtyLostDam"+barcode+""; 
				var qtyId = "qty"+barcode+"";
				var rowId = "row"+barcode+"";

				if (document.getElementById(barcodeId).value != null){
					if(parseInt(document.getElementById(barcodeId).value) < parseInt(document.getElementById(qtyId).value)){
						document.getElementById(barcodeId).value = parseInt(document.getElementById(barcodeId).value) + 1;
						document.getElementById(lostbarcodeId).value = parseInt(document.getElementById(lostbarcodeId).value) - 1;
					} else if (parseInt(document.getElementById(barcodeId).value) == parseInt(document.getElementById(qtyId).value)){
						document.getElementById(rowId).className = 'success';
					}
					barcode = document.getElementById('barcodeInput').value = "";
				}

				var quantities = document.getElementsByClassName( 'qtyReturn' ),
					qtys  = [].map.call(quantities, function( input ) {
						return input.value;
					}).join();

				var inventoryIDs = document.getElementsByClassName( 'invID' ),
					ids  = [].map.call(inventoryIDs, function( input ) {
						return input.value;
					}).join();

				// var lostIDs = document.getElementsByClassName('lostID'),
				// 	losts = [].

				document.getElementById('qtyReturnArray').value = qtys;
				document.getElementById('idReturnArray').value = ids;

				var qty = document.getElementById('qtyReturnArray').value;
				var id = document.getElementById('idReturnArray').value;

			}


		});

		function checkLoD(){

		}
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>