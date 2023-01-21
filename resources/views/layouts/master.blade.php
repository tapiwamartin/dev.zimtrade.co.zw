<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wallet</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/quill/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/quill/quill.snow.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/choices.js/choices.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/widgets/chat.css')}}">
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/png">
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href=""><img src="{{asset('images/logo.png')}}" style="height: 100px;margin-left: 50px;"></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">

                    <li class="sidebar-item  ">
                        <a href="{{route('dashboard')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Wallet Transactions</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{route('deposit.index')}}">View Deposits</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{route('deposit.create')}}">New Deposit</a>
                            </li>

                        </ul>
                    </li>

@can('isAdmin')
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-screwdriver"></i>
                            <span>Configurations</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{route('region.index')}}">Regions</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{route('currency.index')}}">Currency</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{route('narration.index')}}">Narration</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{route('user.index')}}">Users</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{route('role.index')}}">Roles</a>
                            </li>

                        </ul>
                    </li>
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-receipt"></i>
                            <span>Reporting</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{route('report.daily')}}">Daily</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{route('report.weekly')}}">Weekly</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{route('report.monthly')}}">Monthly</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{route('report.range')}}">Range(Reports as per given range)</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{route('report.agents')}}">Overall Wallet Report</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-chat-dots"></i>
                            <span>Statement</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{route('newsletter.index')}}">View</a>
                            </li>

                        </ul>
                    </li>
                    @endcan
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main" class='layout-navbar'>
        <header class='mb-3'>
            <nav class="navbar navbar-expand navbar-light ">
                <div class="container-fluid">
                    <a href="#" class="burger-btn d-block">
                        <i class="bi bi-justify fs-3"></i>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

<!--                            <li class="nav-item dropdown me-1">
                                <a type="button" class="btn btn-outline-transparent" data-bs-toggle="modal"
                                   data-bs-target="#large">
                                    <i class='bi bi-question bi-sub fs-4 text-gray-600'></i>
                                </a>

                            </li>-->

                            <li class="nav-item dropdown me-3">
                                <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Notifications</h6>
                                    </li>
                                    <li><a class="dropdown-item">No notification available</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">

                                        <p class="mb-0 text-sm text-gray-600">{{Auth::user()->name}}</p>
                                        <p class="mb-0 text-sm  {{Auth::user()->authorised(Auth::id())==null?"text-danger":"text-success"}} ">{{Auth::user()->authorised(Auth::id())==null?"UnAuthorised":"Authorised"}}</p>
                                    </div>
                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="{{asset('images/avatar.png')}}">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">

                                <li><a class="dropdown-item" href="{{route('user.profile')}}"><i class="icon-mid bi bi-person me-2"></i> My
                                        Profile</a></li>
                                <li><a class="dropdown-item" href="{{route('useractivity.index')}}"><i class="icon-mid bi bi-gear me-2"></i>
                                        User Activity Log</a></li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i
                                            class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div id="main-content">

            @include('vendor.sweetalert.alert')

             @yield('content')

               {{-- <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Example Content</h4>
                        </div>
                        <div class="card-body">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur quas omnis laudantium tempore
                            exercitationem, expedita aspernatur sed officia asperiores unde tempora maxime odio reprehenderit
                            distinctio incidunt! Vel aspernatur dicta consequatur!
                        </div>
                    </div>
                </section>--}}
            <div class="me-1 mb-1 d-inline-block">
                <!-- Button trigger for large size modal -->
                <!--large size Modal -->
                <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                         role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel17">Help Instructions</h4>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="text-center">
                        <p><script>document.write(new Date().getFullYear())</script> &copy Wallet</p>
                    </div>
<!--                    <div class="float-end">
                        <p>System Developed with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="#">Kadabole</a></p>
                    </div>-->
                </div>
            </footer>
        </div>
    </div>
<script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendors/quill/quill.min.js')}}"></script>

<script src="{{asset('assets/js/pages/form-editor.js')}}"></script>
<script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>

<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>


<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('assets/vendors/choices.js/choices.min.js')}}"></script>
<script src="{{asset('assets/js/pages/form-element-select.js')}}"></script>
</body>

</html>
