<div class="topbar" id="barbar">
    <div class="topbar-left">
        <a href="/" class="logo logo-size">
            <img src="assets/images/logo.png" alt="LOGO" class="rounded-circle mr-2">
        </a>
    </div>
    <nav class="navbar-custom">
        <ul class="navbar-right d-flex list-inline float-right mb-0"> 
            <li class="dropdown notification-list">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hi {{ Auth()->user()->fname }}</span>
                        <img @if (Auth()->user()->image == "") src="assets/images/profile-dummy.png" @elseif (Auth()->user()->image !== "") src="assets/images/{{ Auth()->user()->image }}" @endif alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <a class="dropdown-item" href="/userprofile"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="mdi mdi-power text-danger"></i> {{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </li>
        </ul>
    </nav>
</div>