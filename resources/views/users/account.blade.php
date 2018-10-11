@extends('layouts.frontendLayout.frontend_design')
@section('content')

	<section id="form" style="margin-top: 20px;"><!--form-->
		<div class="container">
			<div class="row">
						@if(Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ session('flash_message_error') }}</strong>
            </div>
        @endif
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ session('flash_message_success') }}</strong>
            </div>
        @endif
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
						<h2>Update Account</h2>
						<form id="accountForm" name="accountForm" action="{{ url('/user-account') }}" method="post">
							{{ csrf_field() }}
							<input value="{{ $userDetails->name }}" id="name" name="name" type="text" placeholder="Name"/>
                            <input value="{{ $userDetails->address }}" id="address" name="address" type="text" placeholder="Address"/>
                            <input value="{{ $userDetails->city }}" id="city" name="city" type="text" placeholder="City"/>
                            <input value="{{ $userDetails->state }}" id="state" name="state" type="text" placeholder="State"/>
                            <select id="country" name="country">
                            	<option value="">Select Country</option>
                            	@foreach($countries as $country)
                            	<option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                            	@endforeach
                            </select>
                            <input value="{{ $userDetails->zipcode }}" style="margin-top: 10px;" id="zipcode" name="zipcode" type="text" placeholder="Zipcode"/>
                            <input value="{{ $userDetails->phone }}" id="phone" name="phone" type="text" placeholder="Phone number"/>
							<button type="submit" class="btn btn-default">Update Account</button>
						</form>
					</div>
				</div>
				<div class="col-sm-1" style="margin-left: 20px;">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4" style="margin-left: 40px;">
					<div class="signup-form">
						<h2>Update Password</h2>

					</div>
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection