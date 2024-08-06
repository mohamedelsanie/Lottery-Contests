
<section id="blog" class="p_3">
    <div class="container-xl">
        <div class="row blog_1">
            <div class="blog_1rdt">
            <p>{{ $page->content }}</p>
                
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
                @include('front.pages.parent-comment', ['comment' => $comment])
            </div><hr>

                @if($comment->children->count() > 0)
                    <ol class="children">
                        {{-- recursively include this view, passing in the new collection of comments to iterate --}}
                        @include('front.pages.child-comment', ['comments' => $comment->children])
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
