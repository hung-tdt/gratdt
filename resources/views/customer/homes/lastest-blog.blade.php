<div class="blog-area ptb-95 off-white-bg ptb-sm-55">
    <div class="container">
        <div class="like-product-area"> 
            <h2 class="section-ttitle2 mb-30">Latest blog </h2>
       <!-- Latest Blog Active Start Here -->
       <div class="latest-blog-active owl-carousel">

        @foreach($posts as $key => $post)
           <!-- Single Blog Start -->
           <div class="single-latest-blog">
               <div class="blog-img">
                   <a href="/post/{{ $post->id }}-{{\Str::slug($post->title,'-')}}.html">
                    <img src="{{ $post->thumb }}" alt="blog-image">
                    </a>
               </div>
               <div class="blog-desc">
                   <h4><a href="/post/{{ $post->id }}-{{\Str::slug($post->title,'-')}}.html">{{$post->title}}.</a></h4>
                    <ul class="meta-box d-flex">
                        <li><a href="/post/{{ $post->id }}-{{\Str::slug($post->title,'-')}}.html">By {{$post->author}}</a></li>
                    </ul>
                    <p>{{$post->abstract}}</p>
                    <a class="readmore" href="/post/{{ $post->id }}-{{\Str::slug($post->title,'-')}}.html">Read More</a>
               </div>
               <div class="blog-date">
                    <small class="month">{{ \Carbon\Carbon::parse($post->created_at)->format('F') }}</small>
                     <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d') }}</span>
                </div>
           </div>
           <!-- Single Blog End -->
        @endforeach
       </div>
       <!-- Latest Blog Active End Here -->
        </div>
        <!-- main-product-tab-area-->
    </div>
    <!-- Container End -->
</div>
<!-- Latest Blog s Area End Here -->
