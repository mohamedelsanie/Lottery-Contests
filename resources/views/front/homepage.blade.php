<x-app-layout>
    
@if(getSetting('slider_st') == 'enabled')
		<!--welcome-hero start -->
		<section id="home" class="welcome-hero">
			<div class="header-slide">
            @php
                $sliders = json_decode(getSetting('slider'), true);
                $slides = array_values($sliders);
            @endphp
            @if(!empty($slides))
                @if(is_array($slides))
                    @php $ii = 0; @endphp
                    @for($i = 0; $i < count($slides[0]); $i++)
                    
                    <div class="slider-item" style="background: url('{{ $slides[2][$i] }}') no-repeat;">
                        <div class="welcome-hero-txt">
                            <div class="container">
                                <h2>{{ $slides[0][$i] }}</h2> 
                                <p>
                                {{ $slides[1][$i] }} 
                                </p>
                                <!-- <a href="{{ $slides[3][$i] }}" class="btn roberto-btn btn-2" data-animation="fadeInLeft" data-delay="800ms">{{ $slides[4][$i] }}</a>-->
                            </div>
                        </div>
                    </div>
                    

                    @php $ii++; @endphp
                    @endfor
                @endif
            @endif
			</div>
		</section><!--/.welcome-hero-->
		<!--welcome-hero end -->
    @endif

				
		
    @if(getSetting('search_st') == 'enabled')
		<!--list-topics start -->
		<section id="list-topics" class="list-topics">
			<div class="container">
				<div class="list-topics-content">
					
					<div class="model-search-content">
						<div class="container">
                            <form action="{{ route('tours.subscribe') }}" method="post" enctype="multipart/form-data">
                                @csrf
							    <div class="row">
									<div class="col-md-offset-1 col-lg-3 col-md-6 col-sm-6 col-12">
										<div class="single-model-search">
											<h2>{!! __('front/common.subscribe_name') !!}</h2>
											<div class="model-select-icon">
												<input class="form-control" name="name" placeholder="{!! __('front/common.subscribe_name_p') !!}" type="text"><!-- /.input-->
                                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div><!-- /.model-select-icon -->
										</div>
										<div class="single-model-search">
											<h2>{!! __('front/common.subscribe_contest') !!}</h2>
											<div class="model-select-icon">
												<select class="form-control" name="contest">
                                                <option value="">{!! __('front/common.subscribe_contest_p') !!}</option><!-- /.option-->
                                                    @foreach($contests as $contest)
                                                        @if(contest_status($contest->to_date) == true)
                                                        <option value="{{ $contest->id }}">{{ $contest->title }} -- {!! __('front/common.subscribe_contest_price') !!} = {{ $contest->price }}</option><!-- /.option-->
                                                        @endif
                                                    @endforeach
												</select><!-- /.select-->
                                                @error('contest')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div><!-- /.model-select-icon -->
										</div>
									</div>
									<div class="col-md-offset-1 col-lg-3 col-md-6 col-sm-6 col-12">
										<div class="single-model-search">
											<h2>{!! __('front/common.subscribe_adress') !!}</h2>
											<div class="model-select-icon">
												<input class="form-control" name="adress" placeholder="{!! __('front/common.subscribe_adress_p') !!}" type="text"><!-- /.input-->
                                                @error('adress')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div><!-- /.model-select-icon -->
										</div>
										<div class="single-model-search">
											<h2>{!! __('front/common.subscribe_phone') !!}</h2>
											<div class="model-select-icon">
												<input class="form-control" name="phone" placeholder="{!! __('front/common.subscribe_phone_p') !!}" type="text"><!-- /.input-->
											</div><!-- /.model-select-icon -->
										</div>
									</div>
									<div class="col-md-offset-1 col-lg-3 col-md-6 col-sm-6 col-12">
										<div class="single-model-search">
											<h2>{!! __('front/common.subscribe_user_name') !!}</h2>
											<div class="model-select-icon">
												<input class="form-control" name="user_name" placeholder="{!! __('front/common.subscribe_user_name_p') !!}" value="{{ $user_name }}" type="text" readonly><!-- /.input-->
                                                @error('user_name')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div><!-- /.model-select-icon -->
										</div>
										<div class="single-model-search">
											<h2>{!! __('front/common.subscribe_reset') !!}</h2>
											<div class="model-select-icon">
												<input class="form-control" name="img" placeholder="{!! __('front/common.subscribe_reset_p') !!}" type="file"><!-- /.input-->
                                                @error('img')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div><!-- /.model-select-icon -->
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-6 col-12">
										<div class="single-model-search text-center">
											<button class="welcome-btn model-search-btn" type="submit">
											{!! __('front/common.subscribe_submit') !!}
											</button>
										</div>
									</div>
							    </div>
                            </form>
						</div>
					</div>
					
				</div>
			</div><!--/.container-->

		</section><!--/.list-topics-->
		<!--list-topics end-->
        @endif

		<!--works start -->
		<section id="works" class="works">
			<div class="container">
				<div class="section-header">
					<h2>{{ getSetting('about_title') }}</h2>
					<p>{{ getSetting('about_desc') }}</p>
				</div><!--/.section-header-->
				<div class="works-content">
					<div class="row">
                    @php
                        $about_blocks = json_decode(getSetting('about_blocks'), true);
                        $blocks = array_values($about_blocks);
                    @endphp
                    @if(!empty($blocks))
                        @if(is_array($blocks))
                            @php $ii = 0; @endphp
                            @for($i = 0; $i < count($blocks[0]); $i++)
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-how-works">
                                        <div class="single-how-works-icon">
                                            <i class="flaticon-lightbulb-idea"></i>
                                        </div>
                                        <h2><a>{{ $blocks[0][$i] }}</a></h2>
                                        <p>
                                        {{ $blocks[1][$i] }}
                                        </p>
                                        <button class="welcome-hero-btn how-work-btn" onclick="window.location.href='{{ $blocks[2][$i] }}'">
                                        {{ $blocks[3][$i] }}
                                        </button>
                                    </div>
                                </div>
                                @php $ii++; @endphp
                            @endfor
                        @endif
                    @endif
					</div>
				</div>
			</div><!--/.container-->
		
		</section><!--/.works-->
		<!--works end -->

		<!--explore start -->
		<section id="explore" class="explore">
			<div class="container">
				<div class="section-header">
					<h2>{{ getSetting('tours_title') }}</h2>
					<p>{{ getSetting('tours_desc') }}</p>
				</div><!--/.section-header-->
				<div class="explore-content">
					<div class="row">
                        
                        @if(!empty($tours))
                            @foreach($tours as $post)
                            
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<div class="single-explore-item">
								<div class="single-explore-img">
									<img src="{{ $post->image }}" alt="{{ $post->title }}">
									<div class="single-explore-img-info">
										@if(!empty($post->label_text))
                                        <button style="background-color:{{ $post->label_color }};" onclick="window.location.href='#'">{{ $post->label_text }}</button>
										@endif
                                        <div class="single-explore-image-icon-box">
											<ul>
												<li>
													<div class="single-explore-image-icon">
														<i class="fa fa-arrows-alt"></i>
													</div>
												</li>
												<li>
													<div class="single-explore-image-icon">
														<i class="fa fa-bookmark-o"></i>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="single-explore-txt bg-theme-1">
									<h2><a href="{{ getTourLink($post->slug) }}">{{ $post->title }}</a></h2>
									<p class="explore-rating-price">
                                    @if(contest_status($post->to_date) == true)
										<span class="explore-rating">{!! __('front/common.contest_endin') !!}</span>
										<a href="#"> {{ $post->to_date }}</a> 
                                    @else
										<span class="explore-rating">{!! __('front/common.contest_endedat') !!}</span>
										<a href="#"> {{ $post->to_date }}</a> 
                                    @endif
										<span class="explore-price-box">
											{!! __('front/common.contest_price') !!}
											<span class="explore-price">{{ getPrice($post->price) }}</span>
										</span>
										<!--<a href="#">resturent</a>-->
									</p>
									<div class="explore-person">
										<div class="row">
											<div class="col-sm-2">
												<div class="explore-person-img">
													<a href="#">
														<img src="{{ asset('assets/front/images/explore/person.png') }}" alt="">
													</a>
												</div>
											</div>
											<div class="col-sm-10">
												<p>
                                                @if(contest_status(strtotime(str_replace('/', '-', $post->to_date))) === true)
                                                {!! __('front/common.contest_streamed') !!}                                              
                                                @else
                                                {!! __('front/common.contest_winner') !!}<span class="explore-rating" style="background-color:#20aa6d;">{{ winner($post->id) }}</span>
                                                @endif
												</p>
											</div>
										</div>
									</div>
									<div class="explore-person"></div>
									<div class="explore-open-close-part">
										<div class="row">
											<div class="col-sm-5">
                                                @if(contest_status(strtotime(str_replace('/', '-', $post->to_date))) === true)
                                                <button class="close-btn open-btn" onclick="window.location.href='#'">{!! __('front/common.contest_avilable') !!}</button>
                                                @else
                                                    <button class="close-btn" onclick="window.location.href='#'">{!! __('front/common.contest_notavilable') !!}</button>
                                                @endif
											</div>
											<div class="col-sm-7">
												<div class="explore-map-icon">
													<a href="#"> {!! __('front/common.contest_numof') !!}</a> 
													<a href="#">{{ numOfSubs($post->id) }} {!! __('front/common.contest_subscriber') !!}</a> 
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                            @endforeach
                        @endif
					</div>
				</div>
			</div><!--/.container-->

		</section><!--/.explore-->
		<!--explore end -->

		<!-- faqs start -->
		<section id="faq" class="p_3">
			<div class="container-xl">
				<div class="section-header">
					<h2>{{ getSetting('faqs_title') }}</h2>
					<p>{{ getSetting('faqs_desc') }}</p>
				</div>
			
			  <div class="row faq_1">
				<div class="col-md-6">
				 <div class="faq_1l">
				   <div class="grid clearfix">
						<figure class="effect-jazz mb-0">
						<a href="#"><img src="{{ getSetting('about_img1') }}" class="w-100" alt="abc"></a>
						</figure>
					</div>
				 </div>
				</div>
				<div class="col-md-6">
				 <div class="faq_1r">
				   <div class="accordion" id="accordionExample">
                    
                        @php
                            $faqs_blocks = json_decode(getSetting('faqs_blocks'), true);
                            $faqs = array_values($faqs_blocks);
                        @endphp
                        @if(!empty($faqs))
                            @if(is_array($faqs))
                                @php $ii = 0; @endphp
                                @for($i = 0; $i < count($faqs[0]); $i++)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_{{ $i }}">
                                    <button class="accordion-button mt-0 @php if($i == 0){ @endphp  @php }else{ @endphp collapsed @php } @endphp" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $i }}" @php if($i == 0){ @endphp aria-expanded="true" @php }else{ @endphp aria-expanded="false" @php } @endphp  aria-controls="collapse_{{ $i }}">
                                        {{ $faqs[0][$i] }}
                                    </button>
                                </h2>
                                <div id="collapse_{{ $i }}" class="accordion-collapse collapse @if($i == 0) show @endif" aria-labelledby="heading_{{ $i }}" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        {{ $faqs[1][$i] }}
                                    </div>
                                </div>
                            </div>
                                    @php $ii++; @endphp
                                @endfor
                            @endif
                        @endif
					</div>
				 </div>
				</div>
			  </div>
			</div>
			</section>
		<!-- faqs end -->

		<!--reviews start -->
		<section id="reviews" class="reviews">
			<div class="section-header">
				<h2>{{ getSetting('testimonials_title') }}</h2>
				<p>{{ getSetting('testimonials_desc') }}</p>
			</div><!--/.section-header-->
			<div class="reviews-content">
				<div class="testimonial-carousel">
                @if(!empty($testimonials))
                    @foreach($testimonials as $testimonial)
				    <div class="single-testimonial-box">
						<div class="testimonial-description">
							<div class="testimonial-info">
								<div class="testimonial-img">
									<img src="{{ asset('assets/front/images/clients/c1.png') }}" alt="{{ $testimonial->name }}">
								</div><!--/.testimonial-img-->
								<div class="testimonial-person">
									<h2>{{ $testimonial->name }}</h2>
									<h4>{{ __('front/common.customer') }}</h4>
									<div class="testimonial-person-star">
                                        @if($testimonial->comment_stars == 1)  <i class="fa fa-star"></i> @endif
                                        @if($testimonial->comment_stars == 2)  <i class="fa fa-star"></i><i class="fa fa-star"></i> @endif
                                        @if($testimonial->comment_stars == 3)  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> @endif
                                        @if($testimonial->comment_stars == 4)  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> @endif
                                        @if($testimonial->comment_stars == 5)  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> @endif
                                    
									</div>
								</div><!--/.testimonial-person-->
							</div><!--/.testimonial-info-->
							<div class="testimonial-comment">
								<p>
                                {{ $testimonial->comment }}
								</p>
							</div><!--/.testimonial-comment-->
						</div><!--/.testimonial-description-->
					</div><!--/.single-testimonial-box-->

                    @endforeach
                @endif
				    
				</div>
			</div>

		</section><!--/.reviews-->
		<!--reviews end -->


		<!--blog start -->
		<section id="blog" class="blog" >
			<div class="container">
				<div class="section-header">
					<h2>{{ getSetting('news_title') }}</h2>
					<p>{{ getSetting('news_desc') }}</p>
				</div><!--/.section-header-->
				<div class="blog-content">
					<div class="row">
                        
                        @if(!empty($news))
                            @foreach($news as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="single-blog-item">
                                    <div class="single-blog-item-img">
                                        <img src="{{ $item->image }}" alt="{{ $item->title }}">
                                    </div>
                                    <div class="single-blog-item-txt">
                                        <h2><a href="#">{{ $item->title }}</a></h2>
                                        <h4>{!! __('front/common.news_cat') !!} <a href="{{ getCatLink($item->category->slug) }}">{{ $item->category->title }} </a> <span> | </span> {{ $item->created_at->format('Y-m-d') }}</h4>
                                        <p>
                                        {!! Str::words($item->description, 20,'...') !!}
                                        </p>
                                        <a class="more" href="{{ getNewsLink($item->slug) }}">{!! __('front/common.news_more') !!}</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
					</div>
				</div>
			</div><!--/.container-->
			
		</section><!--/.blog-->
		<!--blog end -->



    @section('page_title'){{ __('front/common.title_tag') }}@endsection
</x-app-layout>