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
	<!-- Breadcrumb Start -->
	<div class="breadcrumb-area mt-30">
		<div class="container">
			<div class="breadcrumb">
				<ul class="d-flex align-items-center">
					<li><a href="/">Home</a></li>
					<li class="active"><a href="about.html">About us</a></li>
				</ul>
			</div>
		</div>
		<!-- Container End -->
	</div>

	<div class="about-us pt-100 pt-sm-60 mb50">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="sidebar-img mb-all-30">
						<img src="\customer\img\banner\10.jpg" alt="single-blog-img">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about-desc">
						<h3 class="mb-10 about-title"> About our store</h3>
						<p class="mb-20">
							FDG was established in 1996, is one of the first mobile phone distributors in Hanoi.
							With many years of operation, FDG always brings customers satisfaction with the quality of its 
							products as well as its services, helping customers choose the best and most suitable products.
							As one of the mobile phone stores in Hanoi, FDG always tries harder to be worthy of the company's motto: 
							"What we don't have, you don't need".
						</p>
						
						<p class="mb-20">Therefore, for those who want to buy a new/old iPhone, FDG is the top choice for peace of mind 
							and even if you buy online, you never have to worry about product quality.
							price.
							Thanks for your support! We think you’re pretty awesome. 
							As a token of our gratitude, below is a reward you can use during your next visit. Enjoy!
						</p>
						<p class="mb-20">Need help? Drop us a message,
							We'll answer all your questions
						</p>
						<a href="#" class="return-customer-btn read-more">read more</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Container End -->
	</div>


@endsection()