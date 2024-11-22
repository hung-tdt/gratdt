@extends('customer.component.main')

@section('content')
	<div class="main-page-banner pb-50 off-white-bg">
		<div class="container">
			<div class="row">
				<!-- Vertical Menu Start Here -->
				@include('customer.component.navbar-nonactive')
				<!-- Vertical Menu End Here -->
			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>

	<div class="breadcrumb-area mt-30">
		<div class="container">
			<div class="breadcrumb">
				<ul class="d-flex align-items-center">
					<li><a href="/">Home</a></li>
					<li><a href="login.html">Login</a></li>
				</ul>
			</div>
		</div>
	</div>

    <div class="breadcrumb-area mt-30">
		<div class="container">		
			@include('admin.component.alert')
		</div>
	</div>

    <div class="log-in ptb-100 ptb-sm-60">
        <div class="container">
            <div class="row">
                <!-- New Customer Start -->
                <div class="col-md-6">
                    <div class="well mb-sm-30">
                        <div class="new-customer">
                            <h3 class="custom-title">new customer</h3>
                            <p class="mtb-10"><strong>Register</strong></p>
                            <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made</p>
                            <a class="customer-btn" href="register.html">continue</a>
                        </div>
                    </div>
                </div>
                <!-- New Customer End -->
                <!-- Returning Customer Start -->
                <div class="col-md-6">
                    <div class="well">
                        <div class="return-customer">
                            <h3 class="mb-10 custom-title">returnng customer</h3>
                            <p class="mb-10"><strong>I am a returning customer</strong></p>
                            <form action="{{URL::to('/login/store')}}" method="POST">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" placeholder="Enter your email address..." id="input-email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Password" id="input-password" class="form-control">
                                </div>
                                <p class="lost-password"><a href="forgot-password.html">Forgot password?</a></p>
                                <input type="submit" value="Login" class="return-customer-btn">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Returning Customer End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
@endsection()