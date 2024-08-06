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
                    <div class="col-md-6 col-sm-12">
                        <div class="clearfix mb-10">
                            <div class="pull-left">
                                <h4 class="text-blue h4">{{ __('admin/order.index.title') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">

                        <form name="search_form" method="post" action="{{route('admin.orders.search')}}" >
                            @csrf
                            <div class="input-group">
                                <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
                                <input name="search" type="text" value="{{ request('search') }}" class="form-control border-gray-300 rounded-md shadow-sm" id="search" placeholder="{{__('admin/common.table.search_placeholder')}}" />
                                <div class="text-right">
                                    <button class="btn btn-primary border-gray-300 rounded-md shadow-sm" type="submit" style="background:blue">{{__('admin/common.table.search_button')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <form name="destroy_all" method="post" action="{{route('admin.orders.destroy_all')}}" >
                    @csrf
                    <table class="table table nowrap table-bordered table-striped no-footer dtr-inline">
                        <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" id="checkAll"></th>
                            <th scope="col">{{ __('admin/common.table.title')}}</th>
                            <th scope="col">{{ __('admin/common.table.contest')}}</th>
                            <th scope="col">{{ __('admin/common.table.user_name')}}</th>
                            <th scope="col">{{ __('admin/common.table.win_type')}}</th>
                            <th scope="col">{{ __('admin/common.table.status')}}</th>
                            <th scope="col">{{ __('admin/common.table.acions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($pages) > 0)
                            @foreach($pages as $page)
                                <tr>
                                    <td scope="row">
                                        <input type="checkbox" name="ids[{{ $page->id }}]" value="{{ $page->id }}">
                                    </td>
                                    <td>
                                        <div class="name-avatar d-flex align-items-center">
                                            <div class="txt">
                                                <div class="weight-600">{{ $page->title }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="name-avatar d-flex align-items-center">
                                            <div class="txt">
                                                <a href="{{ route('admin.orders.contest_orders',$page->contest->id) }}"><div class="weight-600">{{ $page->contest->title }}</div></a>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    
                                    <td>
                                        <div class="name-avatar d-flex align-items-center">
                                            <div class="txt">
                                                <div class="weight-600">{{ $page->user_name }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7" style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">
                                            @if($page->win_type == 'winner')
                                            {{ __('admin/order.index.winner') }}
                                            @elseif($page->win_type == 'loser')
                                            {{ __('admin/order.index.not_winner') }}
                                            @endif
                                        </span>
                                    
                                        @if(AdminCan('order-edit'))
                                            @if($page->win_type != 'winner')
                                            <a href="{{ route('admin.orders.winner',$page->id) }}" data-color="#111" style="color: rgb(38, 94, 215);">تعيين كفائز</a>
                                            @endif
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7" style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">
                                            @if($page->status == 'payed')
                                            {{ __('admin/order.index.payed') }}
                                            @elseif($page->status == 'not_payed')
                                            {{ __('admin/order.index.not_payed') }}
                                            @else
                                            {{ __('admin/order.index.canceled') }}
                                            @endif
                                        </span>
                                    
                                        @if(AdminCan('order-edit'))
                                            @if($page->status != 'payed')
                                            <a href="{{ route('admin.orders.approve',$page->id) }}" data-color="#111" style="color: rgb(38, 94, 215);">تأكيد الاشتراك</a>
                                            @endif
                                        @endif
                                    </td>

                                    <td>
                                        <div class="table-actions">
                                            @if(AdminCan('order-edit'))
                                                <a href="{{ route('admin.orders.edit',$page->id) }}" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                            @endif
                                            @if(AdminCan('order-delete'))
                                                    <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion_{{ $page->id }}')" data-color="#e95959" style="color: rgb(233, 89, 89);  cursor: pointer;"><i class="icon-copy dw dw-delete-3"></i></a>
                                                    <x-modal name="confirm-deletion_{{ $page->id }}" focusable>
                                                        <div class="p-6">
                                                            <h2 class="text-lg font-medium text-gray-900">
                                                                {{ __('admin/common.messages.delete_title',['name' => $page->title]) }}
                                                            </h2>

                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ __('admin/common.messages.delete_desc') }}
                                                            </p>

                                                            <div class="mt-6 flex justify-end">
                                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                                    {{ __('admin/common.messages.cancel') }}
                                                                </x-secondary-button>

                                                                <a href="{{ route('admin.orders.delete',$page->id) }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3">
                                                                    {{ __('admin/common.messages.confirm_delete') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </x-modal>
{{--                                                <a href="{{ route('admin.orders.delete',$page->id) }}" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>--}}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">{{ __('admin/order.index.notfound') }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {!! $pages->links() !!}
                    <input class="btn btn-danger hidden destroy_all" type="submit" name="destroy_all" value="{{ __('admin/common.table.delete_selected') }}" style="background:red">
                </form>
            </div>
        </div>
    </div>
    @section('page_title'){{ __('admin/order.index.title_tag') }}@endsection
</x-admin-layout>