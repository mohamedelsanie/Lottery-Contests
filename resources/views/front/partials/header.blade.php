
		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
		
		<!--header-top start -->
		<header id="header-top" class="header-top">
			<div class="container">
				<div class="row">
					<ul>
						<li>
							<div class="header-top-left">
								<ul class="Header-Social">
									<a href="{{ getSetting('facebook') }}"><i class="fa fa-facebook"></i></a>	
									<a href="{{ getSetting('twitter') }}"><i class="fa fa-twitter"></i></a>
									<a href="{{ getSetting('youtube') }}"><i class="fa fa-youtube"></i></a>
									<a href="{{ getSetting('instagram') }}"><i class="fa fa-instagram"></i></a>
								</ul>
							</div>
						</li>
						<li class="head-responsive-right pull-right">
							<div class="header-top-right">
								<ul>
									<li class="header-top-contact">
										<a href="https://wa.me/{{ getSetting('phone') }}?text=Hello+There">{{ getSetting('phone') }}</a>
									</li>
									<li class="header-top-contact">
										<a href="mailto:{{ getSetting('email') }}">{{ getSetting('email') }}</a>
									</li>
									<li class="header-top-contact">
										<a href="faqs.html">{!! __('front/common.faqs') !!}</a>
									</li>
									<li class="header-top-contact">
										<a href="terms.html">{!! __('front/common.rules') !!}</a>
									</li>
									
                                    @if(getSetting('langs_menu_st') == 'enabled')
                                    
									<li class="select-opt">
										<div class="dropdown Langs">
											<button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
											{{ LaravelLocalization::getCurrentLocaleNative() }}
											</button>
											<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
												
												@foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
												<li><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a></li>
												@endforeach
											</ul>
										</div>
										
									</li>
                                    @endif
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
					
		</header><!--/.header-top-->
		<!--header-top end -->

		<!-- top-area Start -->
		<section class="top-area">
			<div class="header-area">
				<!-- Start Navigation -->
			    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-expand-lg "  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

			        <div class="container">

			            <!-- Start Header Navigation -->
						
			            <div class="navbar-header">
                            <a class="nav-brand" href="{{ getSetting('site_url') }}"><img src="{{ getSetting('site_logo') }}" alt=""></a>

			                <!--
                                <a class="navbar-brand" href="{{ getSetting('site_url') }}">إيجى<span>لوترى</span></a>
                            -->
			                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							  </button>

			            </div><!--/.navbar-header-->
			            <!-- End Header Navigation -->

			            <!-- Collect the nav links, forms, and other content for toggling -->
			            <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
			                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
			                    <li class=" {{ activeMenu('ar','en') }}"><a href="{{ getSetting('site_url') }}">{{ __('front/common.home') }}</a></li> <!-- scroll -->
			                    
                                @foreach(getMenu(getSetting('header_menu')) as $item)
                                    @if($item->type == 'post')
                                    <li class="link"><a href="{{ getNewsLink($item->slug) }}">{{ $item->name }}</a></li>
                                    @elseif($item->type == 'category')
                                    <li class="link"><a href="{{ getCatLink($item->slug) }}">{{ $item->name }}</a></li>
                                    @elseif($item->type == 'tour_category')
                                    <li class="link"><a href="{{ getTourCatLink($item->slug) }}">{{ $item->name }}</a></li>
                                    @elseif($item->type == 'tour')
                                    <li class="link"><a href="{{ getTourLink($item->slug) }}">{{ $item->name }}</a></li>
                                    @else
                                    <li class="link"><a href="{{ $item->slug }}">{{ $item->title }}</a></li>
                                    @endif
                                @endforeach

			                </ul><!--/.nav -->
			            </div><!-- /.navbar-collapse -->
                        
                        @if(getSetting('book_menu_st') == 'enabled')
						<a class="button" href="{{ getSetting('book_page') }}">{!! __('front/common.book_now') !!} <i class="fa fa-check-circle ms-1"></i> </a>
                        @endif
			        </div><!--/.container-->
			    </nav><!--/nav-->
			    <!-- End Navigation -->
			</div><!--/.header-area-->
		    <div class="clearfix"></div>

		</section><!-- /.top-area-->
		<!-- top-area End -->
