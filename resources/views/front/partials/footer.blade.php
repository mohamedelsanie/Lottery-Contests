

		<!--footer start-->
		<footer id="footer"  class="footer">
			<div class="container">
				<div class="footer-top">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-6 col-12">
							<div class="single-footer-widget">
								<div class="footer-logo">
									<!-- <a href="index.html">إيجى لوترى</a> -->
                                    <img src="{{ getSetting('footer_logo') }}" alt="">
								</div>
								<p>
                                    {{ getSetting('footer_adress') }}
								</p>
								<div class="footer-contact">
									<p>{{ getSetting('email') }}</p>
									<p>{{ getSetting('phone') }}</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-12">
							<div class="single-footer-widget">
								<h2>{!! __('front/common.about') !!}</h2>
								<ul>
									<li><a href="#">{!! __('front/common.about_page') !!}</a></li>
									<li><a href="#">{!! __('front/common.faqs') !!}</a></li>
									<li><a href="#">{!! __('front/common.rules') !!}</a></li>
									<li><a href="#">{!! __('front/common.terms') !!}</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-12">
							<div class="single-footer-widget">
								<h2>{{ getSetting('footer_menu_title') }}</h2>
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<ul> 
                                        @foreach(getMenu(getSetting('footer_menu')) as $item)
                                            @if($item->type == 'post')
                                                <li><a href="{{ getNewsLink($item->slug) }}"><i class="fa fa-caret-{{ __('front/common.right') }}" aria-hidden="true"></i> {{ $item->name }}</a></li>
                                            @elseif($item->type == 'category')
                                                <li><a href="{{ getCatLink($item->slug) }}"><i class="fa fa-caret-{{ __('front/common.right') }}" aria-hidden="true"></i> {{ $item->name }}</a></li>
                                            @elseif($item->type == 'tour_category')
                                                <li><a href="{{ getTourCatLink($item->slug) }}"><i class="fa fa-caret-{{ __('front/common.right') }}" aria-hidden="true"></i> {{ $item->name }}</a></li>
                                            @elseif($item->type == 'tour')
                                                <li><a href="{{ getTourLink($item->slug) }}"><i class="fa fa-caret-{{ __('front/common.right') }}" aria-hidden="true"></i> {{ $item->name }}</a></li>
                                            @else
                                                <li><a href="{{ $item->slug }}"><i class="fa fa-caret-{{ __('front/common.right') }}" aria-hidden="true"></i> {{ $item->name }}</a></li>
                                            @endif
                                        @endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-12 col-sm-6 col-12">
							<div class="single-footer-widget">
								<h2>{{ getSetting('footer_subscribe_title') }}</h2>
								<div class="footer-newsletter">
									<p>
                                        {{ getSetting('footer_subscribe_desc') }}
									</p>
								</div>
								<div class="hm-foot-email">
									<div class="foot-email-box">
										<input type="text" class="form-control" placeholder="{!! __('front/common.email') !!}">
									</div><!--/.foot-email-box-->
									<div class="foot-email-subscribe">
										<span><i class="fa fa-arrow-left"></i></span>
									</div><!--/.foot-email-icon-->
								</div><!--/.hm-foot-email-->
							</div>
						</div>
					</div>
				</div>
				<div class="hm-footer-copyright">
					<div class="row">
						<div class="col-lg-5 col-sm-12 col-12">
							<p>
                                {!! __('front/common.copyrights',['link' => '#']) !!} 
							</p><!--/p-->
						</div>
						<div class="col-lg-7 col-sm-12 col-12">
							<div class="footer-social">
								<span><i class="fa fa-phone"> {{ getSetting('phone') }}</i></span>
								<a href="{{ getSetting('facebook') }}"><i class="fa fa-facebook"></i></a>	
								<a href="{{ getSetting('twitter') }}"><i class="fa fa-twitter"></i></a>
								<a href="{{ getSetting('youtube') }}"><i class="fa fa-youtube"></i></a>
								<a href="{{ getSetting('instagram') }}"><i class="fa fa-instagram"></i></a>
							</div>
						</div>
					</div>
					
				</div><!--/.hm-footer-copyright-->
			</div><!--/.container-->

			<div id="scroll-Top">
				<div class="return-to-top">
					<i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
				</div>
				
			</div><!--/.scroll-Top-->
			
        </footer><!--/.footer-->
		<!--footer end-->