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
					<li><a href="/">Trang chủ</a></li>
					<li><a href="login">Đăng nhập</a></li>
				</ul>
			</div>
		</div>
	</div>

    <div class="breadcrumb-area mt-30">
		<div class="container">		
			@include('admin.component.alert')
		</div>
	</div>
    
    
    <div class="register-account ptb-100 ptb-sm-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="register-title">
                        <h3 class="mb-10">REGISTER ACCOUNT</h3>
                        <p class="mb-10">If you already have an account with us, please login at the login page.</p>
                    </div>
                </div>
            </div>
            <!-- Row End -->
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-register" action="{{ route('customer.register.store') }}" method="POST">
                        <fieldset>
                            <legend>Your Personal Details</legend>
                            <div class="form-group d-md-flex align-items-md-center">
                                <label class="control-label col-md-2" for="f-name"><span class="require">*</span>Name</label>
                                <div class="col-md-10">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group d-md-flex align-items-md-center">
                                <label class="control-label col-md-2" for="l-name"><span class="require">*</span>User Name</label>
                                <div class="col-md-10">
                                    <input type="text" name="username" class="form-control" placeholder="User Name">
                                </div>
                            </div>
                            <div class="form-group d-md-flex align-items-md-center">
                                <label class="control-label col-md-2" for="email"><span class="require">*</span>Enter you email address here...</label>
                                <div class="col-md-10">
                                    <input type="email" name="email" class="form-control"placeholder="Enter you email address here...">
                                </div>
                            </div>
                            <div class="form-group d-md-flex align-items-md-center">
                                <label class="control-label col-md-2" for="number"><span class="require">*</span>Telephone</label>
                                <div class="col-md-10">
                                    <input type="number" name="phone" class="form-control" placeholder="Telephone">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Your Password</legend>
                            <div class="form-group d-md-flex align-items-md-center">
                                <label class="control-label col-md-2" for="pwd"><span class="require">*</span>Password:</label>
                                <div class="col-md-10">
                                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group d-md-flex align-items-md-center">
                                <label class="control-label col-md-2" for="pwd-confirm"><span class="require">*</span>Confirm Password</label>
                                <div class="col-md-10">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                                </div>
                            </div>
                        </fieldset>
                        
                        <div class="terms">
                            <div class="float-md-right">
                                <input type="submit" value="Continue" class="return-customer-btn">
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>

@endsection()