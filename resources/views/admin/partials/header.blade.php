<div class="header">
    <div class="header-left">
        <div class="Menu_Toggle menu-icon bi bi-list"></div>
        <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
        <div class="header-search">
            <!-- Page Heading -->
            <a href=" {{ getSetting('site_url') }}" class="btn btn-primary">{{ __('admin/common.view_site') }}</a>
        </div>
    </div>
    <div class="header-right">
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/admin/vendors/images/img.jpg') }}" alt="" />
                                    <h3>John Doe</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/admin/vendors/images/photo1.jpg') }}" alt="" />
                                    <h3>Lea R. Frith</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/admin/vendors/images/photo2.jpg') }}" alt="" />
                                    <h3>Erik L. Richards</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/admin/vendors/images/photo3.jpg') }}" alt="" />
                                    <h3>John Doe</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/admin/vendors/images/photo4.jpg') }}" alt="" />
                                    <h3>Renee I. Hansen</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/admin/vendors/images/img.jpg') }}" alt="" />
                                    <h3>Vicki M. Coleman</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-name pt-10">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
							<span class="user-icon">
								<img src="{{ Auth::guard('admin')->user()->image }}" alt="{{ Auth::guard('admin')->user()->name }}" style="width: 100%;height: 100%;" />
							</span>
                    <span class="user-name">{{ Auth::guard('admin')->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="dw dw-user1"></i> {{ __('admin/common.profile') }}</a>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();this.closest('form').submit();"><i class="dw dw-logout"></i> {{ __('admin/common.logout') }}</a>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
