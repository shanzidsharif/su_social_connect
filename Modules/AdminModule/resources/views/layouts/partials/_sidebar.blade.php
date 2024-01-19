<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="index.html">
                <img src="{{ asset('assets') }}/logo.png" height="50" class="header-brand-img desktop-logo"
                    alt="logo">
                <img src="{{ asset('assets') }}/logo.png" height="50" class="header-brand-img toggle-logo"
                    alt="logo">
                <img src="{{ asset('assets') }}/logo.png" height="50" class="header-brand-img light-logo"
                    alt="logo">
                <img src="{{ asset('assets') }}/logo.png" height="50" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu" style="overflow: auto;max-height: 100vh;">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3 class="text-upper">Dashboard</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('admin.dashboard') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="sub-category">
                    <h3 class="text-upper">Chat</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('admin.chat') }}"><i
                            class="side-menu__icon fe fe-message-circle"></i><span
                            class="side-menu__label">Messages</span></a>
                </li>
                <li class="sub-category">
                    <h3>Notice board</h3>
                </li>
                <li class="slide {{ request()->segment(2) == 'notices' ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->segment(2) == 'notices' ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-cast"></i><span
                            class="side-menu__label">Notice</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.notices.create') }}"
                                class="slide-item {{ request()->is('admin/notices/create') ? 'active' : '' }}">
                                Add</a></li>
                    </ul>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.notices.index') }}"
                                class="slide-item {{ request()->is('admin/notices') ? 'active' : '' }}">
                                List</a></li>
                    </ul>
                </li>
                <li class="sub-category">
                    <h3>Blog</h3>
                </li>
                <li class="slide {{ request()->segment(2) == 'blogs' ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->segment(2) == 'blogs' ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-edit-3"></i><span class="side-menu__label">Blog</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.blogs.create') }}"
                                class="slide-item {{ request()->is('admin/blogs/create') ? 'active' : '' }}">
                                Add</a></li>
                    </ul>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.blogs.index') }}"
                                class="slide-item {{ request()->is('admin/blogs') ? 'active' : '' }}">
                                List</a></li>
                    </ul>
                </li>
                @if (auth()->user()->user_type === 'super-admin')
                    <li class="sub-category">
                        <h3>Assistant</h3>
                    </li>
                    <li class="slide {{ request()->segment(2) == 'assistants' ? 'active is-expanded' : '' }}">
                        <a class="side-menu__item {{ request()->segment(2) == 'assistants' ? 'active is-expanded' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0)"><i
                                class="side-menu__icon fe fe-users"></i><span
                                class="side-menu__label">Assistant</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('admin.assistants.create') }}"
                                    class="slide-item {{ request()->is('admin/assistants/create') ? 'active' : '' }}">
                                    Add</a></li>
                        </ul>
                        <ul class="slide-menu">
                            <li><a href="{{ route('admin.assistants.index') }}"
                                    class="slide-item {{ request()->is('admin/assistants') ? 'active' : '' }}">
                                    List</a></li>
                        </ul>
                    </li>
                @endif
                <li class="sub-category">
                    <h3>Teacher</h3>
                </li>
                <li class="slide {{ request()->segment(2) == 'teachers' ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->segment(2) == 'teachers' ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Teacher</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.teachers.create') }}"
                                class="slide-item {{ request()->is('admin/teachers/create') ? 'active' : '' }}">
                                Add</a></li>
                    </ul>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.teachers.index') }}"
                                class="slide-item {{ request()->is('admin/teachers') ? 'active' : '' }}">
                                List</a></li>
                    </ul>
                </li>
                <li class="sub-category">
                    <h3>Student</h3>
                </li>
                <li class="slide {{ request()->segment(2) == 'students' ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->segment(2) == 'students' ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Student</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.students.create') }}"
                                class="slide-item {{ request()->is('admin/students/create') ? 'active' : '' }}">
                                Add</a></li>
                    </ul>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.students.index') }}"
                                class="slide-item {{ request()->is('admin/students') ? 'active' : '' }}">
                                List</a></li>
                    </ul>
                </li>
            </ul>
            <div style="height: 100px;"></div>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
