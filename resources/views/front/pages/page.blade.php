<x-app-layout>
<section id="center" class="center_about">
	<div class="center_om clearfix">
		<div class="container">
			<div class="row center_o1">
				<div class="col-md-12">
					<h2 class="text-white">{{ $page->title }}</h2>
					<h6 class="mb-0 mt-3 fw-normal col_oran"><a class="text-light" href="{{ route('homepage') }}">{{ __('front/common.home') }}</a> <span class="mx-2 col_light">/</span> {{ $page->title }}</h6>
				</div>
			</div>
		</div>
	</div>
</section>



    @if(getSetting('testimonials_page') == $page->id)
        @include('front.pages.testimonials')
    @elseif(getSetting('contact_page') == $page->id)
        @include('front.pages.contact')
    @elseif(getSetting('about_page') == $page->id)
        @include('front.pages.about')
    @elseif(getSetting('faqs_page') == $page->id)
        @include('front.pages.faqs')
    @else
        @include('front.pages.single')
    @endif

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

        @section('page_title'){{ $page->title }}@endsection
</x-app-layout>