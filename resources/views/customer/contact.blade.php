@extends('customer.component.main')

@section('content')

	<div class="main-page-banner pb-50 off-white-bg">
		<div class="container">
			<div class="row">
				<!-- Vertical Menu Start Here -->
				@include('customer.component.navbar1')
				<!-- Vertical Menu End Here -->
			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>
	
	<!-- Breadcrumb Start -->
	<div class="breadcrumb-area mt-30">
		<div class="container">
			<div class="breadcrumb">
				<ul class="d-flex align-items-center">
					<li><a href="/">Trang chủ</a></li>
					<li><a href="contact.html">Liên lạc</a></li>
				</ul>
			</div>
		</div>
		<!-- Container End -->
	</div>	

	<div class="cart-main-area ptb-100 ptb-sm-60">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="row mt10">	
						<div class="col-lg-6 col-md-12">
							<div class="checkbox-form mb-sm-40">
								<h3>Liên hệ chúng tôi</h3>
								<div class="row">

									<div class="col-md-12">
										<div class="checkout-form-list mb-30">
											<label>Họ tên</label>
											<input type="text" name="name" placeholder="Nhập họ tên của bạn">
										</div>
									</div>

									<div class="col-md-12">
										<div class="checkout-form-list mb-30">
											<label>Số điện thoại</label>
											<input type="text" name="phone" placeholder="Nhập số điện thoại">
										</div>
									</div>

									<div class="col-md-12">
										<div class="checkout-form-list mb-30">
											<label>Email</label>
											<input type="text" name="email" placeholder="Nhập email">
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="order-notes mt200">
								<div class="checkout-form-list">
									<label>Nội dung</label>
									<textarea id="checkout-mess" name="content" style="height: 212px;" placeholder="Nội dung"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Row End -->
		</div>
	</div>
@endsection()