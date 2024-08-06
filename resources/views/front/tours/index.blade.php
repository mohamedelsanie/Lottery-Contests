<x-app-layout>
    
<section id="center" class="center_about">
	<div class="center_om clearfix">
		<div class="container">
			<div class="row center_o1">
				<div class="col-md-12">
					<h2 class="text-white">{{ __('front/post_types.tours.title') }}</h2>
					<h6 class="mb-0 mt-3 fw-normal col_oran"><a class="text-light" href="{{ route('homepage') }}">{{ __('front/common.home') }}</a> <span class="mx-2 col_light">/</span> {{ __('front/post_types.tours.title') }}</h6>
				</div>
			</div>
		</div>
	</div>
</section>

		<!--explore start -->
		<section id="explore" class="explore">
			<div class="container">
				<div class="explore-content">
					<div class="row">
                        

                        @if(!empty($posts))
                            @foreach($posts as $post)
                                
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
                            @endforeach
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

                $( function() {
                    $('.date-picker2').datepicker({
                        language: "en",
                        autoclose: true,
                        format: "dd/mm/yyyy"
                    });
                    $( "#slider-range" ).slider({
                        range: true,
                        min: 0,
                        max: 10000,
                        step: 100,
                        values: [ 0, 10000 ],
                        slide: function( event, ui ) {
                            $( "#amount" ).val( ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                        }
                    });
                    $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + "-" + $( "#slider-range" ).slider( "values", 1 ) );
                } );

            });
        </script>
    @endsection
@section('page_title'){{ __('front/post_types.tours.title') }}@endsection
</x-app-layout>