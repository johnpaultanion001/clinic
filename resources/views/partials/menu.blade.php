<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.today") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.today') }}
                </a>
            </li>
            
            @can('about_access')
                <li class="nav-item">
                    <a href="{{ route("admin.about") }}" class="nav-link">
                        <i class="nav-icon far fa-address-card">

                        </i>
                    
                        {{ trans('global.about') }}
                    </a>
                </li>
            @endcan
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('venue_access')
                <li class="nav-item">
                    <a href="{{ route("admin.venues.index") }}" class="nav-link {{ request()->is('admin/venues') || request()->is('admin/venues/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.venue.title') }}
                    </a>
                </li>
            @endcan
            @can('event_access')
                <li class="nav-item">
                    <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is('admin/events') || request()->is('admin/events/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.event.title') }}
                    </a>
                </li>
            @endcan
            @can('meeting_access')
                <li class="nav-item">
                    <a href="{{ route("admin.meetings.index") }}" class="nav-link {{ request()->is('admin/meetings') || request()->is('admin/meetings/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.meeting.title') }}
                    </a>
                </li>
            @endcan

            @can('schedule_access')
            <li class="nav-item">
                <a href="{{ route("admin.schedule.index") }}" class="nav-link {{ request()->is('admin/schedule') || request()->is('admin/schedule/*') ? 'active' : '' }}">
                    <i class="nav-icon fa-fw fas fa-calendar">

                    </i>
                    {{ trans('global.schedule') }}
                </a>
            </li>
            @endcan

            @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route("admin.transaction") }}" class="nav-link">
                    
                        <i class="nav-icon far fa-folder"></i>
                    
                        {{ trans('global.transaction') }}
                    </a>
                </li>
            @endcan

            @can('contact_access')
                <li class="nav-item">
                    <a href="{{ route("admin.contact") }}" class="nav-link">
                    
                        <i class="nav-icon far fa-address-book"></i>
                    
                        {{ trans('global.contact') }}
                    </a>
                </li>
            @endcan
           
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>