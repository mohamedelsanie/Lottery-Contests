

 

<section id="about_pg" class="p_3">
 <div class="container">
  <div class="about_pg1 row">
    <div class="col-md-6">
	 <div class="about_pgl clearfix">
	   <div class="grid clearfix">
				  <figure class="effect-jazz mb-0">                    
                    <img src="{{ $page->image }}" class="w-100" alt="{{ $page->title }}">
				  </figure>
			  </div>
	 </div>
	</div>
	<div class="col-md-6">
	 <div class="about_pgr clearfix">
	  <h4 class="col_oran m-2">ABOUT US</h4>
	  <h2>{{ $page->title }}</h2>
	  <p class="mt-3">{{ $page->content }}</p>
	 </div>
	</div>
   </div>
 </div>	
</section>



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