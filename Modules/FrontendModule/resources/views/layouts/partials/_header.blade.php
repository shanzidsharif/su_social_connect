<header class="navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light px-0">
            <a class="navbar-brand order-1 py-0" href="{{ route('frontend.home') }}">
                <img loading="prelaod" decoding="async" class="img-fluid" width="200" src="{{ asset('assets/logo.png') }}"
                    alt="SU connect">
            </a>
            <div class="navbar-actions order-3 ml-0 ml-md-4">
                <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button"
                    data-toggle="collapse" data-target="#navigation"> <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
                <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('frontend.home') }}">Home</a>
                    </li>
                    @if (!auth()->check())
                        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Students
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('student.auth.login') }}">Log in</a>
                                <a class="dropdown-item"
                                    href="{{ route('student.auth.registration') }}">Registration</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Teachers
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('teacher.auth.login') }}">Log in</a>
                                <a class="dropdown-item"
                                    href="{{ route('teacher.auth.registration') }}">Registration</a>
                            </div>
                        </li>
                    @endif
                    @if (auth()->check() &&
                            auth()->user()->type(STUDENT))
                        <li class="nav-item"> <a class="nav-link" href="{{ route('student.teachers-list') }}">
                                Teachers
                            </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('student.chat') }}">
                                Messages
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img
                                    @if (!empty(auth()->user()['profile_image']))
                                        src="{{ asset('storage/users/profile_images') }}/{{ auth()->user()['profile_image'] }}"
                                    @else
                                        src="{{ asset('assets/default-user-icon.jpg') }}"
                                    @endif
                                    height="30" width="30" alt="User Image" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('student.profile.get') }}">Profile</a>
                                <a class="dropdown-item" href="#" onclick="$('#logout-form').submit()">
                                    Log out
                                </a>
                                <form action="{{ route('student.auth.logout') }}" method="post" hidden
                                    id="logout-form">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>

            </div>
        </nav>
    </div>
</header>
