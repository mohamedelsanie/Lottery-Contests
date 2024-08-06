
<section id="blog" class="p_3">
   <div class="container">
	 <div class="row blog_1">

     
		 <div class="blog_1rdt">
	   <div class="blog_1rdt1">
	      <div class="grid clearfix">
				  <figure class="effect-jazz mb-0">
                    <img src="{{ $page->image }}" height="450" class="w-100" alt="{{ $page->title }}">
				  </figure>
			  </div>
	   </div>
	   <div class="blog_1rdt2">
		    <h6 class="mt-3 font_14"><i class="fa fa-calendar col_oran me-1"></i> 03 Feb, 2022 <i class="fa fa-user col_oran me-1 ms-3"></i> Admin <i class="fa fa-comments col_oran me-1 ms-3"></i> 3 Comments</h6>
			<br />
            <p>{!! $page->content !!}</p>
			<!--
            <blockquote class="blockquote bg_light p-4">
                <p>Provident fugiat tempora architecto mollitia quos maiores perspiciatis obcaecati placeat aunty koi thako Architecto eaque accusamus minima in earum impedit atque</p>
                <h6 class="fw-normal mb-0"><strong>- Dapibus Diam </strong>of Google Inc.</h6>
            </blockquote>
            -->		
            <hr>	
	    <div class="blog_1rdt2i row">
		 
		 <div class="col-md-5">
		  <div class="blog_1rdt2ir text-end">
		   <h4>{{ __('front/post_types.video.share') }}:</h4>
		   <ul class="social-network social-circle mb-0">
                <li><a href="https://plus.google.com/share?url={{ getPageLink($page->id) }}" class="icoRss" title="Rss"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ getPageLink($page->id) }}" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/intent/tweet?url={{ getPageLink($page->id) }}&text={{ $page->title }}" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
            </ul>
		  </div>
		 </div>
		</div>	
	   </div><hr>
       </div>
	   </div>
       
       @if(getSetting('comments_mode') == 'open')
            @if($page->comments_status == 'open')
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
            <form action="{{ route('page.add_comment',$page->slug) }}" method="post">
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
                    

                    <input name="page_id" type="text" class="hidden" value="{{ $page->id }}" />
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
