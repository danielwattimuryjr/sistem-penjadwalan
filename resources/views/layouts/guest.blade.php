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
    <link rel="stylesheet" type="text/css" href="/satria-muda/css/jquery.bxslider.css" />
    <script type="text/javascript" src="/satria-muda/js/jquery.js"></script>
    <script type="text/javascript" src="/satria-muda/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/jquery-ui.min.js"></script>
</head>

<body class="bg-darkblue">
    <x-guest.banner />
    <x-guest.navbar />

    {{ $slot }}

    <x-guest.footer />

    <script type="text/javascript" src="/satria-muda/js/slick.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="/satria-muda/js/validation.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/picturefill.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/lightgallery-all.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/lg-video.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/lg-thumbnail.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/membership.js"></script>
    <script type="text/javascript" src="/satria-muda/js/lg-fullscreen.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/lg-hash.min.js"></script>
    <script type="text/javascript" src="/satria-muda/js/alertify.js"></script>
    <script type="text/javascript" src="/satria-muda/js/contactandnewsletter.js"></script>
    <script type="text/javascript" src="/satria-muda/js/jquery.bxslider.js"></script>

    <script type="text/javascript">
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.header-menu').addClass("sticky");
            } else {
                $('.header-menu').removeClass("sticky");
            }
        });
        $(".center").slick({
            autoplay: true,
            useTransform: true,
            dots: false,
            infinite: true,
            centerMode: true,
            slidesToShow: 5,
            focusOnSelect: true,
            slidesToScroll: 3,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });
        $('#lightgallery').lightGallery({
            thumbnail: true
        });
        $('#lightgallery-video').lightGallery({
            loadYoutubeThumbnail: true,
            youtubeThumbSize: 0,
            videoMaxWidth: '80%',
        });

        $(".ads-footer").slick({
            arrows: false,
            autoplaySpeed: 5000,
            autoplay: true,
            dots: false,
            infinite: true,
            centerMode: true,
            variableWidth: true
        });

        $(".ads-footer-mobile").slick({
            arrows: false,
            autoplaySpeed: 5000,
            autoplay: true,
            dots: false,
            infinite: true,
            centerMode: true,
            variableWidth: true
        });

        $(".iklan-pertamina").slick({
            arrows: false,
            autoplaySpeed: 5000,
            autoplay: true,
            dots: false,
            infinite: true,
            variableWidth: true,

        });


        $('#modalIklan').css('display', 'flex');
        $('#modalIklan').modal('show');

        $('.bxslider').bxSlider({
            auto: true,
            pager: false,
            controls: true,
            touchEnabled: false,
            pause: 5000
        });
    </script>
    <script src="/satria-muda/js/app.bundle.min.js"></script>
</body>

</html>