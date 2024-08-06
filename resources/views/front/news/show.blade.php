<x-app-layout>
    
<section id="center" class="center_about">
	<div class="center_om clearfix">
		<div class="container">
			<div class="row center_o1">
				<div class="col-md-12">
					<h2 class="text-white">{{ $post->title }}</h2>
					<h6 class="mb-0 mt-3 fw-normal col_oran">
                        <a class="text-light" href="{{ route('homepage') }}">{{ __('front/common.home') }}</a> 
                        <span class="mx-2 col_light">/</span> 
                        <a class="text-light" href="{{ getCatLink($post->category->slug) }}">{{ $post->category->title }}</a> 
                        <span class="mx-2 col_light">/</span> 
                        {{ $post->title }}</h6>
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
		        <li class="d-inline-block"><a href="{{ getTagLink($recenttag->id) }}">{{ $recenttag->tag->title }}</a></li>
                @endforeach
		    </ul>
	        </div>
		 </div><br />
		</div>
		<div class="col-md-8">
        
		 <div class="blog_1rdt">
	   <div class="blog_1rdt1">
	      <div class="grid clearfix">
				  <figure class="effect-jazz mb-0">
                    <img src="{{ $post->image }}" height="450" class="w-100" alt="{{ $post->title }}">
				  </figure>
			  </div>
	   </div>
	   <div class="blog_1rdt2">
		    <h6 class="mt-3 font_14"><i class="fa fa-calendar col_oran me-1"></i> 03 Feb, 2022  <i class="fa fa-comments col_oran me-1 ms-3"></i> 3 {!! __('front/common.news_comments') !!}</h6>
			<br />
            <p>{!! $post->content !!}</p>
			<!--
            <blockquote class="blockquote bg_light p-4">
                <p>Provident fugiat tempora architecto mollitia quos maiores perspiciatis obcaecati placeat aunty koi thako Architecto eaque accusamus minima in earum impedit atque</p>
                <h6 class="fw-normal mb-0"><strong>- Dapibus Diam </strong>of Google Inc.</h6>
            </blockquote>
            -->		
            <hr>	
	    <div class="blog_1rdt2i row">
        @if(!empty($tags))
		 <div class="col-md-7">
		  <div class="blog_1rdt2il">
		    <h4>{!! __('front/common.news_tags') !!}</h4>
			<ul class="mb-0">
                @foreach($tags as $tag)
                    <li class="d-inline-block"><a href="{{ getTagLink($tag->id) }}">{{ $tag->tag->title }}</a></li>
                @endforeach
		</ul>
		  </div>
		 </div>
        @endif
		 
		 <div class="col-md-5">
		  <div class="blog_1rdt2ir text-end">
		   <h4>{{ __('front/post_types.video.share') }}:</h4>
		   <ul class="social-network social-circle mb-0">
                <li><a href="https://plus.google.com/share?url={{ getNewsLink($post->slug) }}" class="icoRss" title="Rss"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ getNewsLink($post->slug) }}" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/intent/tweet?url={{ getNewsLink($post->slug) }}&text={{ $post->title }}" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
            </ul>
		  </div>
		 </div>
		</div>	
	   </div><hr>
	   <div class="blog_1rdt3 mt-4">
	    <h2>{!! __('front/common.news_recent') !!}</h2>
		<div class="row blog_h_1 mt-3">
    
            @foreach(recentNews(2) as $recent2)
            
			 <div class="col-md-6">
				<div class="blog-item">
				  <div class="blog_h_1m position-relative clearfix">
				   <div class="blog_h_1mi clearfix">
					 <div class="grid clearfix">
							  <figure class="effect-jazz mb-0">
								<a href="{{ getNewsLink($recent2->slug) }}"><img src="{{ $recent2->image }}" class="w-100" alt="{{ $recent2->title }}"></a>
							  </figure>
						  </div>
				   </div>
				   <div class="blog_h_1mi1 position-absolute clearfix top-0 w-100 p-3">
					<h6 class="mb-0 fw-normal"><a href="{{ getCatLink($recent2->category->slug) }}" class="button_1">{{ $recent2->category->title }}</a></h6>
				   </div>
				  </div>
				  <div class="blog_h_1m1 bg-white">
					<h4><a href="{{ getNewsLink($recent2->slug) }}">{{ $recent2->title }}</a></h4>
					<p>{!! Str::words($recent2->description, 20,'...') !!}</p>
					<h6 class="mb-0 mt-3"><a class="button" href="{{ getNewsLink($recent2->slug) }}">{{ __('front/post_types.posts.view_post') }} <i class="fa fa-check-circle ms-1"></i></a></h6>
				  </div>
				</div>
			 </div>
            @endforeach
			
  </div>
	   </div>
	   
       @if(getSetting('comments_mode') == 'open')
            @if($post->comments_status == 'open')
	   <div class="blog_1rdt3 mt-4 bg_light p-4">
	    <div class="blog_1rdt3it row">
		 <div class="col-md-12">
		  <h2 class="mb-4">(@if(!empty($comments)){{ count($comments) }}@else 0 @endif ) {{ __('front/post_types.comments.title') }}:</h2>
		 </div> 
		</div>

        @foreach($comments as $comment)
            {{-- show the comment markup --}}
            <div class="blog_1rdt3i row">
                @include('front.news.parent-comment', ['comment' => $comment])
                </div><hr>
            @if($comment->children->count() > 0)
                <ol class="children">
                    {{-- recursively include this view, passing in the new collection of comments to iterate --}}
                    @include('front.news.child-comment', ['comments' => $comment->children])
                </ol>
            @endif
        @endforeach

        <div class="blog_1rdt3it row">
                <div class="col-md-12">
                <h2 class="mb-4">{{ __('front/post_types.comments.add') }} :</h2>
                </div> 
            </div>
            <form action="{{ route('post.add_comment',$post->slug) }}" method="post">
                @csrf
                <div class="blog_1rdt3i2 row">
                    <div class="col-md-6">
                        <div class="blog_1rdt3i2l">
                            @auth()
                            <input type="text" name="name" value="{{ old('name') ? old('name') : auth()->user()->name }}" class="form-control mb-30" placeholder="{{ __('front/post_types.comments.name') }}">
                            @else
                                <input type="text" name="name" value="{{ old('name') ? old('name') : '' }}" class="form-control mb-30 @error('name')  border border-danger @enderror" placeholder="{{ __('front/post_types.comments.name') }}">
                            @endif
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="blog_1rdt3i2l">
                        @auth()
                        <input type="email" name="email" value="{{ old('email') ? old('email') : auth()->user()->email }}" class="form-control mb-30" placeholder="{{ __('front/post_types.comments.email') }}">
                        @else
                            <input type="email" name="email" value="{{ old('email') ? old('email') : '' }}" class="form-control mb-30 @error('email')  border border-danger @enderror" placeholder="{{ __('front/post_types.comments.email') }}">
                        @endif
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror

                        </div>
                    </div>
                </div>
                <div class="blog_1rdt3i2 row mt-3">
                    <div class="col-md-12">
                        <div class="blog_1rdt3i2l">
                            <textarea name="comment" class="form-control form_text mb-30 @error('comment')  border border-danger @enderror" placeholder="{{ __('front/post_types.comments.comment') }}"></textarea>
                            @error('comment')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div> 
                    <div class="col-md-12">
                    <div class="blog_1rdt3i2l">
                        <ul class="rate-area">
                            <input type="radio" id="5-star" name="comment_stars" value="5" /><label for="5-star" title="Amazing">5 stars</label>
                            <input type="radio" id="4-star" name="comment_stars" value="4" /><label for="4-star" title="Good">4 stars</label>
                            <input type="radio" id="3-star" name="comment_stars" value="3" /><label for="3-star" title="Average">3 stars</label>
                            <input type="radio" id="2-star" name="comment_stars" value="2" /><label for="2-star" title="Not Good">2 stars</label>
                            <input type="radio" id="1-star" name="comment_stars" value="1" /><label for="1-star" title="Bad">1 star</label>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="blog_1rdt3i2 row mt-3">
                    <div class="col-md-12">
                    <div class="blog_1rdt3i2l">
                    

                    <input name="post_id" type="text" class="hidden" value="{{ $post->id }}" />
                    <h6 class="mb-0 mt-3"><button type="submit" class="button roberto-btn btn-3 mt-15">{{ __('front/post_types.comments.post') }} <i class="fa fa-check-circle ms-1"></i></button></h6>
                    </div>
                    </div> 
                </div>
            </form>
            </div>
     @else
            <div class="comment_area mb-50 clearfix">
                <h3>{{ __('front/post_types.comments.closed') }}</h3>
            </div>
        @endif
    @else
        <div class="comment_area mb-50 clearfix">
            <h3>{{ __('front/post_types.comments.closed') }}</h3>
        </div>
    @endif

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
    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                /******************/
                var buttonclicked;
                $(".comment-meta .reply").click(function () {
                    if( buttonclicked!= true ) {
                        buttonclicked= true;
                        var commentId = $(this).data('id');
                        var input = $('<input type="text" class="hidden" name="parent" value="'+commentId+'" />');
                        $(".roberto-contact-form form").append(input);
                    }else{
                        $(".roberto-contact-form form input[name='parent']").remove();
                        buttonclicked= false;
                    }
                });

                $(".rate-area label").click(function () {
                    $('html, body').stop().animate({
                        'scrollTop': $('.roberto-contact-form form').offset().top
                    }, 900, 'swing', function () {
                    });

                });
                $('a[href^="#"]').on('click',function (e) {
                    e.preventDefault();
                    var target = this.hash;
                    var $target = $(target);
                    $('html, body').stop().animate({
                        'scrollTop': $target.offset().top
                    }, 900, 'swing', function () {
                        // window.location.hash = target;
                    });
                });
                /******************/
            });
        </script>
    @endsection

    @section('page_title'){{ __('front/post_types.posts.title') }} - {{ $post->title }}@endsection
</x-app-layout>