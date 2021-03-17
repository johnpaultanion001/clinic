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
            
            @can('about_view')
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
            @can('schedule_view')
            <li class="nav-item">
                <a href="{{ route("admin.schedule.index") }}" class="nav-link {{ request()->is('admin/schedule') || request()->is('admin/schedule/*') ? 'active' : '' }}">
                    <i class="nav-icon fa-fw fas fa-calendar">

                    </i>
                    {{ trans('global.schedule') }}
                </a>
            </li>
            @endcan

            @can('transaction_view')
                <li class="nav-item">
                    <a href="{{ route("admin.schedule.list") }}" class="nav-link">
                    
                        <i class="nav-icon far fa-folder"></i>
                    
                        {{ trans('global.transaction') }}
                    </a>
                </li>
            @endcan

            @can('contact_view')
                <li class="nav-item">
                    <a href="{{ route("admin.contact") }}" class="nav-link">
                    
                        <i class="nav-icon far fa-address-book"></i>
                    
                        {{ trans('global.contact') }}
                    </a>
                </li>
            @endcan
            @can('feedback_setting')
                <li class="nav-item">
                    <a href="{{ route("admin.feedbacks.index") }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope-square"></i>
                         Feedback
                    </a>
                </li>
            @endcan

            @can('scheduledlist_access')
                <li class="nav-item">
                    <a href="{{ route("admin.scheduled-list.index") }}" class="nav-link {{ request()->is('admin/scheduled-list') || request()->is('admin/scheduled-list/*') ? 'active' : '' }}">
                    <i class="nav-icon fa-fw fas fa-calendar">
                    </i>    
                            Scheduled List
                    </a>
                </li>
            @endcan

            @can('history_access')
                <li class="nav-item">
                    <a href="{{ route("admin.histories.index") }}" class="nav-link {{ request()->is('admin/histories') || request()->is('admin/historiest/*') ? 'active' : '' }}">
                      <i class="nav-icon far fa-folder"></i>
                            Histories List
                    </a>
                </li>
            @endcan

            @can('setting_view')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-cog nav-icon">

                        </i>
                        Settings
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('purpose_setting')
                            <li class="nav-item">
                                <a href="{{ route("admin.purposes.index") }}" class="nav-link {{ request()->is('admin/purposes') || request()->is('admin/purposes/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-circle nav-icon">
                                    </i>
                                    General Checkup List
                                </a>
                            </li>
                        @endcan
                        @can('announcements_setting')
                        <li class="nav-item">
                            <a href="{{ route("admin.announcements.index") }}" class="nav-link {{ request()->is('admin/announcements') || request()->is('admin/announcements/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-circle nav-icon">
                                </i>
                               Announcements List
                            </a>
                        </li>
                        @endcan
                        @can('aboutus_setting')
                        <li class="nav-item">
                            <a href="{{ route("admin.aboutus.index") }}" class="nav-link {{ request()->is('admin/aboutus') || request()->is('admin/aboutus/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-circle nav-icon">
                                </i>
                               About List
                            </a>
                        </li>
                        @endcan
                        @can('contacts_setting')
                        <li class="nav-item">
                            <a href="{{ route("admin.contacts.index") }}" class="nav-link {{ request()->is('admin/contacts') || request()->is('admin/contacts/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-circle nav-icon">
                                </i>
                                Contacts List
                            </a>
                        </li>
                        @endcan
                        @can('holiday_setting')
                        <li class="nav-item">
                            <a href="{{ route("admin.holidays.index") }}" class="nav-link {{ request()->is('admin/holidays') || request()->is('admin/holidays/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-circle nav-icon">
                                </i>
                                Holidays List
                            </a>
                        </li>
                        @endcan
                        @can('fulldate_setting')
                        <li class="nav-item">
                            <a href="{{ route("admin.fulldates.index") }}" class="nav-link {{ request()->is('admin/fulldates') || request()->is('admin/fulldates/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-circle nav-icon">
                                </i>
                                Limit Per Day
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            <li class="nav-item">
                    <a href="{{ route('admin.user-client.edit', auth()->user()->id) }}" class="nav-link {{ request()->is('admin/user-client') || request()->is('admin/user-client/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                            User
                    </a>
            </li>

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