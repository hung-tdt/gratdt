<header>
	<!-- Header Top Start Here -->
	<div class="header-top-area">
		<div class="container">
			<!-- Header Top Start -->
			<div class="header-top">
				<ul>
					<li><a href="shop.html">Free Shipping on order over $99</a></li>
					<li><a href="/cart">Shopping Cart</a></li>
					<li><a href="{{ route('checkout') }}">Checkout</a></li>
				</ul>
				<ul>                                          
					{{-- <li><span>Language</span> <a href="#">English<i class="lnr lnr-chevron-down"></i></a>
						<!-- Dropdown Start -->
						<ul class="ht-dropdown">
							<li><a href="#"><img src="customer\img\header\1.jpg" alt="language-selector">English</a></li>
							<li><a href="#"><img src="customer\img\header\2.jpg" alt="language-selector">Francis</a></li>
						</ul>
						<!-- Dropdown End -->
					</li>
					<li><span>Currency</span><a href="#"> USD $ <i class="lnr lnr-chevron-down"></i></a>
						<!-- Dropdown Start -->
						<ul class="ht-dropdown">
							<li><a href="#">&#36; USD</a></li>
							<li><a href="#"> € Euro</a></li>
							<li><a href="#">&#163; Pound Sterling</a></li>
						</ul>
						<!-- Dropdown End -->
					</li> --}}
					<li>
						<span>My Account <i class="lnr lnr-chevron-down"></i></span>
						<!-- Dropdown Start -->
						<ul class="ht-dropdown">
							@if (auth('customer')->check())
								
								<li><a href="{{ route('customer.profile', ['id' => $customer->id])}}">Profile</a></li>
								<li>
									<a href="{{ route('customer.logout') }}" >Logout</a>
								</li>
							@else
								
								<li><a href="{{ url('/login.html') }}">Login</a></li>
								<li><a href="{{ url('/register.html') }}">Register</a></li>
							@endif
						</ul>
						<!-- Dropdown End -->
					</li>
				</ul>
			</div>
			<!-- Header Top End -->
		</div>
		<!-- Container End -->
	</div>
	<!-- Header Top End Here -->
	<!-- Header Middle Start Here -->
	<div class="header-middle ptb-15">
		<div class="container">
			<div class="row align-items-center no-gutters">
				<div class="col-lg-3 col-md-12">
					<div class="logo mb-all-30">
						<a href="index.html"><img src="customer\img\logo\logo.png" alt="logo-image"></a>
					</div>
				</div>
				<!-- Categorie Search Box Start Here -->
				@include('customer.component.search')
				<!-- Categorie Search Box End Here -->
				<!-- Cart Box Start Here -->
				<div class="col-lg-4 col-md-12">
					<div class="cart-box mt-all-30">
						<ul class="d-flex justify-content-lg-end justify-content-center align-items-center">
							@include('customer.carts.cart')

							<li><a href="/wishlist/list"><i class="lnr lnr-heart"></i><span class="my-cart"><span>Wish</span><span>list</span></span></a>
							</li>
							@if(Auth::guard('customer')->check())
								<li>
									<a href="/profile/{{ Auth::guard('customer')->id() }}">
										<i class="lnr lnr-user"></i>
										<span class="my-cart">
											<span><strong>Profile</strong> </span>
											<span> edit profile</span>
										</span>
									</a>
								</li>
							@else
								<li>
									<a href="/login.html">
										<i class="lnr lnr-user"></i>
										<span class="my-cart">
											<span><strong>Sign in</strong> Or</span>
											<span> Join My Site</span>
										</span>
									</a>
								</li>
							@endif

						</ul>
					</div>
				</div>
				<!-- Cart Box End Here -->
			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>
	<!-- Header Middle End Here -->
	<!-- Header Bottom Start Here -->
	<div class="header-bottom  header-sticky">
		<div class="container">
			<div class="row align-items-center">
				 <div class="col-xl-3 col-lg-4 col-md-6 vertical-menu d-none d-lg-block">
					<span class="categorie-title">Shop by Categories </span>
				</div>                       
				<div class="col-xl-9 col-lg-8 col-md-12 ">
					<nav class="d-none d-lg-block">
						<ul class="header-bottom-list d-flex">
							<li><a href="/">home</a>

							</li>
							<li><a href="shop.html">shop</a>
							</li>
							<li><a href="posts.html">Blog<i class="fa fa-angle-down"></i></a>
								<!-- Home Version Dropdown Start -->
								@php $postCategoriesHtml =  \App\Helpers\Helper::postCategories($postCategories); @endphp
								<ul class="ht-dropdown dropdown-style-two">
									{!! $postCategoriesHtml !!}
								</ul>
								<!-- Home Version Dropdown End -->
							</li>
							
							</li>
							<li><a href="/coupons">Coupons</i></a>
							</li>
							<li><a href="about.html">About us</a></li>
							@if(Auth::guard('customer')->check())
								<li><a href="/cart">Cart</a></li>
								<li><a href="/order-history">Your order</a></li>
								<li><a href="/wishlist/list">Your wishlist</a></li>
							@endif
							
						</ul>
					</nav>
				</div>
			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>
	<!-- Header Bottom End Here -->
	<!-- Mobile Vertical Menu Start Here -->
	<div class="container d-block d-lg-none">
		<div class="vertical-menu mt-30">
			<span class="categorie-title mobile-categorei-menu">Shop by Categories</span>
			<nav>  
				<div id="cate-mobile-toggle" class="category-menu sidebar-menu sidbar-style mobile-categorei-menu-list menu-hidden ">
					<ul>
						<li class="has-sub"><a href="#">Automotive & Motorcycle </a>
							<ul class="category-sub">
								<li class="has-sub"><a href="shop.html">Office chair</a>
									<ul class="category-sub">
										<li><a href="shop.html">Bibendum Cursus</a></li>
										<li><a href="shop.html">Dignissim Turpis</a></li>
										<li><a href="shop.html">Dining room</a></li>
										<li><a href="shop.html">Dining room</a></li>
									</ul>
								</li>
								<li class="has-sub"><a href="shop.html">Purus Lacus</a>
									<ul class="category-sub">
										<li><a href="shop.html">Magna Pellentesq</a></li>
										<li><a href="shop.html">Molestie Tortor</a></li>
										<li><a href="shop.html">Vehicula Element</a></li>
										<li><a href="shop.html">Sagittis Blandit</a></li>
									</ul>
								</li>
								<li><a href="shop.html">gps accessories</a></li>
								<li><a href="shop.html">Microphones</a></li>
								<li><a href="shop.html">Wireless Transmitters</a></li>
							</ul>
							<!-- category submenu end-->
						</li>
						<li class="has-sub"><a href="#">Sports & Outdoors</a>
							<ul class="category-sub">
								<li class="menu-tile">Cameras</li>
								<li><a href="shop.html">Cords and Cables</a></li>
								<li><a href="shop.html">gps accessories</a></li>
								<li><a href="shop.html">Microphones</a></li>
								<li><a href="shop.html">Wireless Transmitters</a></li>
							</ul>
							<!-- category submenu end-->
						</li>
						<li class="has-sub"><a href="#">Home & Kitchen</a>
							<ul class="category-sub">
								<li><a href="shop.html">kithen one</a></li>
								<li><a href="shop.html">kithen two</a></li>
								<li><a href="shop.html">kithen three</a></li>
								<li><a href="shop.html">kithen four</a></li>
							</ul>
							<!-- category submenu end-->
						</li>
						<li class="has-sub"><a href="#">Phones & Tablets</a>
							<ul class="category-sub">
								<li><a href="shop.html">phone one</a></li>
								<li><a href="shop.html">Tablet two</a></li>
								<li><a href="shop.html">Tablet three</a></li>
								<li><a href="shop.html">phone four</a></li>
							</ul>
							<!-- category submenu end-->
						</li>
						<li class="has-sub"><a href="#">TV & Video</a>
							<ul class="category-sub">
								<li><a href="shop.html">smart tv</a></li>
								<li><a href="shop.html">real video</a></li>
								<li><a href="shop.html">Microphones</a></li>
								<li><a href="shop.html">Wireless Transmitters</a></li>
							</ul>
							<!-- category submenu end-->
						</li>
						<li><a href="#">Beauty</a> </li>
						<li><a href="#">Sport & tourisim</a></li>
						<li><a href="#">Meat & Seafood</a></li>
					</ul>
				</div>
				<!-- category-menu-end -->
			</nav>
		</div>
	</div>
	<!-- Mobile Vertical Menu Start End -->
</header>