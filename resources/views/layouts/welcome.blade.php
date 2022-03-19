<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZimTrade</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/png">
</head>

<body>
<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <img src="{{asset('images/logo.png')}}" style="height: 60px; display: block;
    margin: 0 auto;">
            </a> &nbsp;&nbsp;

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item dropdown me-3">

                        <img src="{{asset('images/court.png')}}" style="height: 60px; display: block;
    margin: 0 auto;">


                    </li>
                </ul>

            </div>
        </div>
    </nav>
</header>

<div class="container col-md-8">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-10 col-md-6 order-md-1 order-last">
                    <h3>Diplomatic Trade Inquiry System</h3>
                    <p class="text-subtitle text-muted">Energising Zimbabwe Export Growth </p>
                </div>
<!--                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">About Us</li>

                        </ol>
                    </nav>
                </div>-->
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Getting Started</h4>
                </div>
                <div class="card-body">
                   ZimTrade have come up with a diplomatic trade inquiry system that will enable organisational stakeholders to relay and address
                    their issues eloquently via the new system.Users have to create an account inorder to use the system.To Create
                    an account click <a class="btn btn-outline-info" href="{{route('register')}}"><b>CREATE ACCOUNT</b></a>. If you already have an account, you can log in by clicking
                    <a class="btn btn-outline-info" href="{{route('login')}}">LOGIN</a>. After logging in, there is a fluent help/support that will allow you to learn how to
                    navigate through the system.

                </div>
            </div>
        </section>
        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; ZimTrade</p>
                </div>
                
            </div>
        </footer>
    </div>
</div>
<script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>


</body>

</html>
