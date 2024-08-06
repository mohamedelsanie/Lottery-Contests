<x-app-layout>

<section id="center" class="center_about">
	<div class="center_om clearfix">
		<div class="container">
			<div class="row center_o1">
				<div class="col-md-12">
					<h2 class="text-white">{{ __('front/common.check_title') }}</h2>
					<h6 class="mb-0 mt-3 fw-normal col_oran">
                        <a class="text-light" href="{{ route('homepage') }}">{{ __('front/common.home') }}</a> 
                        <span class="mx-2 col_light">/</span>{{ __('front/common.check_title') }}</h6>
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
                                <h2 class="text-center text-secondary mb-5">{{ __('front/common.details_title') }}</h2>
                                <div class="Details">
                                    <h3 class="text-center text-danger">{{ __('front/common.details_sub_done') }} <span class="p-1 bg-primary text-white rounded">{{ $contest->title }}</span> {{ __('front/common.details_sub_price') }} <span class="p-1 bg-primary text-white rounded">{{ $contest->price }}</span> {{ __('front/common.details_sub_exp') }} <span class="p-1 bg-primary text-white rounded">{{ $contest->to_date }}</span></h3>
                                    <ul>
                                        <li class="p-1 m-1 text-dark h6"><span>{{ __('front/common.details_invoice') }} : </span> {{ $order->invoice_id }}</li>
                                        <li class="p-1 m-1 text-dark h6"><span>{{ __('front/common.details_name') }} : </span> {{ $order->name }}</li>
                                        <li class="p-1 m-1 text-dark h6"><span>{{ __('front/common.details_adress') }} : </span> {{ $order->adress }}</li>
                                        <li class="p-1 m-1 text-dark h6"><span>{{ __('front/common.details_phone') }} : </span> {{ $order->phone }}</li>
                                        <li class="p-1 m-1 text-dark h6"><span>{{ __('front/common.details_user_name') }} : </span> {{ $order->user_name }}</li>
                                    </ul>
                                    <p class="h6 text-danger mt-3">
                                    @if(contest_status($contest->to_date) == true)
                                        {{ __('front/common.details_notends') }}                                              
                                    @else
                                        @if(winner($order->contest_id) == $order->user_name)
                                        {{ __('front/common.details_youwin') }}
                                        @else
                                        {{ __('front/common.details_ends') }} <span>{{ winner($order->contest_id) }}</span>
                                        @endif

                                    @endif
                                    </p>
                                    
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

    @section('page_title'){{ __('front/post_types.tours.title') }} - {{ __('front/common.details_pagename') }} @endsection
</x-app-layout>