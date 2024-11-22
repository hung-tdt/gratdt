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
					<li class="active"><a href="posts.html">Blog</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="blog ptb-100  ptb-sm-60">
		<div class="container">
			<div class="main-blog">
				<div class="row">

					@foreach($posts as $key => $post)

					<!-- Single Blog Start -->
					<div class="col-lg-6 col-sm-12">
					   <div class="single-latest-blog fixh">
						   <div class="blog-img">
							   <a href="/post/{{ $post->id }}-{{\Str::slug($post->title,'-')}}.html">
									<img src="{{ $post->thumb }}" alt="blog-image">
								</a>
						   </div>
						   <div class="blog-desc">
							   <h4><a href="/post/{{ $post->id }}-{{\Str::slug($post->title,'-')}}.html">
									{{$post->title}}</a>
								</h4>
								<ul class="meta-box d-flex">
									<li><a href="#">By {{$post->author}} </a></li>
								</ul>
								<p>{{$post->abstract}}</p>
								<a class="readmore" href="/post/{{ $post->id }}-{{\Str::slug($post->title,'-')}}.html">
									Read more
								</a>
						   </div>
						   <div class="blog-date">
								<small class="month">{{ \Carbon\Carbon::parse($post->created_at)->format('F') }}</small>
							 	<span>{{ \Carbon\Carbon::parse($post->created_at)->format('d') }}</span>
							</div>
					   </div>
					</div>
					<!-- Single Blog End -->
					@endforeach
				</div>
				<!-- Row End -->
				<div class="row">
					<div class="col-sm-12">
						<div class="pro-pagination">
							{{ $posts->links('pagination::bootstrap-4') }}
						</div>
							<!-- Product Pagination Info -->
					</div>
				</div>
				<!-- Row End -->
			</div>
		</div>
		<!-- Container End -->
	</div>
@endsection()