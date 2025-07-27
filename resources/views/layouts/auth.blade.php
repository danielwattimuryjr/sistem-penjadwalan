<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="/satria-muda/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/lightgallery.css">
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/alertify.min.css" />
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/default.min.css" />
    <script type="text/javascript" src="/satria-muda/js/jquery.js"></script>
</head>

<body class="bg-darkblue">
    <div class="container-fluid" id="signup-container">

        {{ $slot }}

        <div class="col-md-4 right-section">
            <div class="sticky-section">
                <div class="inside">
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="/satria-muda/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/slick.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="/satria-muda/js/validation.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/picturefill.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/lightgallery-all.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/jquery.mousewheel.min.js">
    </script>
    <script type="text/javascript" src="/satria-muda/js/lg-video.min.js">
    </script>
    <script type="text/javascript" src="/satria-muda/js/lg-thumbnail.min.js">
    </script>
    <script type="text/javascript" src="/satria-muda/js/lg-fullscreen.min.js">
    </script>
    <script type="text/javascript" src="/satria-muda/js/lg-hash.min.js">
    </script>
    <script type="text/javascript" src="/satria-muda/js/alertify.js"></script>
    <script type="text/javascript" src="/satria-muda/js/contactandnewsletter.js"></script>
    <script type="text/javascript">
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.header-menu').addClass("sticky");
            } else {
                $('.header-menu').removeClass("sticky");
            }
        });
    </script>
    <script src="/satria-muda/js/app.bundle.min.js"></script>
    @isset ($scripts)
    {{ $scripts }}
    @endisset
</body>

</html>