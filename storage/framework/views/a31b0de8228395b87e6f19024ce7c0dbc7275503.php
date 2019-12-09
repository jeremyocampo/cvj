<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.headers.inventoryCard1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container-fluid mt--7">
        <div class="card-body">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <?php echo Form::open(['action' => 'ManpowerController@store', 'method' => 'POST', 'autocomplete' =>'off']); ?>

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="">Create Manpower Record</h1>
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
                                <label class="form-label">Agency</label>
                                <select name="agency_id" class="form-control" required>
                                    <option value = 0 selected disabled>Please Select agency</option>
                                    <?php $__currentLoopData = $agencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($agency->agency_id); ?>"><?php echo e($agency->agency_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="employee_fn" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="employee_ln" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employee Type</label>
                                <select class="form-control" name="employee_type" required>
                                    <option value="Waiter">Waiter</option>
                                    <option value="Host">Host</option>
                                    <option value="Head Waiter">Head Waiter</option>
                                    <option value="Server">Server</option>
                                    <option value="Logistics">Logistics</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Schedule</label>
                                <select name="schedule_id" class="form-control" required>
                                    <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($schedule->id); ?>"><?php echo e($schedule->shift_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Contact No</label>
                                <input type="number" class="form-control" step="any" name="contact_no" required />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        

                        <div class="text-right">

                            <?php echo e(Form::submit('Save Record', ['class' => 'btn btn-success'])); ?>

                            <a href="<?php echo e(url('manpowers')); ?>" class="btn btn-default">Back</a>
                            
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