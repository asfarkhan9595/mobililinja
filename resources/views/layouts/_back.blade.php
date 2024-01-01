<!doctype html>
<html lang="en">
<head>
    <title> @yield('title') {{ config('app.name', 'mobiililinja.fi') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    @include ('_back._inc._styles')
@stack('page_style')
</head>

<body class="theme-cyan font-krub light_version">
    <!-- Page Loader -->
    <div class="page-loader-wrapper" style="display: none;">
        <div class="loader">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
            <div class="bar4"></div>
            <div class="bar5"></div>
        </div>
    </div>
    <!-- Theme Setting -->
    <div class="themesetting">
        <a href="javascript:void(0);" class="theme_btn"><i class="icon-magic-wand"></i></a>
        <div class="card theme_color">
            <div class="header">
                <h2>Theme Color</h2>
            </div>
            <ul class="choose-skin list-unstyled mb-0">
                <li data-theme="green">
                    <div class="green"></div>
                </li>
                <li data-theme="orange">
                    <div class="orange"></div>
                </li>
                <li data-theme="blush">
                    <div class="blush"></div>
                </li>
                <li data-theme="cyan" class="active">
                    <div class="cyan"></div>
                </li>
                <li data-theme="indigo">
                    <div class="indigo"></div>
                </li>
                <li data-theme="red">
                    <div class="red"></div>
                </li>
            </ul>
        </div>
        <div class="card setting_switch">
            <div class="header">
                <h2>Settings</h2>
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    Light Version
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="lv-btn" checked="">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li class="list-group-item">
                    Horizontal Henu
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="hmenu-btn">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li class="list-group-item">
                    Mini Sidebar
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="mini-sidebar-btn">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">
        <nav class="navbar top-navbar">
            <div class="container-fluid">
                <div class="navbar-left">
                    <div class="navbar-btn">
                        <a href="#"><img src="assets/images/logo_small.png" alt="Logo" class="img-fluid logo"></a>
                        <button type="button" class="btn-toggle-offcanvas"><i
                                class="lnr lnr-menu fa fa-bars"></i></button>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="dropdown language-menu">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="fa fa-language"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item pt-2 pb-2" href="#"><img src="{{ asset('_back/images/flag/fi.png') }}" class="w20 mr-2 rounded-circle"> Suomi</a>
                                <a class="dropdown-item pt-2 pb-2" href="#"><img src="{{ asset('_back/images/flag/se.png') }}" class="w20 mr-2 rounded-circle"> Swedish</a>
                                <a class="dropdown-item pt-2 pb-2" href="#"><img src="{{ asset('_back/images/flag/gb.png') }}" class="w20 mr-2 rounded-circle"> English</a>
                            </div>
                        </li>
                        <li><a href="javascript:void(0);" class="megamenu_toggle icon-menu" title="Mega Menu"><i
                                    class="fa fa-life-ring"></i> Support</a></li>
                    </ul>
                </div>

                <div class="navbar-right">
                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                            <li><a href="javascript:void(0);" class="right_toggle icon-menu" title="Right Menu"><i
                                        class="icon-call-end"></i></a></li>
                            <li><a href="{{ route('logout') }}" class="icon-menu" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-power"></i></a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf </form>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="progress-container">
                <div class="progress-bar" id="myBar"></div>
            </div>
        </nav>

        <div id="megamenu" class="megamenu particles_js">
            <a href="javascript:void(0);" class="megamenu_toggle btn btn-danger"><i class="icon-close"></i></a>
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="mega-card">
                            <h6 class="title">Video</h6>
                            <video id="my-video" class="video-js" controls="" preload="auto" width="1920" height="1080"
                                poster="assets/video/admin.png" data-setup="{}">
                                <source src="assets/video/promo.mp4" type="video/mp4">
                                <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a web browser
                                    that
                                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5
                                        video</a>
                                </p>
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rightbar" class="rightbar">
            <div class="body">
                <ul class="nav nav-tabs2">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Phone">Phone</a></li>
                </ul>
                <hr>
                <div class="tab-content" id="sipClient">
                    <div class="tab-pane vivify fadeIn delay-100 active" id="Phone">
                        <div class="container-fluid">
                            <div class="clearfix sipStatus">
                                <div id="txtCallStatus" class="pull-right">&nbsp;</div>
                                <div id="txtRegStatus"></div>
                            </div>

                            <div class="form-group" id="phoneUI">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <div id="sip-dialpad" class="dropdown-menu">
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="1">1<span>&nbsp;</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="2">2<span>ABC</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="3">3<span>DEF</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="4">4<span>GHI</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="5">5<span>JKL</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="6">6<span>MNO</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="7">7<span>PQRS</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="8">8<span>TUV</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="9">9<span>WXYZ</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="*">*<span>&nbsp;</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="0">0<span>+</span></button>
                                            <button type="button" class="btn btn-default digit"
                                                data-digit="#">#<span>&nbsp;</span></button>
                                            <div class="clearfix">&nbsp;</div>
                                            <button class="btn btn-success btn-block btnCall" title="Send">
                                                <i class="fa fa-phone"></i> Call
                                            </button>
                                        </div>
                                        <button class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                            title="Show Keypad">
                                            <i class="fa fa-th"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="number" id="numDisplay"
                                        class="form-control text-center input-sm" value="" placeholder="Enter number..."
                                        autocomplete="off">
                                    <div class="input-group-btn input-group-btn-sm">
                                        <button class="btn btn-info dropdown-toggle" id="btnVol" data-toggle="dropdown"
                                            title="Volume">
                                            <i class="fa fa-fw fa-volume-up"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <input type="range" min="0" max="100" value="100" step="1" id="sldVolume">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="width:auto; height:350px; overflow:auto;">
                                <div class="well-sip">
                                    <h4 class="text-muted panel-title">Recent Calls <span class="pull-right"><i
                                                class="fa fa-trash text-muted sipLogClear" title="Clear Log"></i></span>
                                    </h4>
                                    <div id="sip-log" class="panel panel-default hide">
                                        <div id="sip-logitems" class="list-group">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="mdlError" tabindex="-1" role="dialog" aria-hidden="true"
                                data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Sip Error</h4>
                                        </div>
                                        <div class="modal-body text-center text-danger">
                                            <h3><i class="fa fa-3x fa-ban"></i></h3>
                                            <p class="lead">Sip registration failed. No calls can be handled.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include ('_back._inc._sidebar')
        <div id="main-content">
            <div class="container-fluid">
                @include ('_back._inc.message')
                @yield('content')
            </div>
        </div>
    </div>
    @include ('_back._inc._scripts')
    @stack('page_script')
</body>
</html>
