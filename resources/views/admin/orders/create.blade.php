<x-admin-layout>
    <x-slot name="header">
        <div class="page-header mb-0">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin/common.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">{{ __('admin/order.index.title') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin/order.create.create') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm scroll-click">{{ __('admin/order.show.back') }}</a>
                </div>
            </div>
        </div>
    </x-slot>
    @php $field = 'media'; @endphp
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="clearfix mb-10">
                    <div class="pull-left">
                        <h4 class="text-blue h4">{{ __('admin/order.create.create') }}</h4>
                    </div>
                </div>
                <div class="dropdown-divider"></div>

                <form action="{{ route('admin.orders.store') }}" method="post" class="mt-6 space-y-6">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-8 mb-30">

                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label">{{ __('admin/order.fields.title') }}</label>
                                <div class="col-sm-12 col-md-12">
                                    <input name="title" placeholder="{{ __('admin/order.fields.title') }}" value="{{ old('title') }}" class="main_input border-gray-300 rounded-md shadow-sm form-control @error('title') border border-danger @enderror" type="text"/>
                                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>


                            <div class="card card-box custom mb-10" id="accordionWork">
                                <div class="card-header" data-toggle="collapse" href="#collapseWork">
                                    <a class="card-title">
                                        {{ __('admin/order.fields.info') }}
                                    </a>
                                </div>
                                <div id="collapseWork" class="card-body show" data-parent="#accordionWork" >


                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-12 col-form-label">{{ __('admin/order.fields.user_name') }}</label>
                                        <div class="col-sm-12 col-md-12">
                                            <input name="user_name" placeholder="{{ __('admin/order.fields.user_name') }}" value="{{ (old('user_name')) ? old('user_name') : $user_name }}" class="border-gray-300 rounded-md shadow-sm form-control @error('user_name') border border-danger @enderror" type="text" readonly />
                                            @error('user_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-12 col-form-label">{{ __('admin/order.fields.contest_id') }}</label>
                                        <div class="col-sm-12 col-md-12">
                                            <select name="contest_id" class="border-gray-300 rounded-md shadow-sm custom-select col-12 @error('contest_id') border border-danger @enderror">
                                                <option value="" @if(old('contest_id') == '') selected @endif>{{ __('admin/order.fields.choose') }}</option>
                                                @foreach($tours as $tour)
                                                    <option value="{{ $tour->id }}" @if(old('contest_id') == $tour->id) selected @endif>{{ $tour->title }} - {{ __('admin/order.fields.contest_price') }} =  {{ $tour->price }}</option>
                                                @endforeach
                                            </select>
                                            @error('contest_id')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-12 col-form-label">{{ __('admin/order.fields.name') }}</label>
                                        <div class="col-sm-12 col-md-12">
                                            <input name="name" placeholder="{{ __('admin/order.fields.name') }}" value="{{ old('name') }}" class="border-gray-300 rounded-md shadow-sm form-control @error('name') border border-danger @enderror" type="text"/>
                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-12 col-form-label">{{ __('admin/order.fields.phone') }}</label>
                                        <div class="col-sm-12 col-md-12">
                                            <input name="phone" placeholder="{{ __('admin/order.fields.phone') }}" value="{{ old('phone') }}" class="border-gray-300 rounded-md shadow-sm form-control @error('phone') border border-danger @enderror" type="text"/>
                                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-12 col-form-label">{{ __('admin/order.fields.adress') }}</label>
                                        <div class="col-sm-12 col-md-12">
                                            <input name="adress" placeholder="{{ __('admin/order.fields.adress') }}" value="{{ old('adress') }}" class="border-gray-300 rounded-md shadow-sm form-control @error('adress') border border-danger @enderror" type="text"/>
                                            @error('adress')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    


                                </div>

                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4 mb-30">

                            <div class="card card-box custom mb-10" id="accordionInvoice">
                                <div class="card-header" data-toggle="collapse" href="#collapseInvoice">
                                    <a class="card-title">
                                        {{ __('admin/order.fields.invoice_id') }}
                                    </a>
                                </div>
                                <div id="collapseInvoice" class="card-body show pb-0" data-parent="#accordionInvoice" aria-expanded="true">
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-12">
                                            <input name="invoice_id" placeholder="{{ __('admin/order.fields.invoice_id') }}" value="{{ (old('invoice_id')) ? old('invoice_id') : $invoice }}" class="border-gray-300 rounded-md shadow-sm form-control @error('invoice_id') border border-danger @enderror" type="text" readonly/>
                                            @error('invoice_id')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-box custom mb-10" id="accordionImage">
                                <div class="card-header" data-toggle="collapse" href="#collapseImage">
                                    <a class="card-title">
                                        {{ __('admin/order.fields.image') }}
                                    </a>
                                </div>
                                <div id="collapseImage" class="card-body show pb-0" data-parent="#accordionImage" aria-expanded="true">
                                    <div class="form-group row" id="user_image_field_{{$field}}">
                                        <div class="col-sm-6 col-md-6 hidden">
                                            <input name="img" id="user_image_{{$field}}" placeholder="image" value="{{ old('img') }}" class="hidden form-control @error('img') border border-danger @enderror" type="text"/>
                                            @error('img')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            {{--@livewire('admin.media-upload')--}}
                                            @if(!empty(old('img')))
                                            <div class="image_preview" style="float: left; margin-right: 20px;"><img width="100" src="{{ old('img') }}" /></div>
                                            @else
                                            <div class="image_preview" style="float: left; margin-right: 20px;"></div>
                                            @endif
                                            <div class="clearfix"></div>
                                            <div class="block">
                                                <a href="#" class="btn-block" data-toggle="modal" data-target=".media_uploader_{{$field}}" type="button">{{ __('admin/order.fields.media') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card card-box custom mb-10" id="accordionWinType">
                                <div class="card-header" data-toggle="collapse" href="#collapseWinType">
                                    <a class="card-title">
                                        {{ __('admin/order.fields.win_type') }}
                                    </a>
                                </div>
                                <div id="collapseWinType" class="card-body show" data-parent="#accordionWinType" >

                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-12">
                                            <select name="win_type" class="border-gray-300 rounded-md shadow-sm custom-select col-12 @error('win_type') border border-danger @enderror">
                                                <option value="" @if(old('win_type') == '') selected @endif>{{ __('admin/order.fields.choose') }}</option>
                                                <option value="winner" @if(old('win_type') == 'winner') selected @endif>{{ __('admin/order.fields.winner') }}</option>
                                                <option value="loser" @if(old('win_type') == 'loser') selected @endif>{{ __('admin/order.fields.loser') }}</option>
                                            </select>
                                            @error('win_type')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card card-box custom mb-10" id="accordionStatus">
                                <div class="card-header" data-toggle="collapse" href="#collapseStatus">
                                    <a class="card-title">
                                        {{ __('admin/order.fields.status') }}
                                    </a>
                                </div>
                                <div id="collapseStatus" class="card-body show" data-parent="#accordionStatus" >

                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-12">
                                            <select name="status" class="border-gray-300 rounded-md shadow-sm custom-select col-12 @error('status') border border-danger @enderror">
                                                <option value="" @if(old('status') == '') selected @endif>{{ __('admin/order.fields.choose') }}</option>
                                                <option value="not_payed" @if(old('status') == 'not_payed') selected @endif>{{ __('admin/order.fields.not_payed') }}</option>
                                                <option value="payed" @if(old('status') == 'payed') selected @endif>{{ __('admin/order.fields.payed') }}</option>
                                                <option value="canceled" @if(old('status') == 'canceled') selected @endif>{{ __('admin/order.fields.canceled') }}</option>
                                            </select>
                                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-10">
                            <button class="btn btn-primary bg-gray-800" type="submit">{{ __('admin/order.fields.create') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div id="user_image_modal_{{$field}}">
        <livewire:admin.media-box :field="$field" />
    </div>


    @section('scripts')
        <script>
            $('#user_image_modal_{{$field}} #gallery_{{$field}} a.image_ch').click(function(){
                $('#user_image_field_{{$field}} #user_image_{{$field}}').val($(this).data('image'));
                var value = $("#user_image_{{$field}}").val();
                $("#user_image_field_{{$field}} .image_preview").html('<a class="cursor-pointer remove_img"><i class="fa fa-times-circle text-gray-700 text-2x1 float-left"></i><img src="'+value+'" width="100" /></a>');

                $("#user_image_field_{{$field}} .image_preview a.remove_img").click(function(){
                    $('#user_image_field_{{$field}} #user_image_{{$field}}').val('');
                    $("#user_image_field_{{$field}} .image_preview a.remove_img").remove();
                });
                //$('.media_uploader').modal('hide');
            });
            $(document).ready(function(){
                $('.main_input').focus();
            });
        </script>
    @endsection
    @section('page_title'){{ __('admin/order.create.title_tag') }}@endsection
</x-admin-layout>
