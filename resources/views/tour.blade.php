@extends('layouts.layout')

@section('css-extra')

    <link rel="stylesheet"  href="{{ asset('public/css/library/fullcalendar.css') }}"/>

@endsection

@section('content')
    
    <!-- Wrap -->
    <div id="wrap">

        <!-- Header -->
        <header id="header" class="header">
            <div class="container">
                <!-- Logo -->
                <div class="logo float-left">
                    <a href="{{ route('main') }}" title=""><img src="{{ asset('public/images/logo-header.png') }}" alt=""></a>
                </div>
                <!-- End Logo -->
                <!-- Bars -->
                <div class="bars" id="bars"></div>
                <!-- End Bars -->

                <!--Navigation-->
                    @include('menu')
                <!--End Navigation-->
                
            </div>
        </header>
        <!-- End Header -->
    
        <!--Banner-->
        <section class="sub-banner">
            <!--Background-->
            <div class="bg-parallax bg-1"></div>
            <!--End Background-->
            <!-- Logo -->
            <div class="logo-banner text-center">
                <a href="" title="">
                    <img src="{{ asset('public/images/logo-banner.png') }}" alt="">
                </a>
            </div>
            <!-- End Logo -->
        </section>
        <!--End Banner-->

        <!-- Main -->
        <div class="main main-dt">
            <div class="container">
                <div class="main-cn bg-white clearfix">

                    <!-- Breakcrumb -->
                    <section class="breakcrumb-sc">
                        <ul class="breadcrumb arrow">
                            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                            <li><a href="{{ route('tours.index',  ['cat_tour' => 'hunting']) }}" title="">{{ $specie_name }}</a></li>
                            <li>{{ $tour->title }}</li>
                        </ul>
                        <div class="support float-right">
                            <small>nomer</small> 123-123-1234
                        </div>
                    </section>
                    <!-- End Breakcrumb -->

                    <!-- Header Detail -->
                    <section class="head-detail">
                        <div class="head-dt-cn">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h1>{{ $tour->title }}</h1>
                                    <div class="start-address">
                                        <span class="star">
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                            <i class="glyphicon glyphicon-star"></i>
                                        </span>
                                        <address class="address">
                                            {{ $tour->region->name }}, {{ $tour->region->country->name }}
                                        </address>

                                    </div>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <p class="price-book">
                                        @lang('tour.from')-<span>${{ $tour->price }}</span>/@lang('tour.night')
                                        <a href="" title="" class="awe-btn awe-btn-1 awe-btn-lager">@lang('tour.book_now')</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Header Detail -->

                    <!-- Detail Slide -->
                    <section class="detail-slider">
                        <!-- Lager Image -->
                        <div class="slide-room-lg">
                            <div id="slide-room-lg">
                                
                                <img src="{{ asset('public/images/tour') }}/{{ $tour->image }}" alt="">

                               <img src="{{ asset('public/images/tour/img_2.jpg') }}" alt="">
                                <img src="{{ asset('public/images/tour/img_3.jpg') }}" alt="">
                                <img src="{{ asset('public/images/tour/img_4.jpg') }}" alt="">
                                <img src="{{ asset('public/images/tour/img_5.jpg') }}" alt="">
                            </div>
                        </div>
                        <!-- End Lager Image -->
                        <!-- Thumnail Image -->
                        <div class="slide-room-sm">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div id="slide-room-sm">

                                        <img src="{{ asset('public/images/tour') }}/{{ $tour->image }}" alt="">

                                        <img src="{{ asset('public/images/tour/img_2.jpg') }}" alt="">
                                        <img src="{{ asset('public/images/tour/img_3.jpg') }}" alt="">
                                        <img src="{{ asset('public/images/tour/img_4.jpg') }}" alt="">
                                        <img src="{{ asset('public/images/tour/img_5.jpg') }}" alt="">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Thumnail Image -->
                    </section>
                    <!-- End Detail Slide -->

                    <!-- Hotel Content One -->
                    <section class="hotel-content detail-cn" id="hotel-content">
                        <div class="row">                        
                            <div class="col-lg-3 detail-sidebar">
                                <!-- Hight Light -->
                                <div class="hight-light">

                                    <h2>Фантастично</h2>
                                    <!-- Vote Text -->
                                    <div class="row">
                                        <!-- Recommend -->
                                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-6 vote-text">
                                            <p><span>95</span>%</p>
                                            <small>Рекомендують</small>
                                            <a href="" title="">Читайте 36 відгуків</a>

                                        </div>
                                        <!-- End Recommend -->
                                        <!-- Tripadvitsor -->
                                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-6  vote-text">
                                            <img src="{{ asset('public/images/site/deer-silhouette.png') }}" alt="">
                                            <small>Вже побувало</small>
                                            <a href="" title="">145 осіб</a>
                                        </div>
                                        <!-- End Tripadvitsor -->
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
                                            <hr class="hr">

                                            <!-- Quote -->
                                            <blockquote class="quote-sidebar">
                                                <p>
                                                Відмінне розташування, що знаходиться за готелем Ritz на Пікаділі. Гарне співвідношення ціни та якості. Люкс, який я забронював, був хорошим.<br>
                                                    <span><b>Daniel Brown</b> - Sweden,  28/3/2013</span>
                                                </p>
                                            </blockquote>
                                            <!-- End Quote -->
                                        </div>
                                    </div>
                                    <!-- End Vote Text -->

                                    

                                </div>
                                <!-- End Hight Light -->
                            </div>

                            <!-- Description -->
                            <div class="col-lg-9 hl-customer-like">

                                <h2>@lang('tour.why_like_this_hunting')</h2>

                                <!-- Custom link field -->
                                <div class="customer-like">
                                    <span class="cs-like-label">
                                        Відстань до айропорту
                                    </span>
                                    <ul>
                                        <li> London Heathrow Airport (17.0 Km)</li>
                                        <li>London City Airport (18.3 Km)</li>
                                    </ul>
                                </div>
                                <!-- End Custom link field -->

                                <!-- Custom link field -->
                                <div class="customer-like">
                                    <span class="cs-like-label">
                                        Відгуки клієнтів
                                    </span>
                                    <ul>
                                        <li>Зручно та чисто, привітний персонал, гарне співвідношення ціни та якості</li>
                                    </ul>
                                </div>
                                <!-- End Custom link field -->

                                <!-- Custom link field -->
                                <div class="customer-like">
                                    <span class="cs-like-label">
                                        Найпопулярніші пам'ятки в цьому районі
                                    </span>
                                    <ul>
                                        <li>Westfield London (0.9 Km / 11 min walk)</li>
                                        <li>Natural History Museum (2.6 Km)</li>
                                        <li>Victoria and Albert Museum (2.9 Km)</li>
                                        <li>Hyde Park (3.0 Km)</li>
                                    </ul>
                                </div>
                                <!-- End Custom link field -->

                            </div>
                            <!-- End Description -->
                        </div>

                    </section>
                    <!-- End Hotel Content One -->


                    <!-- Check Rates-->
                    <section class="check-rates detail-cn" id="check-rates">
                        <div class="row">
                            <div class="col-lg-3 detail-sidebar">
                                <!-- <div class="scroll-heading">
                                    <h2>Check Rates &amp; Availability</h2>
                                    <hr class="hr">
                                    <a href="#hl-features" title="">Features</a>
                                    <a href="#details-policies" title="">Details &amp; Policies</a>
                                    <a href="#about-area" title="">About Area</a>
                                    <a href="#review-detail" title="">Reviews</a>
                                </div> -->
                            </div>
                            <div class="col-lg-9 hl-features-cn">
                                <div class="featured-service">
                                    <h3>Послуги</h3>

                                    <ul class="service-list">
                                        @forelse($icons as $icon)
                                            <li class="unselected">
                                                <figure>
                                                    <div class="icon-service">
                                                        <img src="{{ asset('public/images/icon-service') }}/{{ $icon->icon }}" alt="">
                                                    </div>
                                                    <figcaption>{{ $icon->text }}</figcaption>
                                                </figure>
                                            </li>
                                        @empty

                                        @endforelse
                                        
                                    </ul>
                                </div>
                                <div class="featured-service">
                                    <h3>Мови</h3>
                                    <ul class="service-spoken">
                                        <li><img src="{{ asset('public/images/icon-check.png') }}" alt="">Arabic</li>
                                        <li><img src="{{ asset('public/images/icon-check.png') }}" alt="">French</li>
                                        <li><img src="{{ asset('public/images/icon-check.png') }}" alt="">Russian</li>
                                        <li><img src="{{ asset('public/images/icon-check.png') }}" alt="">English</li>
                                        <li><img src="{{ asset('public/images/icon-check.png') }}" alt="">Spanish</li>
                                    </ul>
                                </div>
                            


                                <div class="service-check-rate">
                                    <h2>Плата за базові послуги</h2>
                                    <div class="table-responsive">
                                        <table class="table tb-service-check-rate">
                                            @forelse($services as $service)
                                                @if($service->position == 1)
                                                    <tr>
                                                        <td>{{ $service->name }}
                                                            @if($service->addition)
                                                                ({{ $service->addition }})
                                                            @endif
                                                        </td>
                                                        <td class="text-center tabl-width">{{ $service->service_price ? $service->service_price['price'] : 0 }} грн</td>
                                                    </tr>
                                                @endif
                                            @empty

                                            @endforelse
                                        </table>
                                    </div>
                                </div>

                                
                            <div class="service-check-rate">                               
                                <div class="panel panel-default">

                                    <div class="panel-body">
                                        {!! $calendar->calendar() !!}
                                    </div>

                                </div>
                            </div>

                            <h3>Регестрація на тур</h3>

                            <div class="alert-box alert-success hide">
                                <h6>Success  message</h6>
                            </div>

                            <div class="alert-box alert-error hide">
                                <h6>Error  message</h6>
                            </div>
                            

                            <div class="form-contact">
                                <form id="contact-form" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $tour->id }}"  name="tour_id" id="tour_id">

                                    <div class="form-field">
                                        <label for="name">Ім'я <sup>*</sup></label>
                                        <input type="text" name="name" id="name" value="{{ old('name') ? old('name') : '' }}" class="field-input">
                                    </div>
                                    <div class="form-field">
                                        <label for="email">Email <sup>*</sup></label>
                                        <input type="text" name="email" id="email" value="{{ old('email') ? old('email') : '' }}" class="field-input">
                                    </div>
                                    <div class="form-field">
                                        <label for="phone">Номер телефону <sup>*</sup></label>
                                        <input type="text" name="phone" id="phone" value="{{ old('email') ? old('email') : '' }}" class="field-input">
                                    </div>
                                    <div class="form-field field-date">
                                        <input type="text" name="start_date" value="{{ old('start_date') ? old('start_date') : '' }}" class="field-input calendar-input" placeholder="Початкова дата*">
                                    </div>
                                    <div class="form-field field-date">
                                        <input type="text" name="end_date" value="{{ old('end_date') ? old('end_date') : '' }}" class="field-input calendar-input" placeholder="Кінцева дата*">
                                    </div>
                                    
                                    <div class="form-field form-field-area">
                                        <label for="message">Повідомлення </label>
                                        <textarea id="message" name="messag" cols="30" rows="10" value="{{ old('messag') ? old('messag') : '' }}" class="field-input"></textarea>
                                    </div>
                                    <div class="form-field text-center">
                                        <button type="button" id="submit_event" class="awe-btn awe-btn-2 arrow-right arrow-white awe-btn-lager">Надіслати</button>
                                    </div>
                                    
                                </form>
                            </div>


                            <!-- <button onclick="openForm()">Form</button>

                            <div class="form-popup" id="myForm">
                                <form action="/action_page.php" class="form-container">
                                    <h1>Login</h1>

                                    <label for="email"><b>Email</b></label>
                                    <input type="text" placeholder="Enter Email" name="email" required>

                                    <div class="col-md-12 m-b-20">
                                        <label class="col-form-label m-r-20">Languages</label>
                                        
                                        <select name="language_id"  >
                                            @forelse($languages as $language)
                                                <option {{ old('language_id') ? 'selected' : '' }} value="{{ $language->id }}" >{{ $language->name }}</option>
                                            @empty

                                            @endforelse
                                        </select> 
                                    </div>

                                    <div class="col-md-12 m-b-20">
                                        <label class="col-form-label m-r-20">Start Date</label>
                                        <input class="form-control" type="date" >
                                    </div>

                                    <div class="col-md-12 m-b-20">
                                        <label class="col-form-label m-r-20">End Date</label>
                                        <input class="form-control" type="date" >
                                    </div>



                                    <label for="psw"><b>Password</b></label>
                                    <input type="password" placeholder="Enter Password" name="psw" required>

                                    <button type="button" class="btn">Login</button>
                                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                                </form>
                            </div> -->

                


                                


                                <!-- <div class="hotel-detail-map">
                                    <div id="hotel-detail-map" data-latlng="51.5133647,-0.1907375"></div>
                                    <p class="about-area-location"><i class="fa  fa-map-marker"></i>42 Princes Square, London W2 4AD</p>
                                </div> -->

                                <div class="about-area-text">
                                    <h2>What to do</h2>
                                    <p>{{ $tour->text }}</p>
                                </div>




                                <!-- Review Tabs -->
                                <div class="review-tabs">
                                    <!-- Tabs Head -->
                                    <ul class="tabs-head nav-tabs-one">
                                        
                                        <li class="active">
                                            <a data-toggle="tab" href="#section1">What to do?</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#section2">Comments</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#section3">Хронологія</a>
                                        </li>
                                    </ul>
                                    <!-- Tabs Head -->
                                    <!-- Tabs Content -->
                                    <div class="tab-content">

                                        <div id="section1" class="tab-pane fade in active">
                                            <div class="review-tabs-cn">
                                                <div class="row">
                                                    <p>{{ $tour->text }}</p>
                                                </div>
                                            </div>
                                        </div>



                                        <div id="section2" class="tab-pane fade">
                                            <div class="review-all">
                                                <h4 class="review-h">
                                                    All reviews ({{ count($comments) }})
                                                </h4>
                                                <!-- Review Item -->
                                                @forelse($comments as $comment)
                                                    <div class="row review-item">
                                                        <div class="col-xs-3 review-number">
                                                            <ins>{{ $comment->rating }}</ins>
                                                            <span>{{ $comment->user->name }}</span>
                                                            <small>{{ $comment->country }}, {{ $comment->created_at }}</small>
                                                        </div>
                                                        <div class="col-xs-9 review-text">
                                                            <ul>
                                                                <li>
                                                                    <span class="icon fa fa-plus"></span>
                                                                    @if($comment->coms_comt_pluses_true)
                                                                        @if(count($comment->coms_comt_pluses_true) > 0)
                                                                            @foreach($comment->coms_comt_pluses_true as $key => $coms_comt_plus)
                                                                                @if(count($comment->coms_comt_pluses_true) == ($key + 1) )
                                                                                    {{ $coms_comt_plus->name }}
                                                                                @else 
                                                                                    {{ $coms_comt_plus->name }}, 
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            {{ $comment->coms_comt_pluses_true->name }}
                                                                        @endif
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    <span class="icon icon-minus fa fa-minus"></span>
                                                                    @if($comment->coms_comt_pluses_false)
                                                                        @if(count($comment->coms_comt_pluses_false) > 0)
                                                                            @foreach($comment->coms_comt_pluses_false as $key => $coms_comt_plus)
                                                                                @if(count($comment->coms_comt_pluses_false) == ($key + 1))
                                                                                    {{ $coms_comt_plus->name }}
                                                                                @else 
                                                                                    {{ $coms_comt_plus->name }},
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            {{ $comment->coms_comt_pluses_false->name }}
                                                                        @endif
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                            <p>
                                                            {{ $comment->text }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="row review-item">
                                                        <p>Не має коментарів!!!</p>
                                                    </div>
                                                @endforelse
                                                <!-- End Review Item -->
                                                
                                            </div>
                                        </div>



                                        <div id="section3" class="tab-pane fade">
                                            <div class="review-tabs-cn">
                                                <div class="row">
                                                    <p>Приїзд учасників та реєстрація в журналі дозвільних</p>
                                                    <p>Іструктаж з техніки безпеки та умов проведення туру</p>
                                                    <p>Переміщення на транспорті в до місця проведення туру</p>
                                                    <p>Прибуття на базу, підведення підсумків, фотосесія</p>
                                                    <p>Святкова вечеря</p>
                                                    
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <!-- Tabs Content -->
                                </div>
                                <!-- End Review Tabs -->
                                <!-- Review All -->
                                

                            </div>
                        </div>
                    </section>
                    <!-- End Check Rates -->

                </div>
            </div>
        </div>
        <!-- End Main -->

    </div>
    
@endsection

@section('js-extra')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('js/library/moment.js-2.9.0.js') }}"></script>
    <script src="{{ asset('js/library/fullcalendar.js') }}"></script>

    {!! $calendar->script() !!}

    <!-- <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script> -->

    <script>
        $('#submit_event').on('click', function (){

            $.ajax({
                url: "/api/event_reserve",
                method: 'POST',
                type: 'POST',
                data: {
                    tour_id: $("input[name='tour_id']").val(),
                    name: $("input[name='name']").val(),
                    email: $("input[name='email']").val(),
                    phone: $("input[name='phone']").val(),
                    start_date: $("input[name='start_date']").val(),
                    end_date: $("input[name='end_date']").val(),
                    message: $("#message").val()
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

                $('body, html').animate({scrollTop: '.alert'}, 1000);

            }).done(function (result) {
                console.log('result = ' + result);
                try{
                    $('.alert-success h6').html('Добавлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success h6').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    


                }catch{}
            });
        });
    </script>


@endsection