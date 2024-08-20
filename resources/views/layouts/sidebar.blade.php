<div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">
            <div id="sidebar-menu">
                <ul class="sidebarmenu accordion" id="side-menu">
                    <li class="{{ request()->is('dashboard') || request()->is('dashboard/*') ? 'active-a' : '' }}">
                        <a href="/dashboard">
                            <i class="mdi mdi-view-dashboard"></i><span>Dashboard </span>
                        </a>
                    </li>
                    <li class="{{ request()->is('fingerprint') || request()->is('fingerprint/*') ? 'active-a' : '' }}">
                        <a href="/fingerprint">
                            <i class="mdi mdi-fingerprint"></i><span>Fingerprint</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('instructors') || request()->is('instructors/*') ? 'active-a' : '' }}">
                        <a href="/instructors">
                            <i class="mdi mdi-account-group"></i><span>Instructors</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('records') || request()->is('records/*') ? 'active-a' : '' }}">
                        <a href="/records">
                            <i class="mdi mdi-list-box"></i><span>Records</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>