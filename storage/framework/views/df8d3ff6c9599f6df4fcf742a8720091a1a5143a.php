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
                                        <?php echo e(Form::submit('Report Lost/Damaged Items', ['class' => 'btn btn-success']), false); ?>

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
                                        <div class="col-md-12 mb-5">
                                            <div class="row">
                                                <input type="hidden" name="event_id" id="event_id" value="<?php echo e($event->event_id, false); ?>">
                                                <input type="hidden" class="form-control" value="<?php echo e($event->event_name, false); ?>" name="event_name" id="event_name">
                                                <input type="hidden" class="form-control" value="<?php echo e($event->venue, false); ?>" name="qty" id="qty">
                                                <input type="hidden" class="form-control" value="<?php echo e($event->event_start, false); ?>" name="event_start" id="qty">
                                                <input type="hidden" class="form-control" value="<?php echo e($event->package_name, false); ?>" name="package_name" id="package_name">
                                                <div class="col-md-3">
                                                    <label> Event Name </label>
                                                    <h1><?php echo e($event->event_name, false); ?></h1>
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Venue </label> 
                                                    <h1><?php echo e($event->venue, false); ?></h1>
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Date of Event </label>
                                                    <h1><?php echo e(Carbon\Carbon::parse($event->event_start)->format('F j, Y      g:i a'), false); ?></h1> 
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Package </label>
                                                    <h1><?php echo e($event->package_name, false); ?></h1>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                        <label> Assigned Personel In-charge: </label>
                                                        <h1><?php echo e($employee->employee_fn. ' ' .$employee->employee_ln. ' ('. $employee->contact_no.')', false); ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <?php $__currentLoopData = $lostDamaged; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input type="hidden" name="item_id<?php echo e($i->inventory_id, false); ?>" id="item_id-<?php echo e($i->barcode, false); ?>" value="<?php echo e($i->inventory_id, false); ?>">
                                                <input type="hidden" class="form-control" value="<?php echo e($i->inventory_name, false); ?>" name="inventory_name<?php echo e($i->inventory_id, false); ?>" id="inventory_name">
                                                <input type="hidden" class="form-control barcode" value=" <?php echo e($i->barcode, false); ?>" name="barcode" id="barcode">
                                                <input type="hidden" class="form-control" value="<?php echo e($i->qty, false); ?>" name="qty" id="qty">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <label> Item Name </label>
                                                                <h2> <?php echo e($i->inventory_name, false); ?></h2>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label> Category </label>
                                                                <h2> <?php echo e($i->category_name, false); ?></h2>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label> Color </label>
                                                                <h2> <?php echo e($i->color_name, false); ?></h2>
                                                            </div>
                                                            <div class="col-md-3">
                                                                
                                                                <label> Event Barcode (not inventory barcode) </label>
                                                                <div class="col-md-12 short-content">
                                                                    <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->barcode, "C128A",2,50,array(1,1,1), true) . '" alt="barcode"   />'; ?>

                                                                    <br><?php echo e($i->barcode, false); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 offset-1">
                                                                <label> Quantity Reported </label>
                                                                <h2> <?php echo e($i->qty, false); ?> </h2>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label> Reason <font color="red">*</font></label>
                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        
                                                                        <textarea class="form-control reason" name="reason-<?php echo e($i->inventory_id, false); ?>" id="reason-<?php echo e($i->barcode, false); ?>" cols="30" rows="10" placeholder="Please Input Reason for Loss/Damage" required></textarea>
                                                                        
                                                                    </div>
                                                                    <div class="col-md-2 offset-1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="reasonsArray" id="reasonsArray">
                                                            <input type="hidden" name="idsArray" id="idsArray">
                                                            <?php echo Form::close(); ?>

                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-sm btn-success check" name="accept" id="<?php echo e($i->barcode, false); ?>" onclick="checkReason(this.id)"><i class="ni ni-check-bold"></i></button>
                                                                <button type="button" class="btn btn-sm btn-danger cancel" name="cancel" id="<?php echo e($i->barcode, false); ?>" onclick="cancelReason(this.id)"><i class="ni ni-fat-remove"></i></button>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                <button type="button" class="button btn-success btn-lg" data-toggle="modal" onclick="checkInputClosed()" data-target="#myModal">Report</button>
                                <a href="<?php echo e(url('markLostDamaged'), false); ?>" class="btn btn-default">Back</a>
                            </div>
                        </div>
                        
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
			// document.getElementById('status').onchange = function checkBarcode(){
            var reasonsWhy = array();

           

        //     document.getElementsByClassName('button').onclick = function checkReason(){
        //         alert("hi");

        //         reasonsWhy.push( $( "textarea" ).map(function() {
        //         return $( this ).val();
        //         })
        //         .get()
        //         .join( ", " ) );

        //         // window.alert(reasonsWhy+"-hi");

        //         // alert("HELLO");

		// 		// var barcode = document.getElementById('barcodeInput').value;
                

				
		// 		var barcodeId = "qtyReturn"+barcode+"";
		// 		var lostbarcodeId = "qtyLostDam"+barcode+""; 
		// 		var qtyId = "qty"+barcode+"";
		// 		var rowId = "row"+barcode+"";

		// 		if (document.getElementById(barcodeId).value != null){
		// 			if(parseInt(document.getElementById(barcodeId).value) < parseInt(document.getElementById(qtyId).value)){
		// 				document.getElementById(barcodeId).value = parseInt(document.getElementById(barcodeId).value) + 1;
		// 				document.getElementById(lostbarcodeId).value = parseInt(document.getElementById(lostbarcodeId).value) - 1;
		// 			} else if (parseInt(document.getElementById(barcodeId).value) == parseInt(document.getElementById(qtyId).value)){
		// 				document.getElementById(rowId).className = 'success';
		// 			}
		// 			barcode = document.getElementById('barcodeInput').value = "";
		// 		}

		// 		var quantities = document.getElementsByClassName( 'qtyReturn' ),
		// 			qtys  = [].map.call(quantities, function( input ) {
		// 				return input.value;
		// 			}).join();

		// 		var inventoryIDs = document.getElementsByClassName( 'invID' ),
		// 			ids  = [].map.call(inventoryIDs, function( input ) {
		// 				return input.id;
		// 			}).join();

		// 		// var lostIDs = document.getElementsByClassName('lostID'),
		// 		// 	losts = [].

		// 		document.getElementById('qtyReturnArray').value = qtys;
		// 		document.getElementById('idReturnArray').value = ids;

		// 		var qty = document.getElementById('qtyReturnArray').value;
		// 		var id = document.getElementById('idReturnArray').value;
		// 	}


		});

		function checkReason(clicked_id){
            // var barcode = document.getElementsByClassName('reason')
            // var text = a.value;
            // alert(text+"-hi");
            // alert("hello");

            var reason = "reason-"+clicked_id+"";

            document.getElementById(reason).readOnly = true;

            var inputs = document.getElementsByClassName( 'reason' ),
            reasons  = [].map.call(inputs, function( input ) {
                return input.value;
                
            }).join( ',' );

            var inputs = document.getElementById( 'barcode' ),
            ids  = [].map.call(inputs, function( input ) {
                return inputs.value;
                
            }).join( ',' );

            alert(ids+"");

            document.getElementById('reasonsArray').value = reasons;
            document.getElementById('idsArray').value = ids;
            // document.getElementById('idReturnArray').value = ids;
            
		}

        function cancelReason(clicked_id){
            var reason = "reason-"+clicked_id+"";
            document.getElementById(reason+"").readOnly = false;
            // alert(reason);
            alert( document.getElementById('idsArray').value + "");
        }
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>