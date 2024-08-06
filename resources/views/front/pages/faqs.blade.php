

 

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
						<a href="#"><img src="{{ $page->image }}" class="w-100" alt="abc"></a>
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