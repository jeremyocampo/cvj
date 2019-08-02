@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.inventoryCard')
    
    <div class="container-fluid mt--7">
            <div class="card-body">
                <div class="col-xl-12 mb-5 mb-xl-0">
                        <div class="card shadow">
                        <div class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<h1 class="">Create User</h1>
									</div>
								</div>
						</div>
                    <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        {{-- <small>{{ __('Or sign up with credentials') }}</small> --}}
                    </div>
                    <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf

        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            @if ($errors->has('name'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            @if ($errors->has('email'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>
            </div>
            @if ($errors->has('password'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>
            </div>
        </div>
        <div class="text-muted font-italic">
            {{-- <small>{{ __('password strength') }}: <span class="text-success font-weight-700">{{ __('strong') }}strong</span></small> --}}
        </div>

        <div class="form-group{{ $errors->has('tel_no') ? ' has-danger' : '' }}">
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control{{ $errors->has('tel_no') ? ' is-invalid' : '' }}" placeholder="{{ __('Telephone Number') }}" type="text" name="tel_no" value="{{ old('tel_no') }}" required>
            </div>
            @if ($errors->has('tel_no'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('tel_no') }}</strong>
                </span>
            @endif
        </div>
            
        <div class="form-group{{ $errors->has('mob_no') ? ' has-danger' : '' }}">
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control{{ $errors->has('mob_no') ? ' is-invalid' : '' }}" placeholder="{{ __('Mobile/Cellphone Number') }}" type="text" name="mob_no" value="{{ old('mob_no') }}" required>
            </div>
            @if ($errors->has('mob_no'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('mob_no') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Address') }}" type="text" name="address" value="{{ old('address') }}" required>
                </div>
                @if ($errors->has('address'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>

        {{-- remove later --}}
        {{-- <div class="col-md-9 mb-3"> --}}
        <div class="form-group">
            {{-- <label class="form-label">User Type</label> --}}
            <select id="color" name="userType" class="form-control" placeholder="User Type" required>
                    <option value = 0 selected disabled>Please Select a User Type</option>
                    <option value = 1>Admin</option>
                    <option value = 2>Inventory Manager</option>
                    <option value = 3>Events Manager</option>
                    <option value = 4>Employee</option>
                    <option value = 5>Customer</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-4">{{ __('Create account') }}</button>
        </div>
    </form>
</div>

@endsection