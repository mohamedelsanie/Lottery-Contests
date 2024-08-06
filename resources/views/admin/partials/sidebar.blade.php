<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/admin/vendors/images/'.__('admin/common.logo')) }}" alt="" class="dark-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle no-arrow {{activeMenu('dashboard')}}">
                        <span class="micon bi bi-calendar4-week"></span><span class="mtext">{{ __('admin/common.sidebar.dashboard') }}</span>
                    </a>
                </li>
                <!--
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle {{activeMenu('users')}}">
                        <span class="micon fa fa-user-o"></span><span class="mtext">{{ __('admin/common.sidebar.users') }}</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.users.index') }}" class="@if(!request()->routeIs('admin.users.create')){{activeMenu('users')}}@endif">{{ __('admin/common.sidebar.users_sub') }}</a></li>
                        <li><a href="{{ route('admin.users.create') }}" class="@if(request()->routeIs('admin.users.create')) active @endif">{{ __('admin/common.sidebar.add_user') }}</a></li>

                    </ul>
                </li>
                -->

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle {{activeMenu('admins')}}">
                        <span class="micon fa fa-user-secret"></span><span class="mtext">{{ __('admin/common.sidebar.admins') }}</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.admins.index') }}" class="@if(!request()->routeIs('admin.admins.create')) {{activeMenu('admins')}} @endif">{{ __('admin/common.sidebar.admins_sub') }}</a></li>
                        <li><a href="{{ route('admin.admins.create') }}" class="@if(request()->routeIs('admin.admins.create')) active @endif">{{ __('admin/common.sidebar.add_admin') }}</a></li>
                        <li><a href="{{ route('admin.permissions.index') }}" class="{{activeMenu('permissions')}}">{{ __('admin/common.sidebar.permissions') }}</a></li>
                        <li><a href="{{ route('admin.roles.index') }}" class="{{activeMenu('roles')}}">{{ __('admin/common.sidebar.roles') }}</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle {{activeMenu('pages')}}">
                        <span class="micon fa fa-newspaper-o"></span><span class="mtext">{{ __('admin/common.sidebar.pages') }}</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.pages.index') }}" class="@if(!request()->routeIs('admin.pages.create')) {{activeMenu('pages')}} @endif">{{ __('admin/common.sidebar.pages_sub') }}</a></li>
                        <li><a href="{{ route('admin.pages.create') }}" class="@if(request()->routeIs('admin.pages.create')) active @endif">{{ __('admin/common.sidebar.add_page') }}</a></li>
                        <li><a href="{{ route('admin.page.comments.index') }}" class="@if(request()->routeIs('admin.page.comments.*')) active @endif">{{ __('admin/common.sidebar.page_comments') }}</a></li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle {{activeMenu('tours')}}">
                        <span class="micon fa fa-life-ring"></span><span class="mtext">{{ __('admin/common.sidebar.tours') }}</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.contests.index') }}" class="@if(!request()->routeIs('admin.contests.create')) {{activeMenu('contests')}} @endif">{{ __('admin/common.sidebar.tours_sub') }}</a></li>
                        <li><a href="{{ route('admin.contests.create') }}" class="@if(request()->routeIs('admin.contests.create')) active @endif">{{ __('admin/common.sidebar.add_tour') }}</a></li>
                        <li><a href="{{ route('admin.contest.categories.index') }}" class="{{activeMenu('contest/categories')}}">{{ __('admin/common.sidebar.tour_categories') }}</a></li>
                        <li><a href="{{ route('admin.contest.comments.index') }}" class="{{activeMenu('contest/comments')}}">{{ __('admin/common.sidebar.tour_comments') }}</a></li>
                    </ul>
                </li>



                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle @if(request()->routeIs('admin.news.*')) active @endif">
                        <span class="micon fa fa-newspaper-o"></span><span class="mtext">{{ __('admin/common.sidebar.posts') }}</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.posts.index') }}" class="@if(!request()->routeIs('admin.posts.create')) {{activeMenu('posts')}} @endif">{{ __('admin/common.sidebar.posts_sub') }}</a></li>
                        <li><a href="{{ route('admin.posts.create') }}" class="@if(request()->routeIs('admin.posts.create')) active @endif">{{ __('admin/common.sidebar.add_post') }}</a></li>
                        <li><a href="{{ route('admin.categories.index') }}" class="{{activeMenu('categories')}}">{{ __('admin/common.sidebar.posts_categories') }}</a></li>
                        <li><a href="{{ route('admin.comments.index') }}" class="{{activeMenu('comments')}}">{{ __('admin/common.sidebar.post_comments') }}</a></li>
                        <li><a href="{{ route('admin.tags.index') }}" class="{{activeMenu('tags')}}">{{ __('admin/common.sidebar.posts_tags') }}</a></li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle {{activeMenu('orders')}}">
                        <span class="micon fa fa-credit-card"></span><span class="mtext">{{ __('admin/common.sidebar.orders') }}</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.orders.index') }}" class="@if(!request()->routeIs('admin.orders.create')) {{activeMenu('orders')}} @endif">{{ __('admin/common.sidebar.orders_sub') }}</a></li>
                        <li><a href="{{ route('admin.orders.contests') }}" class="@if(request()->routeIs('admin.orders.contests')) active @endif">{{ __('admin/common.sidebar.order_contests') }}</a></li>
                        <li><a href="{{ route('admin.orders.create') }}" class="@if(request()->routeIs('admin.orders.create')) active @endif">{{ __('admin/common.sidebar.add_order') }}</a></li>

                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle {{activeMenu('contacts')}}">
                        <span class="micon fa fa-envelope"></span><span class="mtext">{{ __('admin/common.sidebar.contacts') }}</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.contacts.index') }}" class="@if(!request()->routeIs('admin.contacts.create')) {{activeMenu('contacts')}} @endif">{{ __('admin/common.sidebar.contacts_sub') }}</a></li>
                        <li><a href="{{ route('admin.contacts.create') }}" class="@if(request()->routeIs('admin.contacts.create')) active @endif">{{ __('admin/common.sidebar.add_contact') }}</a></li>

                    </ul>
                </li>

                @if(AdminCan('menu-edit'))
                <li>
                    <a href="{{ route('admin.menus.index') }}" class="dropdown-toggle no-arrow {{activeMenu('menus')}}">
                        <span class="micon fa fa-navicon"></span><span class="mtext">{{ __('admin/common.sidebar.menus') }}</span>
                    </a>
                </li>
                @endif
                @if(AdminCan('setting-edit'))
                <li>
                    <a href="{{ route('admin.settings') }}" class="dropdown-toggle no-arrow {{activeMenu('settings')}}">
                        <span class="micon fa fa-gears"></span><span class="mtext">{{ __('admin/common.sidebar.settings') }}</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('admin.media.index') }}" class="dropdown-toggle no-arrow {{activeMenu('media')}}">
                        <span class="micon fa fa-file-image-o"></span><span class="mtext">{{ __('admin/common.sidebar.media') }}</span>
                    </a>
                </li>

                <li><div class="dropdown-divider"></div></li>
                <li><div class="sidebar-small-cap">{{ __('admin/common.sidebar.extra') }}</div></li>
                <li>
                    <a href="{{ route('admin.profile.edit') }}" class="dropdown-toggle no-arrow {{activeMenu('profile')}}">
                        <span class="micon fa fa-info-circle"></span><span class="mtext">{{ __('admin/common.sidebar.profile') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.logout') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-power-off"></span><span class="mtext">{{ __('admin/common.sidebar.logout') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
