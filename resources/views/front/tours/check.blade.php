<x-app-layout>

<section id="center" class="center_about">
	<div class="center_om clearfix">
		<div class="container">
			<div class="row center_o1">
				<div class="col-md-12">
					<h2 class="text-white">{{ __('front/common.check_title') }} </h2>
					<h6 class="mb-0 mt-3 fw-normal col_oran">
                        <a class="text-light" href="{{ route('homepage') }}">{{ __('front/common.home') }}</a> 
                        <span class="mx-2 col_light">/</span> {{ __('front/common.check_title') }}</h6>
				</div>
			</div>
		</div>
	</div>
</section>


		<!--explore start -->
		<section id="explore" class="join-page">
			<div class="container">
				<div class="explore-content">
					<div class="row">
                        <!---->
                        
							 <div class="join-form position-relative">
                                <div class="Details">
                                    <form action="{{ route('tours.details') }}" method="post">
                                    @csrf
                                        <div class="blog_1rdt3i2 row">

                                            <div class="col-lg-6 col-md-12">
                                                <div class="blog_1rdt3i2l">
                                                    <div class="single-model-search">
                                                        <h2>{!! __('front/common.check_user_name') !!}</h2>
                                                        <div class="model-select-icon">
                                                            <input class="form-control" name="user_name" placeholder="{!! __('front/common.check_user_name') !!}" type="text"><!-- /.input-->
                                                            @error('user_name')<span class="text-danger">{{ $message }}</span>@enderror
                                                        </div><!-- /.model-select-icon -->
                                                    </div>
                                                </div>
                                            </div> 
                                            
                                            <div class="col-lg-6 col-md-12">
                                                <div class="single-model-search">
                                                    <h2>{!! __('front/common.check_contest') !!}</h2>
                                                    <div class="model-select-icon">
                                                        <select class="form-control" name="contest">
                                                            <option value="">{!! __('front/common.check_contest_p') !!}</option><!-- /.option-->
                                                            @foreach($contests as $contest)
                                                            <option value="{{ $contest->id }}">{{ $contest->title }}</option><!-- /.option-->
                                                            @endforeach
                                                        </select><!-- /.select-->
                                                    </div><!-- /.model-select-icon -->
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-12">
                                                <div class="single-model-search text-center">
                                                    <button class="welcome-btn model-search-btn" type="submit">
                                                    {!! __('front/common.check_submit') !!}
                                                    </button>
                                                </div>
                                            </div>
                                        </div> 

                                        
                                    </form>
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

    @section('page_title'){{ __('front/post_types.tours.title') }} - {{ __('front/common.check_pagename') }}@endsection
</x-app-layout>