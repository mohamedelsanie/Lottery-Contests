<x-admin-layout>
    <x-slot name="header">
        <div class="page-header mb-0">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">{{ __('admin/common.home')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ __('admin/order.index.title') }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    @if(AdminCan('order-create'))
                    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary btn-sm scroll-click"><i class="fa fa-plus"></i> {{ __('admin/order.index.create') }}</a>
                    @endif
                    @if(AdminCan('order-forcedelete'))
                    <a href="{{ route('admin.orders.archive') }}" class="btn btn-primary btn-sm scroll-click">{{ __('admin/order.index.archive') }}</a>
                    
                    <a href="{{ route('admin.orders.export') }}" class="btn btn-primary btn-sm scroll-click">{{ __('admin/order.index.download') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                
                <div class="row">
                
            @if(count($pages) > 0)
                @foreach($pages as $page)
                    <div class="col-md-4 col-sm-12">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div class="clearfix mb-10">
                                    <div class="pull-left">
                                        <a href="{{ route('admin.orders.contest_orders',$page->id) }} "><h4 class="text-blue h4">{{ $page->title }}</h4></a>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>
                        </div>
                    </div>
                
                @endforeach
            @else
            
                    <div class="col-md-12 col-sm-12">
                        <div class="clearfix mb-10">
                            <div class="pull-left">
                                <h4 class="text-blue h4">{{ __('admin/order.index.notfound') }}</h4>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                    </div>

            @endif
                </div>
                
            </div>
        </div>
    </div>
            </div>
        </div>
    @section('page_title'){{ __('admin/order.index.title_tag') }}@endsection
</x-admin-layout>
