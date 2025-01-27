<!DOCTYPE html>
<html lang="en">
@php
$banner = App\Models\HomepageCMS::select('header_banner_image')->first();
@endphp
<head>
    <meta charset="utf-8">
    <title>Tender Bangla | Tender & Auction Notice of Bangladesh</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords" content="Tender Bangla, Bangladesh tender, auction notice, tender notice, free tender, premium tender, public procurement, e-tender, government tender, private tender, auction in Bangladesh">
    <meta name="description" content="Tender Bangla is the leading platform for free and premium tender and auction notices in Bangladesh. Stay updated with the latest tender and procurement opportunities.">
    <meta name="author" content="Mehedi Hasan John">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Tender Bangla | Tender & Auction Notice of Bangladesh">
    <meta property="og:description" content="Discover the latest tender and auction notices in Bangladesh. Access free and premium procurement opportunities.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.tenderbangla.com">
    <meta property="og:image" content="{{ $banner->header_banner_image }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Tender Bangla | Tender & Auction Notice of Bangladesh">
    <meta name="twitter:description" content="Stay updated with free and premium tender and auction opportunities in Bangladesh.">
    <meta name="twitter:image" content="{{ $banner->header_banner_image }}">

    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />

    <link rel="canonical" href="https://tenderbangla.com">


    <meta name="facebook-domain-verification" content="76hgoqqsld4vic2cy3pwg7k9ci0jf6" />

    <!-- Favicon -->
    <link href="{{ asset('frontendAssets/images/fav.jpg') }}" rel="icon">

    <!-- Google Web Fonts -->
    {{-- <link href="https://fonts.cdnfonts.com/css/li-ador-noirrit" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@100..800&display=swap" rel="stylesheet">


    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontendAssets') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('frontendAssets') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{{ asset('frontendAssets') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontendAssets') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontendAssets') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('frontendAssets') }}/css/default.css" rel="stylesheet">
    <link href="{{ asset('frontendAssets') }}/css/custom.css" rel="stylesheet">

<!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '3035982509899966');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=3035982509899966&ev=PageView&noscript=1"
    /></noscript>
<!-- End Meta Pixel Code -->
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    @include('frontend.include.header')

    @yield('content')


    @include('frontend.include.footer')

    @php
    $cms = App\Models\HomepageCMS::select('whatsapp_number')->first();
    @endphp

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-sm-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <div class="messenger_div">
        <a href="https://wa.me/{{ $cms->whatsapp_number }}">
            <img class="img-fluid messenger_logo" src="{{ asset('frontendAssets') }}/images/whatsapp.png" alt="Icon">
        </a>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontendAssets') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('frontendAssets') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('frontendAssets') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('frontendAssets') }}/lib/typed/typed.min.js"></script>
    <script src="{{ asset('frontendAssets') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('frontendAssets') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('frontendAssets') }}/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="{{ asset('frontendAssets') }}/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontendAssets') }}/js/main.js"></script>
    <!-- Code injected by live-server -->
    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>

    </script>
</body>

</html>
