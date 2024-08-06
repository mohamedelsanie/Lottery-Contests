

<section id="contact" class="p_3">
 <div class="container">
   <div class="contact_1 row">
    <div class="col-md-4 col-sm-6 col-12">
	 <div class="contact_1i row bg_light ms-1 me-1 ps-2 pe-2 pt-4 pb-4">
	  <div class="col-lg-3 col-md-12">
	   <div class="contact_1il">
	    <span class="d-inline-block bg_oran text-white text-center rounded-circle fs-2"><i class="fa fa-map"></i></span>
	   </div>
	  </div>
	  <div class="col-lg-9 col-md-12">
	   <div class="contact_1ir">
	    <h5>{{ __('front/post_types.page.contact_adress') }}</h5>
		<p class="mb-0 fs-6">{{ getSetting('footer_adress') }}</p>
	   </div>
	  </div>
	 </div>
	</div>
    <div class="col-md-4 col-sm-6 col-12">
	 <div class="contact_1i row bg_light ms-1 me-1 ps-2 pe-2 pt-4 pb-4">
	  <div class="col-lg-3 col-md-12">
	   <div class="contact_1il">
	    <span class="d-inline-block bg_oran text-white text-center rounded-circle fs-2"><i class="fa fa-phone"></i></span>
	   </div>
	  </div>
	  <div class="col-lg-9 col-md-12">
	   <div class="contact_1ir">
	    <h5>{{ __('front/post_types.page.contact_phone') }}</h5>
		<p class="mb-0 fs-6"> {{ getSetting('phone') }}</p>
	   </div>
	  </div>
	 </div>
	</div>
    <div class="col-md-4 col-sm-6 col-12">
	 <div class="contact_1i row bg_light ms-1 me-1 ps-2 pe-2 pt-4 pb-4">
	  <div class="col-lg-3 col-md-12">
	   <div class="contact_1il">
	    <span class="d-inline-block bg_oran text-white text-center rounded-circle fs-2"><i class="fa fa-envelope"></i></span>
	   </div>
	  </div>
	  <div class="col-lg-9 col-md-12">
	   <div class="contact_1ir">
	    <h5>{{ __('front/post_types.page.contact_email') }}</h5>
		<p class="mb-0 fs-6">{{ getSetting('email') }}</p>
	   </div>
	  </div>
	 </div>
	</div>
   </div>
   <div class="contact_2 row mt-5">
    <div class="col-lg-5 col-md-12">
	 <div class="contact_2l">
	   <h5 class="col_oran">{{ $page->title }}</h5>
	   <h1 class="font_50 mt-3">{{ __('front/post_types.page.contact_send_leave') }}</h1>
        <br />
       <ul class="social-network social-circle mb-0 mt-3">
            <li><a href="{{ getSetting('facebook') }}" class="icoFacebook"><i class="fa fa-facebook"></i></a></li>	
            <li><a href="{{ getSetting('twitter') }}" class="icoTwitter"><i class="fa fa-twitter"></i></a></li>
            <li><a href="{{ getSetting('youtube') }}" class="icoRss"><i class="fa fa-youtube"></i></a></li>
            <li><a href="{{ getSetting('instagram') }}" class="icoRss"><i class="fa fa-instagram"></i></a></li>
        </ul>
	 </div>
	</div>
	<div class="col-lg-7 col-md-12">
        <form action="{{ route('sendmessage') }}" method="post">
            @csrf
            <div class="contact_2r">
                <div class="blog_1rdt3i2 row">
                    <div class="col-md-6">
                    <div class="blog_1rdt3i2l">
                        @auth()
                        <input type="text" name="name" value="{{ old('name') ? old('name') : auth()->user()->name }}" class="form-control mb-30 @error('name') border border-danger @enderror" placeholder="{{ __('front/post_types.page.contact_send_name') }}">
                        @else
                        <input type="text" name="name" value="{{ old('name') ? old('name') : '' }}" class="form-control mb-30 @error('name') border border-danger @enderror" placeholder="{{ __('front/post_types.page.contact_send_name') }}">
                        @endif
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    </div> 
                    <div class="col-md-6">
                    <div class="blog_1rdt3i2l">
                        @auth()
                        <input type="email" name="email" value="{{ old('email') ? old('email') : auth()->user()->email }}" class="form-control mb-30" placeholder="{{ __('front/post_types.page.contact_send_email') }}">
                        @else
                        <input type="email" name="email" value="{{ old('email') ? old('email') : '' }}" class="form-control mb-30" placeholder="{{ __('front/post_types.page.contact_send_email') }}">
                        @endif
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    </div>
                </div>
                <div class="blog_1rdt3i2 row mt-3">
                    <div class="col-md-12">
                    <div class="blog_1rdt3i2l">
                        <input type="text" name="subject" value="{{ old('subject') }}" class="form-control mb-30" placeholder="{{ __('front/post_types.page.contact_send_subject') }}">
                        @error('subject')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    </div> 
                </div>
                <div class="blog_1rdt3i2 row mt-3">
                    <div class="col-md-12">
                    <div class="blog_1rdt3i2l">
                        <textarea name="message" value="{{ old('message') }}" class="form-control form_text mb-30 @error('message') border border-danger @enderror" placeholder="{{ __('front/post_types.page.contact_send_message') }}"></textarea>
                        @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                    <h6 class="mt-3 mb-0">
                    <button type="submit" class="button">{{ __('front/post_types.page.contact_send_post') }} <i class="fa fa-check-circle ms-1"></i></button>
                    </div>
                    </div> 
                </div>
            </div>
        </form>
	</div>
   </div>
  
 </div>
</section>



