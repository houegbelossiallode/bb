<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Materialart Admin Template</title>
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
    <!-- This page CSS -->
    <link href="{{ asset('assets/libs/morris.js/morris.css') }}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <!--c3 CSS -->
    <link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/data-table.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/extra-libs/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/pricing-page.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/select2.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .table-container {
            overflow-x: auto;
            white-space: nowrap;
            width: 100%;
            margin: 0;
        }

        .table-container2 {
            overflow-x: auto;
            /*white-space: nowrap;*/
            width: 100%;
            margin: 0;
        }

        .offre {
            background-color: gray;
            color: white;
            margin: auto;
            padding: 5px;
            text-align: center;
        }

        .price-row {
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="main-wrapper" id="main-wrapper">
        @auth
            <div class="preloader">
                <div class="loader">
                    <div class="loader__figure"></div>
                    <p class="loader__label">Application de courtage</p>
                </div>
            </div>
        @else
            <div class="preloader">
                <div class="loader">
                    <div class="loader__figure"></div>
                    <p class="loader__label">Connexion en cours</p>
                </div>
            </div>
        @endauth

        @include('layouts.header')
        @include('layouts.sidebar')
        <div class="page-wrapper">

            @yield('section')

            <footer class="center-align m-b-30">All Rights Reserved by FC ELOHIM. Designed and Developed by <a
                    href="https://wrappixel.com">FC ELOHIM</a>.</footer>
        </div>

        <a href="#" data-target="right-slide-out"
            class="sidenav-trigger right-side-toggle btn-floating btn-large waves-effect waves-light red"><i
                class="material-icons">settings</i></a>
        <aside class="right-sidebar">
            <!-- Right Sidebar -->
            <ul id="right-slide-out" class="sidenav right-sidenav p-t-10">
                <li>
                    <div class="row">
                        <div class="col s12">
                            <!-- Tabs -->
                            <ul class="tabs">
                                <li class="tab col s4"><a href="#settings" class="active"><span
                                            class="material-icons">build</span></a></li>
                                <li class="tab col s4"><a href="#chat"><span
                                            class="material-icons">chat_bubble</span></a></li>
                                <li class="tab col s4"><a href="#activity"><span
                                            class="material-icons">local_activity</span></a></li>
                            </ul>
                            <!-- Tabs -->
                        </div>
                        <!-- Setting -->
                        <div id="settings" class="col s12">
                            <div class="m-t-10 p-10 b-b">
                                <h6 class="font-medium">Layout Settings</h6>
                                <ul class="m-t-15">
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" name="theme-view" id="theme-view" />
                                            <span>Dark Theme</span>
                                        </label>
                                    </li>
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" class="nav-toggle" name="collapssidebar"
                                                id="collapssidebar" />
                                            <span>Collapse Sidebar</span>
                                        </label>
                                    </li>
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" name="sidebar-position" id="sidebar-position" />
                                            <span>Fixed Sidebar</span>
                                        </label>
                                    </li>
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" name="header-position" id="header-position" />
                                            <span>Fixed Header</span>
                                        </label>
                                    </li>
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" name="boxed-layout" id="boxed-layout" />
                                            <span>Boxed Layout</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="p-10 b-b">
                                <!-- Logo BG -->
                                <h6 class="font-medium">Logo Backgrounds</h6>
                                <ul class="m-t-15 theme-color">
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-logobg="skin1"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-logobg="skin2"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-logobg="skin3"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-logobg="skin4"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-logobg="skin5"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-logobg="skin6"></a></li>
                                </ul>
                                <!-- Logo BG -->
                            </div>
                            <div class="p-10 b-b">
                                <!-- Navbar BG -->
                                <h6 class="font-medium">Navbar Backgrounds</h6>
                                <ul class="m-t-15 theme-color">
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-navbarbg="skin1"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-navbarbg="skin2"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-navbarbg="skin3"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-navbarbg="skin4"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-navbarbg="skin5"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-navbarbg="skin6"></a></li>
                                </ul>
                                <!-- Navbar BG -->
                            </div>
                            <div class="p-10 b-b">
                                <!-- Logo BG -->
                                <h6 class="font-medium">Sidebar Backgrounds</h6>
                                <ul class="m-t-15 theme-color">
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-sidebarbg="skin1"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-sidebarbg="skin2"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-sidebarbg="skin3"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-sidebarbg="skin4"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-sidebarbg="skin5"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                            data-sidebarbg="skin6"></a></li>
                                </ul>
                                <!-- Logo BG -->
                            </div>
                        </div>
                        <!-- chat -->
                        <div id="chat" class="col s12">
                            <ul class="mailbox m-t-20">
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_1' data-user-id='1'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status online pull-right"
                                                    data-status="online"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Chris Evans</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_2' data-user-id='2'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/2.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status busy pull-right"
                                                    data-status="busy"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Ray Hudson</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_3' data-user-id='3'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/3.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status away pull-right"
                                                    data-status="away"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Lb James</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_4' data-user-id='4'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/4.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status offline pull-right"
                                                    data-status="offline"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Don Andres</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_5' data-user-id='5'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status online pull-right"
                                                    data-status="online"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Chris Evans</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_6' data-user-id='6'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/2.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status busy pull-right"
                                                    data-status="busy"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Ray Hudson</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_7' data-user-id='7'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/3.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status away pull-right"
                                                    data-status="away"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Lb James</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_8' data-user-id='8'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/4.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status offline pull-right"
                                                    data-status="offline"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Don Andres</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_9' data-user-id='9'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status online pull-right"
                                                    data-status="online"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Chris Evans</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_10' data-user-id='10'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/2.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status busy pull-right"
                                                    data-status="busy"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Ray Hudson</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_11' data-user-id='11'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/3.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status away pull-right"
                                                    data-status="away"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Lb James</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_12' data-user-id='12'>
                                            <span class="user-img">
                                                <img src="{{ asset('assets/images/users/4.jpg') }}" alt="user"
                                                    class="circle">
                                                <span class="profile-status offline pull-right"
                                                    data-status="offline"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Don Andres</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Activity -->
                        <div id="activity" class="col s12">
                            <div class="m-t-10 p-10">
                                <h6 class="font-medium">Activity Timeline</h6>
                                <div class="steamline">
                                    <div class="sl-item">
                                        <div class="sl-left green"> <i class="ti-user"></i></div>
                                        <div class="sl-right">
                                            <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span>
                                            </div>
                                            <div class="desc">you can write anything </div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left blue"><i class="fa fa-image"></i></div>
                                        <div class="sl-right">
                                            <div class="font-medium">Send documents to Clark</div>
                                            <div class="desc">Lorem Ipsum is simply </div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img class="circle" alt="user"
                                                src="{{ asset('assets/images/users/2.jpg') }}"> </div>
                                        <div class="sl-right">
                                            <div class="font-medium">Go to the Doctor <span class="sl-date">5
                                                    minutes ago</span></div>
                                            <div class="desc">Contrary to popular belief</div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img class="circle" alt="user"
                                                src="{{ asset('assets/images/users/1.jpg') }}"> </div>
                                        <div class="sl-right">
                                            <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5
                                                    minutes ago</span></div>
                                            <div class="desc">Approve meeting with tiger</div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left teal"> <i class="ti-user"></i></div>
                                        <div class="sl-right">
                                            <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span>
                                            </div>
                                            <div class="desc">you can write anything </div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left purple"><i class="fa fa-image"></i></div>
                                        <div class="sl-right">
                                            <div class="font-medium">Send documents to Clark</div>
                                            <div class="desc">Lorem Ipsum is simply </div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img class="circle" alt="user"
                                                src="{{ asset('assets/images/users/4.jpg') }}"> </div>
                                        <div class="sl-right">
                                            <div class="font-medium">Go to the Doctor <span class="sl-date">5
                                                    minutes ago</span></div>
                                            <div class="desc">Contrary to popular belief</div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img class="circle" alt="user"
                                                src="{{ asset('assets/images/users/6.jpg') }}"> </div>
                                        <div class="sl-right">
                                            <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5
                                                    minutes ago</span></div>
                                            <div class="desc">Approve meeting with tiger</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </aside>
        <div class="chat-windows"></div>
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('dist/js/jquery.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('dist/js/materialize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Apps -->
    <!-- ============================================================== -->
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{ asset('dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Custom js -->
    <!-- ============================================================== -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <!--c3 JavaScript -->
    <script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard4.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Morris JavaScript -->
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>

    <!--- Alert -->
    <script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweet-alert.init.js') }}"></script>

    <!-- Editable -->
    <script src="{{ asset('assets/extra-libs/Datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/datatable/datatable-basic.init.js') }}"></script>

    <script src="{{ asset('assets/extra-libs/prism/prism.js') }}"></script>

    <script src="{{ asset('assets/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jquery.repeater/repeater-init.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jquery.repeater/dff.js') }}"></script>
    <script src="{{ asset('dist/js/select2.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (Route::currentRouteName() === 'objectif.new' || Route::currentRouteName() === 'objectif.edit')
                var typeObjectif = document.getElementById("type");
                if (typeObjectif) {
                    typeObjectif.addEventListener("change", function() {
                        var blocRecompense = document.getElementById("blocRecompense");
                        if (blocRecompense) {
                            blocRecompense.style.display = this.value === "Challenge" ? "block" :
                                "none";
                        }
                    });
                }
            @endif
            @if (Route::currentRouteName() === 'users.client.new' || Route::currentRouteName() === 'users.edit')
                var typeElement = document.getElementById("type");
                if (typeElement) {
                    typeElement.addEventListener("change", function() {
                        var blocType = document.getElementById("blocType");
                        if (blocType) {
                            blocType.style.display = this.value === "Personne morale" ? "block" : "none";
                        }
                    });
                }
            @endif

            @if (Route::currentRouteName() === 'users.new' || Route::currentRouteName() === 'users.edit')
                var roleElement = document.getElementById("role");
                if (roleElement) {
                    roleElement.addEventListener("change", function() {
                        var blocRole = document.getElementById("blocRole");
                        var blocNiveau = document.getElementById("blocNiveau");
                        if (blocRole) {
                            blocRole.style.display = this.value === "Personnel" ? "block" : "none";
                        }
                        if (blocNiveau) {
                            blocNiveau.style.display = this.value === "Commercial" ? "block" : "none";
                        }
                    });
                }
            @endif

            @if (Route::currentRouteName() === 'formulaire.new' || Route::currentRouteName() === 'formulaire.edit')
                var typechampElement = document.getElementById("typechamp");
                if (typechampElement) {
                    typechampElement.addEventListener("change", function() {
                        var blocChamp = document.getElementById("blocChamp");
                        if (blocChamp) {
                            blocChamp.style.display = this.value === "select" ? "block" : "none";
                        }
                    });
                }
            @endif

            @if (Route::currentRouteName() === 'offre.new')


                document.getElementById('produit').addEventListener('change', function() {
                    let produitId = this.value;

                    if (produitId) {
                        fetch(`/information/${produitId}`)
                            .then(response => response.json())
                            .then(data => {
                                let formulairesHtml =
                                    '<h3 class="offre m-t-40 m-b-40">Informations sur le produit</h3>';
                                let garantiesHtml =
                                    '<h3 class="offre m-t-40 m-b-40">Informations sur les garanties</h3>';

                                // Affichage des formulaires liés au produit
                                data.infos.forEach(function(formulaire, index) {
                                    formulairesHtml += `<input type="hidden" name="repeater-group[${index}][nom]"
                                                    value="${formulaire.nom}">
                                                <input type="hidden" name="repeater-group[${index}][type]"
                                                    value="${formulaire.type}">`;
                                    if (formulaire.type === "text") {
                                        formulairesHtml += `<div class="input-field col s12 l6">
                                                        <input id="champ${index}" name="repeater-group[${index}][information]" type="text"
                                                            class="validate" value="" required>
                                                        <label for="champ${index}">${formulaire.nom}</label>
                                                    </div>`;
                                    }

                                    if (formulaire.type === "date") {
                                        formulairesHtml += `<div class="input-field col s12 l6">
                                                        <input id="champ${index}" name="repeater-group[${index}][information]" type="date"
                                                            class="validate" value="" required>
                                                        <label for="champ${index}">${formulaire.nom}</label>
                                                    </div>`;
                                    }

                                    if (formulaire.type === "number") {
                                        formulairesHtml += `<div class="input-field col s12 l6">
                                                        <input id="champ${index}" name="repeater-group[${index}][information]" type="number"
                                                            class="validate" value="" required>
                                                        <label for="champ${index}">${formulaire.nom}</label>
                                                    </div>`;
                                    }

                                    if (formulaire.type === "FCFA" || formulaire.type ===
                                        "Kg" || formulaire.type === "ans" || formulaire.type ===
                                        "mois" || formulaire.type === "jours" || formulaire
                                        .type === "Cv" ||
                                        formulaire.type === "m2" || formulaire
                                        .type === "%") {
                                        formulairesHtml += `<div class="input-field col s12 l6">
                                                        <input id="champ${index}" name="repeater-group[${index}][information]" type="number"
                                                            class="validate" value="" required>
                                                        <label for="champ${index}">${formulaire.nom}</label>
                                                    </div>`;
                                    }

                                    if (formulaire.type === "file") {
                                        formulairesHtml += `<div class="file-field input-field col s12 l6">
                                                        <div class="btn darken-1">
                                                            <span>${formulaire.nom}</span>
                                                            <input type="file" name="repeater-group[${index}][fichier]">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input id="champ${index}"
                                                                name="repeater-group[${index}][information]"
                                                                class="file-path validate "
                                                                type="text" required>
                                                            
                                                        </div>
                                                    </div>`
                                    }

                                    if (formulaire.type === "textarea") {
                                        formulairesHtml += `<div class="input-field col s12 l6">
                                    <textarea id="champ${index}" name="repeater-group[${index}][information]"
                                        class="materialize-textarea validate" required></textarea>
                                    <label for="champ${index}">${formulaire.nom}</label>
                                    
                                </div>`
                                    }

                                    if (formulaire.type === "select" && formulaire.options) {
                                        formulairesHtml += `<input type="hidden" name="repeater-group[${index}][options]"
                                value='${formulaire.jsons}'>
                                <div class="input-field col s12 l6">
                                    <select id="champ${index}" name="repeater-group[${index}][information]" class="validate" data-error=".errorTxt6" required>
                                        <option value="" disabled selected>Choisir une option</option>
                                        ${formulaire.options.map(option => `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="${option.option}">${option.option}</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            `).join('')}
                                    </select>
                                    <label for="champ${index}">${formulaire.nom}</label>
                                </div>`;
                                    }
                                });

                                // Affichage des garanties liées au produit
                                data.garanties.forEach(function(garantie, index) {
                                    garantiesHtml +=
                                        `
                                            <div class="input-field col s12 m-b-40">
                                                <label>
                                                    <input type="checkbox" id="garantie${index}" value="${garantie.id}" />
                                                    <span>${garantie.nom}</span>
                                                </label>
                                            </div>
                                            <div id="formulaires-garantie${index}" class="formulaires-garantie"></div>`;
                                });

                                document.getElementById('formulaires').innerHTML = formulairesHtml;
                                document.getElementById('garanties').innerHTML = garantiesHtml;

                                // Initialisation des éléments select si vous utilisez Materialize CSS
                                if (typeof M !== 'undefined') {
                                    M.FormSelect.init(document.querySelectorAll('select'));
                                }

                                // Ajout d'un événement change pour chaque case à cocher de garantie
                                data.garanties.forEach(function(garantie, index) {
                                    document.getElementById(`garantie${index}`)
                                        .addEventListener('change',
                                            function() {
                                                let isChecked = this.checked;
                                                let formulairesGarantieHtml = `<input type="hidden" name="garantie-group[${index}][id]"
                                                                    value="${garantie.id}">`;

                                                if (isChecked) {
                                                    garantie.formulaires.forEach(function(
                                                        formulaire, i) {
                                                        formulairesGarantieHtml += `<input type="hidden" name="garantie-group[${index}][${i}][nom]"
                                                                    value="${formulaire.nom}">
                                                                <input type="hidden" name="garantie-group[${index}][${i}][type]"
                                                                    value="${formulaire.type}">`;
                                                        if (formulaire.type ===
                                                            "text") {
                                                            formulairesGarantieHtml += `<div class="input-field col s12 l6">
                                                                        <input id="champ${index}-${i}" name="garantie-group[${index}][${i}][information]" type="text"
                                                                            class="validate" value="" required>
                                                                        <label for="champ${index}-${i}">${formulaire.nom}</label>
                                                                    </div>`;
                                                        }

                                                        if (formulaire.type ===
                                                            "date") {
                                                            formulairesGarantieHtml += `<div class="input-field col s12 l6">
                                                                        <input id="champ${index}-${i}" name="garantie-group[${index}][${i}][information]" type="date"
                                                                            class="validate" value="" required>
                                                                        <label for="champ${index}-${i}">${formulaire.nom}</label>
                                                                    </div>`;
                                                        }

                                                        if (formulaire.type ===
                                                            "number") {
                                                            formulairesGarantieHtml += `<div class="input-field col s12 l6">
                                                                        <input id="champ${index}-${i}" name="garantie-group[${index}][${i}][information]" type="number"
                                                                            class="validate" value="" required>
                                                                        <label for="champ${index}-${i}">${formulaire.nom}</label>
                                                                    </div>`;
                                                        }

                                                        if (formulaire.type ===
                                                            "FCFA" || formulaire
                                                            .type ===
                                                            "Kg" || formulaire.type ===
                                                            "ans" || formulaire.type ===
                                                            "mois" || formulaire
                                                            .type === "jours" ||
                                                            formulaire.type === "Cv" ||
                                                            formulaire.type === "m2" ||
                                                            formulaire
                                                            .type === "%") {
                                                            formulairesGarantieHtml += `<div class="input-field col s12 l6">
                                                                        <input id="champ${index}-${i}" name="garantie-group[${index}][${i}][information]" type="number"
                                                                            class="validate" value="" required>
                                                                        <label for="champ${index}-${i}">${formulaire.nom}</label>
                                                                    </div>`;

                                                        }

                                                        if (formulaire.type ===
                                                            "file") {
                                                            formulairesGarantieHtml += `<div class="file-field input-field col s12 l6">
                                                                        <div class="btn darken-1">
                                                                            <span>${formulaire.nom}</span>
                                                                            <input type="file" name="garantie-group[${index}][${i}][fichier]">
                                                                        </div>
                                                                        <div class="file-path-wrapper">
                                                                            <input id="champ${index}-${i}"
                                                                                name="garantie-group[${index}][${i}][information]"
                                                                                class="file-path validate "
                                                                                type="text" required>
                                                                            
                                                                        </div>
                                                                    </div>`
                                                        }

                                                        if (formulaire.type ===
                                                            "textarea") {
                                                            formulairesGarantieHtml += `<div class="input-field col s12 l6">
                                                                        <textarea id="champ${index}-${i}" name="garantie-group[${index}][${i}][information]"
                                                                            class="materialize-textarea validate" required></textarea>
                                                                        <label for="champ${index}-${i}">${formulaire.nom}</label>
                                                                        
                                                                    </div>`
                                                        }

                                                        if (formulaire.type ===
                                                            "select" && formulaire
                                                            .options) {
                                                            formulairesGarantieHtml += `<input type="hidden" name="garantie-group[${index}][${i}][options]"
                                                                    value='${formulaire.jsons}'>
                                                                    <div class="input-field col s12 l6">
                                                                        <select id="champ${index}-${i}" name="garantie-group[${index}][${i}][information]" class="validate" data-error=".errorTxt6" required>
                                                                            <option value="" disabled selected>Choisir une option</option>
                                                                            ${formulaire.options.map(option => `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="${option.option}">${option.option}</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                `).join('')}
                                                                        </select>
                                                                        <label for="champ${index}-${i}">${formulaire.nom}</label>
                                                                    </div>`;
                                                        }
                                                    });
                                                }

                                                document.getElementById(
                                                        `formulaires-garantie${index}`)
                                                    .innerHTML = formulairesGarantieHtml;

                                                // Initialisation des éléments select si vous utilisez Materialize CSS
                                                if (typeof M !== 'undefined') {
                                                    M.FormSelect.init(document.querySelectorAll(
                                                        'select'));
                                                }
                                            });
                                });
                            });
                    } else {
                        document.getElementById('formulaires').innerHTML = '';
                        document.getElementById('garanties').innerHTML = '';
                    }
                });
            @endif

            @if (Route::currentRouteName() === 'production')
                $(document).ready(function() {
                    // Initialiser le composant select avec Select2
                    $('#clientselect2').select2({
                        placeholder: "Sélectionnez le client",
                        allowClear: true,
                        width: '100%' // Pour que le select prenne tout l'espace disponible
                    });
                });
            @endif


        });

        function toggleFormulaires(garantieId) {
            var checkbox = document.getElementById('garantie_' + garantieId);
            var formulaireDiv = document.getElementById('formulaires_' + garantieId);

            if (checkbox.checked) {
                formulaireDiv.style.display = 'block';
            } else {
                formulaireDiv.style.display = 'none';
            }
        }

        function toggleRefField(radioButton) {
            const refField = document.getElementById('refField');

            if (radioButton.value === 'old') {
                refField.style.display = 'block';
            } else {
                refField.style.display = 'none';
            }
        }

        function updateProductionLink() {
            const productionButton = document.getElementById('productionButton');
            const selectedGroup = document.querySelector('input[name="groupe"]:checked');

            if (selectedGroup) {
                const groupId = selectedGroup.value;
                productionButton.classList.remove('disabled');
                productionButton.href = `{{ url('/production/new') }}/${groupId}`;
            } else {
                productionButton.classList.add('disabled');
            }
        }

        function getTarif(event) {
            event.preventDefault();
            const formData = new FormData(document.getElementById('tarifForm'));
            const data = Object.fromEntries(formData.entries());

            fetch("{{ route('tarif.get') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',

                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);

                    if (Array.isArray(data.infos) && data.infos.length > 0) {
                        let minPrime = Number.MAX_VALUE;
                        let minIndex = -1;

                        // Trouver la prime la plus petite
                        data.infos.forEach((info, index) => {
                            const primeValue = parseFloat(info.prime.replace(/[^0-9,]/g, '').replace(',', '.'));
                            if (primeValue < minPrime) {
                                minPrime = primeValue;
                                minIndex = index;
                            }
                        });

                        // Générer le HTML avec la mise en évidence de la prime la plus basse
                        let resultHTML = '<ul>';
                        data.infos.forEach((info, index) => {
                            const isMin = index === minIndex;
                            const style = isMin ? 'style="color: green; font-weight: bold;"' : '';
                            resultHTML += `<li ${style}>
                Compagnie: ${info.compagnie} <br>
                Prime: ${info.prime} <br>
                Réduction: ${info.reduction}
            </li><br>`;
                        });
                        resultHTML += '</ul>';

                        document.getElementById('tarif-result').innerHTML = resultHTML;
                    } else {
                        document.getElementById('tarif-result').innerHTML =
                            'Pas de tarif trouvé pour cette combinaison et compagnie.';
                    }
                })

        }

        function getSingleTarif(id) {
            const champPrime = document.getElementById('champPrime');
            const compagnie = document.querySelector('input[name="compagnie"]:checked');

            if (compagnie) {
                const value = compagnie.value;
                //console.log(value);

                fetch(`/tarif/${id}/${value}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        //console.log(data);
                        if (data.info) {
                            let resultHTML = '<span>';
                            resultHTML += `
                Prime : ${data.info.prime} <br>
                Réduction : ${data.info.reduction}`;
                            resultHTML += '</span>';
                            champPrime.innerHTML = resultHTML;
                        } else {
                            champPrime.innerHTML =
                                'Pas de tarif trouvé pour cette combinaison et compagnie.';
                        }



                    })
            } else {
                console.log("bbb");

            }
        }
    </script>
</body>

</html>
