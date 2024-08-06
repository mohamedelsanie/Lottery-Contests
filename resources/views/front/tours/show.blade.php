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
                        <a class="text-light" href="{{ getTourCatLink($post->category->slug) }}">{{ $post->category->title }}</a> 
                        <span class="mx-2 col_light">/</span> {{ $post->title }}</h6>
				</div>
			</div>
		</div>
	</div>
</section>


		<!--explore start -->
		<section id="explore" class="join-page">
			<div class="container">
				<div class="section-header">
					<h2>{{ $post->title }}</h2>
					<p>{{ $post->description }}</p>
				</div><!--/.section-header-->
				<div class="explore-content">
					<div class="row">
                        <!---->
                        
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
                                    @if(contest_status(strtotime(str_replace('/', '-', $post->to_date))) === true)
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

						<div class="col-lg-8 col-md-6 col-sm-12">
						
							 <div class="join-form">
                             @if(contest_status(strtotime(str_replace('/', '-', $post->to_date))) === true)
                                <h2 class="text-right text-secondary mb-0">{!! __('front/common.subscribe2_title1') !!}</h2>
                                <br />
                                <h4 class="text-right text-secondary mb-5">{!! __('front/common.subscribe2_desc',['fawry' => getSetting('fawry_code'),'vodafone' => getSetting('vodafone_cash')]) !!}</h4>
                                <hr>
                                <h2 class="text-center text-secondary mb-5">{!! __('front/common.subscribe2_title') !!}</h2>
							    <form action="{{ route('tours.subscribe') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="blog_1rdt3i2 row">

								 <div class="col-lg-6 col-md-12">
								  <div class="blog_1rdt3i2l">
                                        <div class="single-model-search">
                                            <h2>{!! __('front/common.subscribe_name') !!}</h2>
                                            <div class="model-select-icon">
                                                <input class="form-control" name="name" placeholder="{!! __('front/common.subscribe_name_p') !!}" type="text"><!-- /.input-->
                                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div><!-- /.model-select-icon -->
                                        </div>
								  </div>
								 </div> 
								 <div class="col-lg-6 col-md-12">
								  <div class="blog_1rdt3i2l">
                                    <div class="single-model-search">
                                        <h2>{!! __('front/common.subscribe_adress') !!}</h2>
                                        <div class="model-select-icon">
                                            <input class="form-control" name="adress" placeholder="{!! __('front/common.subscribe_adress_p') !!}" type="text"><!-- /.input-->
                                            @error('adress')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div><!-- /.model-select-icon -->
                                    </div>
								  </div>
								 </div>

								</div>
								<div class="blog_1rdt3i2 row mt-3">
								 <div class="col-lg-6 col-md-12">
								  <div class="blog_1rdt3i2l">
                                    <div class="single-model-search">
                                        <h2>{!! __('front/common.subscribe_phone') !!}</h2>
                                        <div class="model-select-icon">
                                            <input class="form-control" name="phone" placeholder="{!! __('front/common.subscribe_phone_p') !!}" type="text"><!-- /.input-->
                                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div><!-- /.model-select-icon -->
                                    </div>
								  </div>
								 </div> 
								 <div class="col-lg-6 col-md-12">
								  <div class="blog_1rdt3i2l">
                                    <div class="single-model-search">
                                        <h2>{!! __('front/common.subscribe_user_name') !!}</h2>
                                        <div class="model-select-icon">
                                            <input class="form-control" name="user_name" value="{{ $user_name }}" placeholder="{!! __('front/common.subscribe_user_name_p') !!}" type="text" readonly><!-- /.input-->
                                            @error('user_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div><!-- /.model-select-icon -->
                                    </div>
								  </div>
								 </div>
								</div>
								<div class="blog_1rdt3i2 row mt-3">
								 <div class="col-md-12">
								  <div class="blog_1rdt3i2l">
                                    <div class="single-model-search">
                                        <h2>{!! __('front/common.subscribe_reset') !!}</h2>
                                        <div class="model-select-icon">
                                            <input class="form-control" name="img" placeholder="{!! __('front/common.subscribe_reset_p') !!}" type="file"><!-- /.input-->
                                            @error('img')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div><!-- /.model-select-icon -->
                                    </div>

									<h6 class="mt-3 mb-0">
                                        <input type="hidden" name="contest" value="{{ $post->id }}" />    
                                        <button class="btn button">{!! __('front/common.subscribe_submit') !!} <i class="fa fa-check-circle ms-1"></i></button>
                                    </h6>
								  </div>
								 </div> 
								</div>
                                </form>
                                @else
                                <h2 class="text-center text-danger m-5">{!! __('front/common.subscribe2_closed') !!}</h2>
                                @endif
							 </div>
						</div>
						
					</div>
				</div>
			</div><!--/.container-->

		</section><!--/.explore-->
		<!--explore end -->


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

                $('.addButton').on('click', function() {
                    $(this).toggleClass('is-active');
                    $(this).text(($(this).text() == "{{ __('front/post_types.tour.add_offer') }}") ? "{{ __('front/post_types.tour.added_offer') }}" : "{{ __('front/post_types.tour.add_offer') }}").fadeIn();
                    //alert($(this).parent().children('.total-price').data('price'));
                    var standerd = parseInt($('.totalPrice').text());
                    var offer = parseInt($(this).parent().children('.total-price').data('price'));
                    if($(this).hasClass('is-active')){
                        $('.totalPrice').text(standerd+offer);
                        $("#checkOut form .totalprice").val(standerd+offer);
                        var offerId = $(this).parent().children('.addButton').data('id');
                        var input = $('<input type="hidden" class="offer'+offerId+'" name="offer[]" value="'+offerId+'" />');
                        $("#checkOut form").append(input);
                    }else{
                        $('.totalPrice').text(standerd-offer);
                        $("#checkOut form .totalprice").val(standerd-offer);
                        var offerId = $(this).parent().children('.addButton').data('id');
                        $('#checkOut form .offer'+offerId+'').remove();
                    }
                    //$(this).parent().children('.total-price').data('price')+$('.totalPrice').text()

                });
                /******************/
            });
        </script>
    @endsection

    @section('page_title'){{ __('front/post_types.tours.title') }} - {{ $post->title }}@endsection
</x-app-layout>