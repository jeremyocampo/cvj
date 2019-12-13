    <?php echo $__env->make('layouts.headers.guest', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small><?php echo e(__('Please Sign in with credentials'), false); ?></small><br>
                        </div>
                        <form role="form" method="POST" action="<?php echo e(route('login'), false); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group<?php echo e($errors->has('email') ? ' has-danger' : '', false); ?> mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : '', false); ?>" placeholder="<?php echo e(__('Email'), false); ?>" type="email" name="email" autocomplete="off" value="<?php echo e(old('email'), false); ?>" required autofocus>
                                </div>
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('email'), false); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('password') ? ' has-danger' : '', false); ?>">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : '', false); ?>" name="password" placeholder="<?php echo e(__('Password'), false); ?>" type="password" required>
                                </div>
                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('password'), false); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" <?php echo e(old('remember') ? 'checked' : '', false); ?>>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted"><?php echo e(__('Remember me'), false); ?></span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4"><?php echo e(__('Sign in'), false); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request'), false); ?>" class="text-light">
                                <small><?php echo e(__('Forgot password?'), false); ?></small>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<?php echo $__env->make('layouts.app', ['class' => 'bg-default'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>