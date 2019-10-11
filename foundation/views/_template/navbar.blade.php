<nav class="main-navbar navbar flex-row p-0 shadow-sm">
    <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between flex-grow-1">
        <sidebar-toggler-component></sidebar-toggler-component>

        <ul class="navbar-nav flex-row align-items-center navbar-nav-right">
            <li class="nav-item d-none d-lg-block">
                <fullscreen-toggler-component></fullscreen-toggler-component>
            </li>

            @include('foundation::_partials.navbar-messages')

            <li class="nav-item dropdown">
                <notifications-navbar-component></notifications-navbar-component>
            </li>

            <li class="nav-item">
                <skin-mode-toggler-component></skin-mode-toggler-component>
            </li>

            <li class="nav-item dropdown">
                <?php
                    /** @var  Arcanesoft\Foundation\Auth\Models\User|mixed  $user */
                    $user = auth()->user();
                ?>
                <a class="nav-link profile-dropdown-menu dropdown-toggle" id="profile-dropdown-menu"
                   href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="avatar">
                        <img src="{{ $user->avatar }}" alt="{{ $user->full_name }}">
                        <span class="status status-success"></span>
                    </div>
                    <div class="d-none d-sm-inline-block ml-sm-2">
                        <span class="user-name">{{ $user->full_name }}</span>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profile-dropdown-menu">
                    <a href="{{ route('admin::auth.profile.index') }}" class="dropdown-item">
                        <i class="fa fa-fw fa-user mr-2"></i> @lang('Profile')
                    </a>
                    <div class="dropdown-divider"></div>
                    <logout-nav-btn-component url="{{ route('auth::logout') }}" text="@lang('Logout')"></logout-nav-btn-component>
                </div>
            </li>
        </ul>
    </div>
</nav>
