
<header class="topbar">
    <!-- ============================================================== -->
    <!-- Navbar scss in header.scss -->
    <!-- ============================================================== -->
    <nav>
        <div class="nav-wrapper">
            <!-- ============================================================== -->
            <!-- Logo you can find that scss in header.scss -->
            <!-- ============================================================== -->
            <a href="javascript:void(0)" class="brand-logo">
                <span class="icon">
                    <img class="light-logo" src="{{ asset('assets/images/logo-light-icon.png') }}">
                    <img class="dark-logo" src="{{ asset('assets/images/logo-icon.png') }}">
                </span>
                <span class="text">
                    <img class="light-logo" src="{{ asset('assets/images/logo-light-text.png') }}">
                    <img class="dark-logo" src="{{ asset('assets/images/logo-text.png') }}">
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- Logo you can find that scss in header.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left topbar icon scss in header.scss -->
            <!-- ============================================================== -->
            <ul class="left">
                <li class="hide-on-med-and-down">
                    <a href="javascript: void(0);" class="nav-toggle">
                        <span class="bars bar1"></span>
                        <span class="bars bar2"></span>
                        <span class="bars bar3"></span>
                    </a>
                </li>
                <li class="hide-on-large-only">
                    <a href="javascript: void(0);" class="sidebar-toggle">
                        <span class="bars bar1"></span>
                        <span class="bars bar2"></span>
                        <span class="bars bar3"></span>
                    </a>
                </li>


            <!--     <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </a>

                    <ul class="dropdown-menu">
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <li>
                                <a href="#">
                                    {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                                </a>
                            </li>
                        @empty
                            <li><a href="#">Aucune notification</a></li>
                        @endforelse
                    </ul>
                </div>
            -->

                        <!-- ============================================================== -->
                        <!-- Notification icon scss in header.scss -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="dropdown-trigger" href="javascript: void(0);" data-target="noti_dropdown"><i class="material-icons">notifications
                            </i>


                        </a>
                            <ul id="noti_dropdown" class="mailbox dropdown-content">
                                <li>
                                    <div class="drop-title">Notifications</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                     @forelse(auth()->user()->notifications as $notification)
                                        <a href="">
                                                <span class="mail-contnet">
                                                    <h5>{{ $notification->data['message'] ?? 'Nouvelle notification' }}</h5>
                                                    <span class="time"></span>
                                                    @if (is_null($notification->read_at))
                                                    <span class="badge badge-danger">Non lue</span>
                                                    @else
                                                    <span class="badge badge-success">Lue</span>
                                                    @endif
                                                    <a href="{{ route('notifications.markAsRead', $notification->id) }}">Marquer comme lue</a>
                                                </span>
                                            </a>
                                      @empty
                                            <a href="#">Aucune notification</a>
                                      @endforelse
                                    </div>
                                </li>
                                <li>
                                    <a class="center-align" href="javascript:void(0);"> <strong>Check all notifications</strong> </a>
                                </li>
                            </ul>
                        </li>

                <!-- ============================================================== -->
                <!-- Comment topbar icon scss in header.scss -->
                <!-- ============================================================== -->
                <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="msg_dropdown"><i
                            class="material-icons">comment</i></a>
                    <ul id="msg_dropdown" class="mailbox dropdown-content">
                        <li>
                            <div class="drop-title">You have 4 new messages</div>
                        </li>
                        <li>
                            <div class="message-center">
                                <!-- Message -->
                                <a href="#">
                                    <span class="user-img">
                                        <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user"
                                            class="circle">
                                        <span class="profile-status online pull-right"></span>
                                    </span>
                                    <span class="mail-contnet">
                                        <h5>Chris Evans</h5>
                                        <span class="mail-desc">Just see the my admin!</span>
                                        <span class="time">9:30 AM</span>
                                    </span>
                                </a>
                                <!-- Message -->
                                <a href="#">
                                    <span class="user-img">
                                        <img src="{{ asset('assets/images/users/2.jpg') }}" alt="user"
                                            class="circle">
                                        <span class="profile-status busy pull-right"></span>
                                    </span>
                                    <span class="mail-contnet">
                                        <h5>Ray Hudson</h5>
                                        <span class="mail-desc">I've sung a song! See you at</span>
                                        <span class="time">9:10 AM</span>
                                    </span>
                                </a>
                                <!-- Message -->
                                <a href="#">
                                    <span class="user-img">
                                        <img src="{{ asset('assets/images/users/3.jpg') }}" alt="user"
                                            class="circle">
                                        <span class="profile-status away pull-right"></span>
                                    </span>
                                    <span class="mail-contnet">
                                        <h5>Lb James</h5>
                                        <span class="mail-desc">I am a singer!</span>
                                        <span class="time">9:08 AM</span>
                                    </span>
                                </a>
                                <!-- Message -->
                                <a href="#">
                                    <span class="user-img">
                                        <img src="{{ asset('assets/images/users/4.jpg') }}" alt="user"
                                            class="circle">
                                        <span class="profile-status offline pull-right"></span>
                                    </span>
                                    <span class="mail-contnet">
                                        <h5>Don Andres</h5>
                                        <span class="mail-desc">Just see the my admin!</span>
                                        <span class="time">9:02 AM</span>
                                    </span>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="center-align" href="javascript:void(0);"> <strong>See all
                                    e-Mails</strong> </a>
                        </li>
                    </ul>
                </li>
                <li class="search-box">
                    <a href="javascript: void(0);"><i class="material-icons">search</i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                            class="srh-btn"><i class="ti-close"></i></a>
                    </form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Left topbar icon scss in header.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right topbar icon scss in header.scss -->
            <!-- ============================================================== -->
            <ul class="right">
                <li class="lang-dropdown"><a class="dropdown-trigger" href="javascript: void(0);"
                        data-target="lang_dropdown"><i class="flag-icon flag-icon-in"></i></a>
                    <ul id="lang_dropdown" class="dropdown-content">
                        <li>
                            <a href="#!" class="grey-text text-darken-1">
                                <i class="flag-icon flag-icon-us"></i> English</a>
                        </li>
                        <li>
                            <a href="#!" class="grey-text text-darken-1">
                                <i class="flag-icon flag-icon-fr"></i> French</a>
                        </li>
                        <li>
                            <a href="#!" class="grey-text text-darken-1">
                                <i class="flag-icon flag-icon-es"></i> Spanish</a>
                        </li>
                        <li>
                            <a href="#!" class="grey-text text-darken-1">
                                <i class="flag-icon flag-icon-de"></i> German</a>
                        </li>
                    </ul>
                </li>
                <!-- ============================================================== -->
                <!-- Profile icon scss in header.scss -->
                <!-- ============================================================== -->
                <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="user_dropdown"><img
                            src="{{ asset('users/images/' . Auth::user()->photo) }}" alt="user"
                            class="circle profile-pic"></a>
                    <ul id="user_dropdown" class="mailbox dropdown-content dropdown-user">
                        <li>
                            <div class="dw-user-box">
                                <div class="u-img"><img src="{{ asset('users/images/' . Auth::user()->photo) }}"
                                        alt="user"></div>
                                <div class="u-text">
                                    <h4>{{ Auth::user()->prenom . '  ' . Auth::user()->nom }}</h4>
                                    <p>{{ Auth::user()->email }}</p>
                                    <a class="waves-effect waves-light btn-small red white-text">View
                                        Profile</a>
                                </div>
                            </div>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><i class="material-icons">account_circle</i> My Profile</a></li>
                        <li><a href="#"><i class="material-icons">account_balance_wallet</i> My
                                Balance</a></li>
                        <li><a href="#"><i class="material-icons">inbox</i> Inbox</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><i class="material-icons">settings</i> Account Setting</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}"><i class="material-icons">power_settings_new</i>
                                Logout</a></li>
                        {{-- <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i
                                    class="material-icons">power_settings_new</i></button>
                        </form> --}}
                    </ul>

                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right topbar icon scss in header.scss -->
            <!-- ============================================================== -->
        </div>
    </nav>
    <!-- ============================================================== -->
    <!-- Navbar scss in header.scss -->
    <!-- ============================================================== -->
</header>
