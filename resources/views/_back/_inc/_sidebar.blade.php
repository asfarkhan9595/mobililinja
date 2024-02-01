<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="#"><img src="{{ asset('_back/images/logo_icon.png') }}" class="img-fluid logo"><span><img
                    src="{{ asset('_back/images/logo_txt.png') }}"></span></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i
                class="lnr lnr-menu icon-close"></i></button>
    </div>
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 65px);">
        <div class="sidebar-scroll" style="overflow: hidden; width: auto; height: calc(100vh - 65px);">
            <div class="user-account">
                <div class="user_div">
                    <img src="{{ asset('_back/images/user.png') }}" class="user-photo" alt="User Profile Picture">
                </div>
                <div class="dropdown">
                    <span>Welcome,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>Louis
                            Pierce</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                        <li><a href="profile.html"><i class="icon-settings"></i>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <!-- <li><a href="webphone.html"><i class="icon-call-end"></i><span>Webphone</span></a></li>
                <li class="active open"><a href="dashboard.html"><i class="icon-speedometer"></i><span>Dashboard</span></a></li>
                <li><a href="phonebook.html"><i class="icon-book-open"></i><span>Phonebook</span></a></li>
                <li><a href="calendar.html"><i class="icon-calendar"></i><span>Calendar</span></a></li>
                <li><a href="whatsapp.html"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a></li>
                <li class="header">Admin</li>
                <li><a href="numbers.html"><i class="icon-call-in"></i><span>Numbers</span></a></li>
                <li><a href="extensions.html"><i class="icon-user"></i><span>Extensions</span></a></li>
                <li><a href="ringgroups.html"><i class="icon-users"></i><span>Ring groups</span></a></li>
                <li><a href="conferences.html"><i class="icon-globe"></i><span>Conferences</span></a></li>
                <li><a href="ivr.html"><i class="icon-share"></i><span>IVR</span></a></li>
                <li><a href="timecondition.html"><i class="icon-clock"></i><span>Time Condition</span></a></li>
                <li><a href="callrecordings.html"><i class="icon-control-play"></i><span>Call recordings</span></a></li>
                <li><a href="systemrecordings.html"><i class="icon-volume-2"></i><span>System recordings</span></a></li>
                <li><a href="reports.html"><i class="icon-pie-chart"></i><span>Reports</span></a></li>
                -->

                @if(auth()->user()->hasRole(['superadmin','admin','customer']))
                <li class="header">Customer</li>
                <li><a href="webphone.html"><i class="icon-call-end"></i><span>Webphone</span></a></li>
                <li class="active open"><a href="dashboard.html"><i class="icon-speedometer"></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('customer.phonebooks.index') }}"><i class="icon-book-open"></i><span>Phonebook</span></a></li>
                <li><a href="calendar.html"><i class="icon-calendar"></i><span>Calendar</span></a></li>
                <li><a href="whatsapp.html"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a></li>
                @endif
                @if(auth()->user()->hasRole(['superadmin','admin']))
                <li class="header">SuperAdmin</li>
                    <li><a href="{{ route('superadmin.customers.index') }}"><i class="icon-globe"></i><span>Customers</span></a></li>
                    <li><a href="{{ route('superadmin.invoices.index') }}"><i class="icon-docs"></i><span>Invoices</span></a></li>
                    <li><a href="{{ route('superadmin.pstn.index') }}"><i class="icon-compass"></i><span>PSTN-numbers</span></a></li>
                    <li><a href="{{ route('superadmin.trunks.index') }}"><i class="icon-share"></i><span>Trunks</span></a></li>
                    <li><a href="{{ route('superadmin.outbounds.index') }}"><i class="icon-call-out"></i><span>Outbound routes</span></a></li>
                    <li><a href="{{ route('superadmin.firewalls.index') }}"><i class="icon-ban"></i><span>Firewall</span></a></li>
                @endif

                </ul>
            </nav>
        </div>
        <div class="slimScrollBar"
            style="background: rgb(28, 34, 44); width: 2px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 3px; z-index: 99; right: 1px; height: 94.2156px;">
        </div>
        <div class="slimScrollRail"
            style="width: 2px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
        </div>
    </div>
</div>
