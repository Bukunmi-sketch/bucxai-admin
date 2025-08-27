<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ url('/') }}">
                <img src="https://res.cloudinary.com/morshudlhgmo/image/upload/v1711503888/Bundlegram/350_100_yoaddn.png"
                    class="header-brand-img main-logo" alt="Bundlegram Logo">
                <img src="https://res.cloudinary.com/morshudlhgmo/image/upload/v1711503888/Bundlegram/350_100_yoaddn.png"
                    class="header-brand-img darklogo" alt="Bundlegram Logo">
                <img src="https://res.cloudinary.com/morshudlhgmo/image/upload/v1711503888/Bundlegram/512_512_fav_sqt78i.png"
                    class="header-brand-img
                    icon-logo" alt="Bundlegram Logo">
                <img src="https://res.cloudinary.com/morshudlhgmo/image/upload/v1711503888/Bundlegram/512_512_fav_sqt78i.png"
                    class="header-brand-img icon-logo2" alt="Bundlegram Logo">
            </a>
        </div>
        <!-- logo-->
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ url('/') }}"><i
                            class="side-menu__icon ri-home-4-line"></i><span
                            class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon ri-building-4-line"></i><span class="side-menu__label">Manage
                            Product</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side5">
                                        <ul class="sidemenu-list">

                                            <li>
                                                <a href="{{ route('admin.products-list', ['type' => 'data-topup']) }}" wire:navigate class="slide-item">Data Topup</a>
                                            </li>
                                            <li><a href="{{ route('admin.products-list', ['type' => 'buy-airtime']) }}" wire:navigate class="slide-item"> Buy Airtime</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.products-list', ['type' => 'bill-payment']) }}" wire:navigate class="slide-item"> Bill Payment</a>
                                                {{-- <a href="{{ url('calendar') }}" class="slide-item"> Bill Payment</a> --}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon ri-shield-user-line"></i><span class="side-menu__label">Manage
                            Users</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu mega-slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side9">
                                        <ul class="sidemenu-list">
                                            <li class="side-menu-label1"><a href="javascript:void(0)">Manage Users</a>
                                            </li>
                                            <li class="mega-menu">
                                                <div class="">
                                                    <ul>
                                                        <li><a href="{{ route('admin.users') }}" wire:navigate class="slide-item">All Users</a></li>
                                                        <li><a href="{{ route('admin.users-type', ['slug' => 'active']) }}" class="slide-item">
                                                                Active Users</a></li>
                                                        <li><a href="{{ route('admin.users-type', ['slug' => 'verified']) }}" class="slide-item">
                                                                Verified Users</a></li>
                                                        <li><a href="{{ route('admin.users-type', ['slug' => 'unverified']) }}" class="slide-item">
                                                                Unverified Users</a></li>
                                                        <li><a href="{{ route('admin.users-type', ['slug' => 'agent']) }}" class="slide-item">
                                                                Agent Management</a></li>
                                                        <li><a href="{{ route('admin.users-type', ['slug' => 'banned']) }}" class="slide-item">
                                                                Banned Users</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon ri-bar-chart-line"></i><span class="side-menu__label">Manage
                            Transactions</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side13">
                                        <ul class="sidemenu-list">
                                            <li class="side-menu-label1"><a href="javascript:void(0)">Manage
                                                    Transactions</a>
                                            </li>
                                            <li class="mega-menu">
                                                <div class="">
                                                    <ul>
                                                        <li><a href="{{ route('admin.transaction-list', ['slug' => 'success']) }}" wire:navigate class="slide-item">
                                                                Approved Transactions</a></li>
                                                        <li><a href="{{ route('admin.transaction-list', ['slug' => 'pending']) }}" wire:navigate class="slide-item">
                                                                Pending Transactions</a></li>
                                                        <li><a href="{{ route('admin.transaction-list', ['slug' => 'failed']) }}" wire:navigate class="slide-item">
                                                                Failed Transactions</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon ri-search-eye-line"></i><span class="side-menu__label">Query
                            Transactions</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side13">
                                        <ul class="sidemenu-list">
                                            <li class="side-menu-label1"><a href="javascript:void(0)">Query Transactions</a> </li>
                                            <li class="mega-menu">
                                                <div class="">

                                                    <ul>
                                                        <li><a href="{{ route('admin.transaction-query', ['slug' => 'purchase']) }}" class="slide-item">
                                                                Purchase Transactions</a></li>

                                                     <li><a href="{{ route('admin.wallet-transaction') }}" class="slide-item">
                                                                Wallet Transactions</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('admin.manage-wallet') }}"><i
                            class="side-menu__icon ri-wallet-line"></i><span class="side-menu__label">Manage
                            Wallet</span></a>
                </li>
                <li class="slide">
                    <a  href="{{ route('admin.bulk-airtime')}}" wire:navigate class="side-menu__item has-link" data-bs-toggle="slide">
                        <i class="side-menu__icon ri-store-3-line"></i><span class="side-menu__label">Print Bulk
                            Airtime</span></a>

                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('admin.noticeboard') }}"><i
                            class="side-menu__icon ri-notification-badge-line"></i><span
                            class="side-menu__label">Noticeboard</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon ri-team-line"></i><span class="side-menu__label">Team</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side13">
                                        <ul class="sidemenu-list">
                                            <li class="side-menu-label1"><a href="javascript:void(0)">Team</a>
                                            </li>
                                            <li class="mega-menu">
                                                <div class="">
                                                    <ul>
                                                        <li><a href="{{ url('alerts') }}" class="slide-item">
                                                                Admins</a></li>
                                                        <li><a href="{{ url('buttons') }}" class="slide-item">
                                                                Staff</a></li>
                                                        <li><a href="{{ url('colors') }}" class="slide-item">
                                                                Permission</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon ri-tools-line"></i><span class="side-menu__label">Settings</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side13">
                                        <ul class="sidemenu-list">
                                            <li class="side-menu-label1"><a href="javascript:void(0)">Settings</a>
                                            </li>
                                            <li class="mega-menu">
                                                <div class="">
                                                    <ul>
                                                        <li><a href="{{ url('alerts') }}" class="slide-item">
                                                                System Settings</a></li>
                                                        <li><a href="{{ url('buttons') }}" class="slide-item">
                                                                API Settings</a></li>
                                                        <li><a href="{{ url('colors') }}" class="slide-item">
                                                                Email Settings</a></li>
                                                        <li><a href="{{ url('colors') }}" class="slide-item">
                                                                Special Settings</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="slide">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="side-menu__item has-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{-- <i class="side-menu__icon ri-message-3-line"></i> --}}
                        <i class="dropdown-icon fe fe-log-out"></i>
                        <span class="side-menu__label">Log out</span>
                    </a>
                </li>

                {{-- <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ url('/') }}"><i
                            class="side-menu__icon ri-message-3-line"></i><span
                            class="side-menu__label">Agent</span></a>
                </li> --}}
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
</div>

