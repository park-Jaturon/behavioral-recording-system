<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('ระบบบันทึกติดตามพฤติกรรมเด็กเล็ก') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <!-- Flatpickr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"
        rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/locales/bootstrap-datepicker.th.min.js">
    </script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>

    <!-- jQuery UI Datetimepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <!-- fullcalender -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js'></script>

{{-- parsley.js --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var $url = {!! json_encode(url('/')) !!};
    </script>

    @yield('style')
</head>

<body>

    <div id="app">
        @auth
            <nav class="navbar  mt-0" style="background-color: #ffe1e1;">
                <div>

                </div>
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="justify-content-start flex-grow-1 mx-3">
                        <div>
                            <h5>ระบบบันทึกติดตามพฤติกรรมเด็กเล็ก</h5>

                        </div>
                    </div>


                    <!-- Right Side Of Navbar -->
                    <ul class="nav justify-content-end">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::User()->users_name }}
                            </a>
    
                            <div class="dropdown-menu dropdown-menu-end" style="position: absolute"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/profile/'.Auth::User()->users_id)}}">{{__('เปลี่ยนรหัสผ่าน')}}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>  
                        </li>
                    </ul>


                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">ระบบบันทึกติดตามพฤติกรรมเด็กเล็ก</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            {{-- Admin --}}
                            @if (Auth::User()->rank == 'admin')
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page"
                                            href="{{ route('admindashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('room.index') }}">ห้องเรียน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('index.manageteacher') }}">ครู</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('index.manageparents') }}">ผู้ปกกครง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('index.managestudent') }}">นักเรียน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('index.user') }}">ผู้ใช้งาน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('index.admin') }}">Admin</a>
                                    </li>
                                    {{-- <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            @endif
                            {{-- Teacher --}}
                            @if (Auth::User()->rank == 'teacher')
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                                    <li class="nav-item " hover:background-color: yellow;>
                                        <a class="nav-link" href="{{ route('teacher.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('teacher.room') }}">ห้องเรียน</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('index.check') }}">ลงเวลา</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('index.post') }}">ประกาศ</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('index.event') }}">ตารางเรียน</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('index.activity') }}">รูปกิจกรรม</a>
                                    </li>
                                    {{-- <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('index.behavior') }}">รายงานพฤติกรรม</a>
                                    </li> --}}
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('record.appraisal') }}">แบบประเมินพัฒนาการ</a>
                                    </li>
                                    <li>

                                        {{-- <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            บันทึกรายงาน
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('record.weight-height') }}">บันทึกน้ำหนัก - ส่วนสูง</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('record.appraisal') }}">แบบประเมินพัฒนาการ</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            @endif
                            {{-- Parent --}}
                            @if (Auth::User()->rank == 'parent')
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('home.parent') }}">Dashboard</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('show.descendant') }}">ห้องเรียน</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('time.descendant') }}">เวลาเรียน</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('post.descendant') }}">ประกาศ</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('events.descendant') }}">ตารางเรียน</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('activity.descendant') }}">รูปกิจกรรม</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('descendant.behaviors') }}">รายงานพฤติกรรม</a>
                                    </li>



                                    {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        บันทึกรายงาน
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item"
                                                href="#">บันทึกน้ำหนัก - ส่วนสูง</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="#">แบบประเมินพัฒนาการ</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </li> --}}
                                </ul>
                            @endif
                            {{-- <form class="d-flex mt-3" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </nav>
        @else
            <nav class="navbar navbar-expand-md  shadow-sm" style="background-color:#ffe1e1">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ __('ระบบบันทึกติดตามพฤติกรรมเด็กเล็ก') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        @endauth

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    <!-- AXIOS -->
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    {{-- CKEditor5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    {{-- echarts --}}
    <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    
    @yield('script')
</body>

</html>
