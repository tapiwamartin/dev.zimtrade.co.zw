<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{asset('assets/css/font.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/png">
</head>

<body>
<div class="container">
    @yield('content')
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
<script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>


</body>

</html>
