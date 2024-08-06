<x-admin-layout>
    <x-slot name="header">
        <div class="page-header mb-0">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin/common.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.contest.categories.index') }}">{{ __('admin/tour_category.index.title') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin/tour_category.edit.edit') }}<code>{{ $category->title }}</code></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.contest.categories.index') }}" class="btn btn-primary btn-sm scroll-click">{{ __('admin/tour_category.show.back') }}</a>
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
                        <h4 class="text-blue h4">{{ __('admin/tour_category.edit.edit') }} </h4>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <form action="{{ route('admin.contest.categories.update', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-8 mb-30">

                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label">{{ __('admin/tour_category.fields.title') }}</label>
                                <div class="col-sm-12 col-md-12">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach(config('translatable.languages') as $key => $lang)
                                            <li class="nav-item @if($errors->has($key.'*title'))  border border-danger @endif">
                                                <a class="nav-link @if(LaravelLocalization::getCurrentLocale() == $key) active @endif" data-toggle="tab" href="#title-{{ $key }}" role="tab">{{ $lang }}</a>
                                            </li>
                                        @endforeach
                                    </ul><!-- Tab panes -->
                                    <div class="tab-content">
                                        @foreach(config('translatable.languages') as $key => $lang)
                                            <div class="tab-pane @if(LaravelLocalization::getCurrentLocale() == $key) active @endif" id="title-{{ $key }}" role="tabpanel">
                                                <input name="{{ $key }}[title]" placeholder="{{ __('admin/tour_category.fields.title') }}" value="{{ $category->translate($key)->title }}" class="@if(LaravelLocalization::getCurrentLocale() == $key) slug-input main_input @endif border-gray-300 rounded-md shadow-sm form-control @if($errors->has($key.'*title')) border border-danger @endif" type="text"/>
                                                @if($errors->has($key.'*title'))<span class="text-danger">{{ $errors->first($key.'*title') }}</span>@endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label">{{ __('admin/tour_category.fields.slug') }}</label>
                                <div class="col-sm-12 col-md-12">
                                    <input name="slug" placeholder="{{ __('admin/tour_category.fields.slug') }}" value="{{ $category->slug }}" class="slug-output border-gray-300 rounded-md shadow-sm form-control @error('slug') border border-danger @enderror" type="text"/>
                                    <span class="">{{ __('admin/tour_category.fields.current_slug') }}{{ getSetting('site_url') }}<b class="text-success">{{ $category->slug }}</b></span>
                                    @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="card card-box custom mb-10" id="accordionWork">
                                <div class="card-header" data-toggle="collapse" href="#collapseWork">
                                    <a class="card-title">
                                        {{ __('admin/tour_category.fields.info') }}
                                    </a>
                                </div>
                                <div id="collapseWork" class="card-body show" data-parent="#accordionWork" >

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-12 col-form-label">{{ __('admin/tour_category.fields.descraption') }}</label>
                                        <div class="col-sm-12 col-md-12">
                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach(config('translatable.languages') as $key => $lang)
                                                    <li class="nav-item @if($errors->has($key.'*descraption'))  border border-danger @endif">
                                                        <a class="nav-link @if(LaravelLocalization::getCurrentLocale() == $key) active @endif" data-toggle="tab" href="#descraption-{{ $key }}" role="tab">{{ $lang }}</a>
                                                    </li>
                                                @endforeach
                                            </ul><!-- Tab panes -->
                                            <div class="tab-content">
                                                @foreach(config('translatable.languages') as $key => $lang)
                                                    <div class="tab-pane @if(LaravelLocalization::getCurrentLocale() == $key) active @endif" id="descraption-{{ $key }}" role="tabpanel">
                                                        <textarea name="{{ $key }}[descraption]" placeholder="{{ __('admin/tour_category.fields.descraption') }}" class="border-gray-300 rounded-md shadow-sm form-control @if($errors->has($key.'*descraption')) border border-danger @endif">{{ $category->translate($key)->descraption }}</textarea>
                                                        @if($errors->has($key.'*descraption'))<span class="text-danger">{{ $errors->first($key.'*descraption') }}</span>@endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4 mb-30">
                            <div class="card card-box custom mb-10" id="accordionParent">
                                <div class="card-header" data-toggle="collapse" href="#collapseParent">
                                    <a class="card-title">
                                        {{ __('admin/tour_category.fields.parent') }}
                                    </a>
                                </div>
                                <div id="collapseParent" class="card-body show" data-parent="#accordionParent" >

                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-12">
                                            <select name="parent" class="border-gray-300 rounded-md shadow-sm custom-select col-12 @error('parent') border border-danger @enderror">
                                                <option value="0" @if($category->parent == '0') selected @endif>{{ __('admin/tour_category.fields.main') }}</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}" @if($cat->id == $category->parent) selected @endif>{{ $cat->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('parent')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-box custom mb-10" id="accordionImage">
                                <div class="card-header" data-toggle="collapse" href="#collapseImage">
                                    <a class="card-title">
                                        {{ __('admin/tour_category.fields.image') }}
                                    </a>
                                </div>
                                <div id="collapseImage" class="card-body show pb-0" data-parent="#accordionImage" aria-expanded="true">
                                    <div class="form-group row" id="user_image_field_{{$field}}">
                                        <div class="col-sm-6 col-md-6 hidden">
                                            <input name="img" id="user_image_{{$field}}" placeholder="image" value="{{ $cat->img }}" class="hidden form-control @error('img') border border-danger @enderror" type="text"/>
                                            @error('img')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            {{--@livewire('admin.media-upload')--}}
                                            <div class="image_preview" style="float: left; margin-right: 20px;">
                                                @if($cat->img)
                                                    <img src="{{ $cat->img }}" width="100" />
                                                @endif
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="block">
                                                <a href="#" class="btn-block" data-toggle="modal" data-target=".media_uploader_{{$field}}" type="button">{{ __('admin/tour_category.fields.media') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card card-box custom mb-10" id="accordionStatus">
                                <div class="card-header" data-toggle="collapse" href="#collapseStatus">
                                    <a class="card-title">
                                        {{ __('admin/tour_category.fields.status') }}
                                    </a>
                                </div>
                                <div id="collapseStatus" class="card-body show" data-parent="#accordionStatus" >

                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-12">
                                            <select name="status" class="border-gray-300 rounded-md shadow-sm custom-select col-12 @error('status') border border-danger @enderror">
                                                @if($cat->status == 'publish')
                                                    <option value="publish" selected>{{ __('admin/tour_category.fields.publish') }}</option>
                                                    <option value="pending">{{ __('admin/tour_category.fields.pending') }}</option>
                                                    <option value="draft">{{ __('admin/tour_category.fields.draft') }}</option>
                                                @elseif($cat->status == 'pending')
                                                    <option value="publish">{{ __('admin/tour_category.fields.publish') }}</option>
                                                    <option value="pending" selected>{{ __('admin/tour_category.fields.pending') }}</option>
                                                    <option value="draft">{{ __('admin/tour_category.fields.draft') }}</option>
                                                @elseif($cat->status == 'draft')
                                                    <option value="publish">{{ __('admin/tour_category.fields.publish') }}</option>
                                                    <option value="pending">{{ __('admin/tour_category.fields.pending') }}</option>
                                                    <option value="draft" selected>{{ __('admin/tour_category.fields.draft') }}</option>
                                                @else
                                                    <option selected="">{{ __('admin/tour_category.fields.choose') }}</option>
                                                    <option value="publish">{{ __('admin/tour_category.fields.publish') }}</option>
                                                    <option value="pending">{{ __('admin/tour_category.fields.pending') }}</option>
                                                    <option value="draft">{{ __('admin/tour_category.fields.draft') }}</option>
                                                @endif
                                            </select>
                                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-12 col-md-10">
                            <button class="btn btn-primary bg-gray-800" type="submit">{{ __('admin/tour_category.fields.update') }}</button>
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
                @if(LaravelLocalization::getCurrentLocale() == $key)
                $('.main_input').focus();
                        @endif
                var slug = function(str) {
                        var $slug = '';
                        var trimmed = $.trim(str);
                        //replace all special characters | symbols with a space
                        $slug = trimmed.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                        // trim spaces at start and end of string
                            .replace(/^\s+|\s+$/gm,'')
                            // replace space with dash/hyphen
                            .replace(/\s+/g, '-');
                        return $slug.toLowerCase();
                    };

                $('.slug-input').keyup(function() {
                    var takedata = $('.slug-input').val();
                    $('.slug-output').val(slug(takedata));
                });
            });
        </script>
    @endsection
    @section('page_title'){{ __('admin/tour_category.edit.title_tag',['category' => $category->title]) }}@endsection
</x-admin-layout>
