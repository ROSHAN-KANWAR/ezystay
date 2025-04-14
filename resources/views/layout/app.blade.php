<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ezystay - @yield('title')</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('public/css/styles.css')}}">
</head>
@stack('styles')
<body class="sb-nav-fixed">
<div class="container-fluid">
    @yield('main-section')
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('public/js/scripts.js')}}"></script>
    @stack('scripts')
    </body>
</html>
