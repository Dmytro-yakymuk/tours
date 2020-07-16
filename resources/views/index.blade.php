@extends('layouts.layout')

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
        <section class="banner">

            <!--Background-->
            <div class="bg-parallax bg-1"></div>
            <!--End Background-->

            <div class="container">

                <div class="logo-banner text-center">
                    <a href="{{ route('main') }}" title="">
                        <img src="{{ asset('public/images/logo-banner.png') }}" alt="">
                    </a>
                </div>

                <!-- Banner Content -->
                <div class="banner-cn">

                    <!-- Tabs Cat Form -->
                    <ul class="tabs-cat text-center row">
                        <li class="cate-item col-xs-4">
                            <a data-toggle="tab" href="#form-flight" title="">
                                <span>@lang('menu.diving')</span>
                                <img src="{{ asset('public/images/index-menu-icon/icons8-scuba-diving-60.png') }}" alt="">
                            </a>
                        </li>
                        <li class="cate-item active col-xs-4">
                            <a data-toggle="tab" href="#form-fishing" title="">
                                <span>@lang('menu.fishing')</span> 
                                <img src="{{ asset('public/images/index-menu-icon/fishing-rod.png') }}" alt="">
                            </a>
                        </li>
                        <li class="cate-item col-xs-4">
                            <a data-toggle="tab" href="#form-fishing" title="">
                                <span>@lang('menu.tourism')</span>
                                <img src="{{ asset('public/images/index-menu-icon/camping-tent.png') }}" alt=""> 
                            </a>
                        </li>

                    </ul>
                    <!-- End Tabs Cat -->

                    <!-- Tabs Content -->
                    <div class="tab-content">


                        <!-- Search Hotel -->
                        <div class="form-cn form-hotel tab-pane active in" id="form-fishing">
                            <h2>@lang('search.would_go')</h2>
                            <div class="form-search clearfix">
                                <div class="form-field field-destination">
                                    <label for="destination"><span>@lang('search.destination'):</span> Country, City, Airport, Area, Landmark</label>
                                    <input type="text" id="destination" class="field-input">
                                </div>
                                <div class="form-field field-date">
                                    <input type="text" class="field-input calendar-input" placeholder="@lang('search.start')">
                                </div>
                                <div class="form-field field-date">
                                    <input type="text" class="field-input calendar-input" placeholder="@lang('search.finish')">
                                </div>
                                
                                <div class="form-submit">
                                    <button type="submit" class="awe-btn awe-btn-lager awe-search">@lang('search.search')</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Search Hotel -->

                        
                    </div>
                    <!-- End Tabs Content -->

                </div>
                <!-- End Banner Content -->

            </div>

        </section>
        <!--End Banner-->

        <!-- Sales -->
        <section class="sales">
            <!-- Title -->
            <div class="title-wrap">
                <div class="container">
                    <div class="travel-title float-left">
                        <h2>@lang('index.hot_sale'): 
                            <span>
                                @forelse($countries_top as $country)
                                    {{ $country->name }}
                                @empty
                                @endforelse
                                
                                & @lang('index.more')</span>
                        </h2>
                    </div>
                    <a href="{{ route('tours.index',  ['cat_tour' => 'diving']) }}" title="" class="awe-btn awe-btn-5 awe-btn-lager arrow-right text-uppercase float-right">@lang('index.all_sales')</a>
                </div>
            </div>
            <!-- End Title -->
            <!-- Hot Sales Content -->
            <div class="container">
                <div class="sales-cn">
                    <div class="row">

                        <!-- HostSales Item -->
                        @forelse($tours as $tour)
                            <!-- <div class="col-md-6"> -->
                            <div class="col-xs-6 col-md-4">
                                <div class="sales-item">
                                    <figure class="home-sales-img">
                                        <a href="{{ route('tours.show', ['cat_tour' => 'diving','slug' => $tour->slug ]) }}" title="">
                                            <img src="{{ asset('public/images/tour') }}/{{ $tour->image }}" alt="">
                                        </a>
                                        <figcaption>
                                            @lang('index.save') <span>{{ $tour->discount }}</span>%
                                        </figcaption>
                                    </figure>
                                    <div class="home-sales-text">
                                        <div class="home-sales-name-places">
                                            <div class="home-sales-name">
                                                <a href="{{ route('tours.show', ['cat_tour' => 'diving', 'slug' => $tour->slug ]) }}" title="">{{ $tour->title }}</a>
                                            </div>
                                            <div class="home-sales-places">
                                                <a href="" title="">{{ $tour->region->country->name }}</a>,
                                                <a href="" title="">{{ $tour->region->name }}</a>
                                            </div>
                                        </div>
                                        <p>
                                            {{ $tour->description }}...</a>
                                        </p>
                                        <div class="price-box">
                                            <span class="price old-price">Ціна для 1 особи</del></span>
                                            <span class="price special-price">${{ $tour->price }}<small>/день</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-xs-6 col-md-3">
                                <p>Турів не знайдено!</p>
                            </div>
                        @endforelse
                        <!-- End HostSales Item -->
                        
                    </div>
                </div>
            </div>
            <!-- End Hot Sales Content -->
        </section>
        <!-- End Sales -->

        <!-- Travel Destinations -->
        <section class="destinations">

            <!-- Title -->
            <div class="title-wrap">
                <div class="container">
                    <div class="travel-title float-left">
                        <h2>@lang('index.top_travel')</h2>
                    </div>
                </div>
            </div>
            <!-- End Title -->

            <!-- Destinations Content -->
            <div class="destinations-cn">

                <!-- Background -->
                <div class="bg-parallax bg-1"></div>
                <!-- End Background -->

                <div class="container">
                    <div class="row">
                        <!-- Destinations Filter -->
                        <div class="col-md-4 col-lg-3">
                            <div class="intro-filter">
                                <div class="intro">
                                    <p>
                                        <small>@lang('index.discover')</small><br>
                                        <span>{{ count($regions) }}</span> @lang('index.destinations')
                                    </p>
                                    <p>
                                        <small>@lang('index.with')</small><br>
                                        <span>{{ $tours_count }}</span> @lang('index.properties')
                                    </p>
                                </div>
                                <ul class="filter">
                                    <li class="active">
                                        <a>
                                            <i class="fa fa-map-marker"></i> 
                                            @lang('index.recommendation')
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- End Destinations Filter -->
                        <!-- Destinations Grid -->
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content destinations-grid">
                                <!-- Tab One -->
                                <div id="destinations-1" class="clearfix tab-pane fade active in ">

                                    <!-- Destinations Item -->
                                    @forelse($regions as $region)
                                        <div class="col-xs-6 col-sm-4 col-md-6 col-lg-4">
                                            <div class="destinations-item ">
                                                <div class="destinations-text">
                                                    <div class="destinations-name">
                                                        <a href="" title="">{{ $region->name }} - {{ $region->country->name }}</a>
                                                    </div>
                                                    <span class="properties-nb">
                                                        <ins>{{ count($region->tours) }}</ins> @lang('index.properties')
                                                    </span>
                                                </div>
                                                <figure class="destinations-img">
                                                    <a href="" title="">
                                                        <img src="{{ asset('public/images/destinations') }}/{{ $region->image }}" alt="">
                                                    </a>
                                                </figure>
                                            </div>
                                        </div>
                                    @empty

                                    @endforelse
                                    <!-- End Destinations Item -->

                                </div>
                                <!-- End Tab One -->
                                
                            </div>
                        </div>
                        <!-- ENd Destinations Grid -->
                    </div>
                </div>
            </div>
            <!-- End Destinations Content -->
        </section>
        <!-- End Travel Destinations -->

  
    </div>
    
@endsection

@section('js-extra')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $('#email_button').on('click', function (){

            $.ajax({
                url: "/api/email_subscription",
                method: 'POST',
                type: 'POST',
                data: {
                    email: $("input[name='email']").val()
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
        });

    </script>
@endsection

