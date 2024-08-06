<x-app-layout>
    
<section id="center" class="center_about">
	<div class="center_om clearfix">
		<div class="container">
			<div class="row center_o1">
				<div class="col-md-12">
					<h2 class="text-white">{{ $category->title }}</h2>
					<h6 class="mb-0 mt-3 fw-normal col_oran">
                        <a class="text-light" href="{{ route('homepage') }}">{{ __('front/common.home') }}</a> 
                        <span class="mx-2 col_light">/</span> 
                        <a class="text-light" href="{{ route('news') }}">{{ __('front/post_types.posts.title') }}</a> 
                        <span class="mx-2 col_light">/</span> 
                        {{ $category->title }}</h6>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="blog" class="p_3">
   <div class="container">
	 <div class="row blog_1">
	    <div class="col-md-4">
		 <div class="blog_1l">
		    <div class="blog_1l1">
		 </div>
         
		    <div class="blog_1l2 mt-4  p-3 clearfix">
                <h4>{{ __('front/post_types.widgets.news') }}</h4>
                <hr class="line mb-4">
                @foreach(recentNews(4) as $recent)
                <h6><i class="fa fa-chevron-right font_14 me-1 col_oran"></i> <a href="{{ getNewsLink($recent->slug) }}">{{ $recent->title }}</a></h6><hr>
                @endforeach
                
	        </div>
         
		    <div class="blog_1l2 mt-4  p-3 clearfix">
                <h4>{{ __('front/post_types.widgets.newscats') }}</h4>
                <hr class="line mb-4">
                @foreach(recentNewsCats(4) as $recentcat)
                <h6><i class="fa fa-chevron-right font_14 me-1 col_oran"></i> <a href="{{ getCatLink($recentcat->slug) }}">{{ $recentcat->title }}</a></h6><hr>
                @endforeach
                
	        </div>
			
			
			<div class="blog_1l2 mt-4  p-3 clearfix">
			<h4>{{ __('front/post_types.widgets.tags') }}</h4>
			<hr class="line">
		     <ul class="mb-0">
                @foreach(recenttags(4) as $recenttag)
		        <li class="d-inline-block"><a href="{{ getTagLink($recenttag->id) }}">{{ $recenttag->title }}</a></li>
                @endforeach
		    </ul>
	        </div>
		 </div><br />
		</div>
		<div class="col-md-8">
		
		 <div class="blog_1r">
		    <div class="row blog_h_1">
                    @if(!empty($posts))
                        @foreach($posts as $post)
                            
			 <div class="col-md-6">
				<div class="blog-item">
				  <div class="blog_h_1m position-relative clearfix">
				   <div class="blog_h_1mi clearfix">
					 <div class="grid clearfix">
							  <figure class="effect-jazz mb-0">
								<a href="{{ getNewsLink($post->slug) }}"><img src="{{ $post->image }}" class="w-100" alt="{{ $post->title }}"></a>
							  </figure>
						  </div>
				   </div>
				   <div class="blog_h_1mi1 position-absolute clearfix top-0 w-100 p-3">
					<h6 class="mb-0 fw-normal"><a href="{{ getCatLink($post->category->slug) }}" class="button_1">{{ $post->category->title }}</a></h6>
				   </div>
				  </div>
				  <div class="blog_h_1m1 bg-white">
					<h4><a href="{{ getNewsLink($post->slug) }}">{{ $post->title }}</a></h4>
					<p>{!! Str::words($post->description, 20,'...') !!}</p>
					<h6 class="mb-0 mt-3"><a class="button" href="{{ getNewsLink($post->slug) }}">{{ __('front/post_types.posts.view_post') }} <i class="fa fa-check-circle ms-1"></i></a></h6>
				  </div>
				</div>
			 </div>
                        @endforeach
            </div>
                <div class="pages mt-4  text-center">
                    <div class="col-md-12">
                        <ul class="mb-0">
                            {!! $posts->links() !!}
                        </ul>
                    </div>
                </div>
                    @endif
            
            </div>
           </div>
        </div>
    </div>
   </section>
   
   
   <section id="ride">
   <div class="ride_m">
    <div class="container">
    <div class="row ride_1">
     <div class="col-md-8">
      <div class="ride_1l">
       <h1 class="text-white">{{ getSetting('contact_title') }}</h1>
       <p class="text-light mb-0 fs-4 mt-3">{{ getSetting('contact_desc') }}</p>
      </div>
     </div>
     <div class="col-md-4">
      <div class="ride_1r mt-4 text-end">
        <h6 class="mb-0"><a class="button_2" href="{{ getPageLink(getSetting('contact_page')) }}">{{ __('front/common.contact') }} <i class="fa fa-check-circle ms-1"></i> </a></h6>
      </div>
     </div>
    </div>
   </div>
   </div>
   </section>

    <br />
    <br />
    @section('page_title'){{ __('front/post_types.posts.title') }} - {{ $category->title }}@endsection
</x-app-layout>