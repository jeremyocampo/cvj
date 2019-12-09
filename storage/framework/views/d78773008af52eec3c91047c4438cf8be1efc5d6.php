<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.headers.inventoryCard1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="container-fluid mt--7">
		
				
				
				<div class="col-xl-12 mb-5">
					<div class="card shadow " >
						<div class="card-header ">
							<div class="row align-items-center">
								<div class="col">
									<div class="row">
											<div class="col-md-5 ">
												<h1 calss="">Event Item Details</h1>
											</div>
									<div class="col-xs-2">
											&nbsp;&nbsp;
									</div>
									
									</div>
								</div>
								
								<div class="col text-left">
									
										<div class="col-xs-5">
									
									<input class="form-control" id="barcodeInput" type="number" onkeyup="checkBarcode(this)" style="background: transparent;" placeholder="Input Barcode Here" autofocus>
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
						
						<?php echo Form::open(['action' => ['ReturnInventoryController@store'], 'method' => 'POST']); ?>

                        <!-- Modal -->
                        <!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<div class="modal-header">
											<h1 class="modal-title">Are you sure you want to continue?</h1>
										</div>
												
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Please check all necessary details before you continue.</p>
									</div>
									<div class="modal-footer">
										<?php echo e(Form::submit('Return Items to Inventory', ['class' => 'btn btn-success'])); ?>

										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<?php $__currentLoopData = $event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-md-4">
										<label class="form-label">Client Name</label>
											<h1><b><?php echo e($event->client_name); ?></b></h1>
										<input type="hidden" class="form-control" name="event_name" value="<?php echo e($event->event_name); ?>">	
								</div>
								<div class="col-md-4">
									<input type="hidden" class="form-control" name="event_id" value="<?php echo e($event->event_id); ?>">
									<label class="form-label">Event Name</label>
										<h1><b><?php echo e($event->event_name); ?></b></h1>
									<input type="hidden" class="form-control" name="event_name" value="<?php echo e($event->event_name); ?>">
								</div>
								<div class="col-md-4">
									<label class="form-label">Date Deployed</label>
									<?php if($dateDeployed->date_deployed <= $event->event_start): ?>
										<h1><b><?php echo e(Carbon\Carbon::parse($dateDeployed->date_deployed)->format('F j, Y g:i a')); ?></b></h1>
									<?php else: ?>
										<h1><b><?php echo e(Carbon\Carbon::parse($dateDeployed->date_deployed)->format('F j, Y g:i a')); ?> <font color="red">[LATE]</font></b></h1>
									<?php endif; ?>
									<input type="hidden" class="form-control" name="event_start" value="<?php echo e($dateDeployed->date_deployed); ?>">
								</div>

								
								<div class="col-md-8">
									<label class="form-label">Venue</label>
									<h1><b><?php echo e($event->venue); ?></b></h1>
									<input type="hidden" class="form-control" name="venue" value="<?php echo e($event->venue); ?>">
								</div>
								<div class="col-md-4">
										<label class="form-label">Employee Assigned/Responsible</label>
										<h1><b><?php echo e($employee->employee_FN. ' ' .$employee->employee_LN. ' ('. $employee->contact_no.')'); ?></b></h1>
										<input type="hidden" class="form-control" name="venue" value="<?php echo e($employee->employee_id); ?>">
									</div>
								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						<div class="card-body border-0">
							<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="alert alert-danger" role="alert">
								<button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
									<?php echo e($error); ?><br>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    	</div>
                    <div class="table-responsive mb-3">
                            <!-- Projects table -->
                            
                            <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
											<th scope="col">Item Name</th>
											<th scope="col">Color</th>
											<th scope="col">Event Barcode</th>
											
											<th scope="col">Quantity Deployed</th>
											
											<th scope="col">Quantity Scanned for Return</th>
											<th scope="col">Quantity Lost/Damaged</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										
									
                                        <?php $__currentLoopData = $deployed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                        <tr id="row<?php echo e($i->barcode); ?>" class="success">
                                            
											<td><?php echo e($i->inventory_name); ?></td>
											<td><?php echo e($i->color_name); ?></td>
											<td>
												<div id="barcode-<?php echo $i->inventory_id; ?>" value="<?php echo "toPrint-" . $i->inventory_id; ?>">
													<?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->barcode, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />'; ?>

													<br><?php echo e($i->barcode); ?>

												</div>	
											</td>
											
											<td>
												<?php echo e($i->qty); ?>

												<input hidden type="text" value="<?php echo e($i->qty); ?>" id="qty<?php echo e($i->barcode); ?>">
											</td>
											
											<td>
												<div class="col-xl-4">
													
													<input type="hidden" class="invID" name="invIDs[]" value="<?php echo e($i->inventory_id); ?>" id="inventory-<?php echo e($i->inventory_id); ?>">
													<input type="number" value=0  readonly class="form-control qtyReturn" name="qtyReturned[]" id="qtyReturn<?php echo e($i->barcode); ?>">
												</div>
											</td>
											<td>
												<div class="col-xl-4">
													
													<input type="hidden" class="lostID" name="lostIDs[]" value="<?php echo e($i->inventory_id); ?>" id="lost-<?php echo e($i->inventory_id); ?>">
													<input type="number" value=<?php echo e($i->qty); ?>  readonly class="form-control qtyLostDam" name="qtyLostDam[]" id="qtyLostDam<?php echo e($i->barcode); ?>">
												</div>
											</td>
                                        </tr>
                                        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                        </div>
				</div>
				<div class="card-footer text-muted">
						<div class="text-right">
								<button type="button" onclick="checkLoD()" class="btn btn-success" data-toggle="modal" data-target="#myModal">Return Items To Inventory</button>
								
								<a href="<?php echo e(url('returnInventory')); ?>" class="btn btn-default">Back</a>
								
								
						</div>
				</div>
				
			</div>
		</div>
				<input type="hidden" name="qtyReturnArray" id="qtyReturnArray">
				<input type="hidden" name="idReturnArray" id="idReturnArray">
				
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
			var barcode = document.getElementById('barcodeInput').value;
			document.getElementById('barcodeInput').onkeyup = function checkBarcode(){

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