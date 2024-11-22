@extends('customer.component.main')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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

	<div class="breadcrumb-area">
		<div class="container">
			<div class="breadcrumb">
				<ul class="d-flex align-items-center">
					<li><a href="/">Home</a></li>
					<li><a href="login">Profile</a></li>
				</ul>
			</div>
		</div>
	</div>

    <div class="breadcrumb-area mt-30">
		<div class="container">		
			@include('admin.component.alert')
		</div>
	</div>

    <div class="contact-area ptb-100 ptb-md-60 bgcl">
        <div class="container">
            <h3 class="mb-20">Profile</h3>
            <p class="text-capitalize mb-20" style="margin-bottom: 100px">you can edit your profile here</p>
            
            <form id="contact-form" class="contact-form" action="{{ route('customer.editprofile', ['id' => $customer->id]) }}" method="POST" enctype="multipart/form-data">
                <div class="address-wrapper row">
                                   
                    <div class="col-md-3">
                        <div class="address-fname">
                            <label class="control-label fs" for="name">Name</label>
                            <input type="text" id="name" name="name" value="{{ $customer->name }}" placeholder="" class="form-control">
                        </div>
                    </div> 

                    <div class="col-md-3">
                        <div class="address-fname">
                            <label class="control-label fs" for="username">Username</label>
                            <input type="text" id="username" name="username" value="{{ $customer->username }}" placeholder="" class="form-control">
                        </div>
                    </div> 
            
                    <div class="col-md-3">
                        <div class="address-fname">
                            <label class="control-label fs" for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ $customer->phone }}" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="address-fname">
                            <label class="control-label fs" for="email">Email</label>
                            <input type="text" id="email" name="email" value="{{ $customer->email }}" placeholder="" class="form-control">
                        </div>
                    </div> 
                

                
                    <div class="col-md-3">
                        <div class="address-fname">
                            <label class="control-label fs" for="pasword">Password</label>
                            <input type="password" name="password" value="{{ $customer->password }}" placeholder="" class="form-control">
                        </div>
                    </div>                  

                    <div class="col-md-3">
                        <div class="address-fname">
                            <label class="control-label fs" for="pasword_confirm">Comfirm password</label>
                            <input type="password" id="pasword_confirm" name="pasword_confirm" value="{{ $customer->password }}" placeholder="" class="form-control">
                        </div>
                    </div>  
            
                    <div class="col-md-6">
                        <div class="address-fname">
                            <label for="thumb" class="fs">Avatar</label>
                            <input type="file" name="thumb" class="form-control" id="upload">
                            <div class="mt22" id="image_show">
                                <a href="{{ $customer->thumb }}" target="_blank">
                                <img src="{{ $customer->thumb }}" alt="" width="100px">
                                </a>
                            </div>
                            <input type="hidden" name="thumb" value="{{ $customer->thumb }}" id="thumb">
                        </div>
                    </div>

                   
                    <label class="control-label fs" style="margin-left: 20px">Your address</label>
                    <div class="col-md-2 mt50">
                        <div class="address-fname">
                            <select name="province_id" id="province" class="form-control" required>
                                <option value="">Select Province/City</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}" {{ $province->id == $customer->province_id ? 'selected' : '' }}>{{ $province->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2 mt50">
                        <div class="address-email">
                            <select name="district_id" id="district" class="form-control" required>
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}" {{ $district->id == $customer->district_id ? 'selected' : '' }}>{{ $district->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2 mt50">
                        <div class="address-fname">
                            <select name="ward_id" id="ward" class="form-control" required>
                                <option value="">Select Ward</option>
                                @foreach($wards as $ward)
                                    <option value="{{ $ward->id }}" {{ $ward->id == $customer->ward_id ? 'selected' : '' }}>{{ $ward->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mt50">
                        <div class="address-fname">                    
                            <input type="text" name="address" value="{{ $customer->address }}" placeholder="Enter specific address" class="form-control">
                        </div>
                    </div>        

                </div>
                <p class="form-message">
                </p><div class="footer-content mail-content clearfix">
                    <div class="send-email float-md-right">
                        <input value="Submit" class="return-customer-btn" type="submit">
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>


@endsection()


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/customer/fix/addressedit.js"></script>

<script src="/customer/fix/main.js"></script>



