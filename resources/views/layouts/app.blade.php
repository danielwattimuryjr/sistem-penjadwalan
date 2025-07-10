<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/soft-ui/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/soft-ui/img/favicon.png">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="/soft-ui/css/soft-ui-dashboard.css" rel="stylesheet" />

    @isset ($styles)
    {{ $styles }}
    @endisset
</head>

<body class="g-sidenav-show  bg-gray-100">
  <x-sidebar/>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <x-topbar title="{{ $title }}"/>

    <div class="container-fluid py-4">
        {{ $slot }}
    </div>
    
    <x-footer /> 
  </main>

  <!--   Core JS Files   -->
  <script src="/soft-ui/js/core/popper.min.js"></script>
  <script src="/soft-ui/js/core/bootstrap.min.js"></script>
  <script src="/soft-ui/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/soft-ui/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/soft-ui/js/soft-ui-dashboard.min.js?v=1.1.0"></script>

    @isset ($scripts)
    {{ $scripts }}
    @endisset
  
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>