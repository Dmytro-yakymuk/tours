<!DOCTYPE html>
<!--[if IE 7 ]> <html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Hunting Tour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Font Google -->
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Lato:300,400%7COpen+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <!-- End Font Google -->
    
    <!-- Library CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/library/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/library/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/library/jquery-ui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/library/owl.carousel.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/library/jquery.mb.YTPlayer.min.css') }}">
    <!-- End Library CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">


    
    @yield('css-extra')
        <!-- Calendar CSS -->
    <!-- <link href="{{ asset('admin/assets/plugins/calendar/dist/fullcalendar.css') }}" rel="stylesheet" /> -->
    <!-- ============================================================== -->
    
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="tb-cell">
            <div id="page-loading">
                <div></div>
                <p>@lang('site.loading')</p>
            </div>
        </div>
    </div>

    @yield('content')



    <!-- Footer -->
        @include('footer')
    <!-- End Footer -->

    <!-- Library JS -->
    <script type="text/javascript" src="{{ asset('js/library/jquery-1.11.0.min.js') }}"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="{{ asset('js/library/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/library/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/library/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/library/parallax.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/library/jquery.nicescroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/library/jquery.ui.touch-punch.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/library/jquery.mb.YTPlayer.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/library/SmoothScroll.js') }}"></script>
    <!-- End Library JS -->

    
    <script type="text/javascript" src="{{ asset('js/library/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/library/jquery.validate.min.js') }}"></script>


    <!-- Main Js -->
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <!-- End Main Js -->


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        function swap(name){

            $.ajax({
                url: "/swap",
                method: 'POST',
                type: 'POST',
                data: {
                    name: name
                }
            }).fail(function (data) {
                
                var response = JSON.parse(data.responseText);
                console.log('response = ' + response.message);
                var errorString = '<ul>';
                if(response.message){
                    errorString += '<li>' + response.message + '</li>';
                }
                $.each(response.errors, function (key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';

                $('.alert-error').html(errorString);
                $('.alert-error').removeClass('hide');

                setTimeout(function () {
                    $('.alert-error').html();
                    $('.alert-error').addClass('hide');
                }, 10000);

            }).done(function (result) {

                    $('.alert-success h6').html(result);
                    $('.alert-success').removeClass('hide');
                    $('.subscribe-form').addClass('hide');

                    setTimeout(function () {
                        $('.alert-success h6').html();
                        $('.alert-success').addClass('hide');
                        $('.subscribe-form').removeClass('hide');
                    }, 10000);
                    
               
            });
        };

    </script>



    @yield('js-extra')

</body>
</html>
