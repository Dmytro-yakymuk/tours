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
            <!-- Logo -->
        </section>
        <!--End Banner-->

        <!-- Main -->
        <div class="main">
            <div class="container">
                <!-- <div id="app" class="container"> -->
                <!-- <tours-component></tours-component> -->


                <div class="main-cn hotel-page bg-white clearfix">
                    <div class="row" id="view_render">
                        <!-- Hotel Right -->
                        <div class="col-md-9 col-md-push-3">
                            <!-- Breakcrumb -->
                            <section class="breakcrumb-sc">
                                <ul class="breadcrumb arrow">
                                    <li>
                                        <a href="{{ route('main') }}">
                                            <i class="fa fa-home"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a>{{ $specie_name ? $specie_name : "" }}</a>
                                    </li>
                                </ul>
                            </section>

                            <!-- End Breakcrumb -->
                            <!-- Hotel List -->
                            <section class="hotel-list">
                               
                                <!-- Hotel Grid Content-->
                                <div class="hotel-list-cn clearfix">
                                    <!-- Hotel Item -->
                                    @forelse($tours as $tour)
                                        <div class="hotel-list-item">
                                            <figure class="hotel-img float-left">
                                                <a href="{{ route('tours.show', ['cat_tour' => 'diving', 'slug' => $tour->slug ]) }}" title>
                                                    <img src="{{ asset('public/images/tour/'. $tour->image) }}" alt>
                                                </a>
                                            </figure>
                                            <div class="hotel-text">
                                                <div class="hotel-name">
                                                    <a href="{{ route('tours.show', ['cat_tour' => 'diving', 'slug' => $tour->slug ]) }}" title>{{ $tour->title }}</a>
                                                </div>

                                                <div class="hotel-star-address">
                                                    <span class="hotel-star">
                                                        <i class="glyphicon glyphicon-star"></i>
                                                        <i class="glyphicon glyphicon-star"></i>
                                                        <i class="glyphicon glyphicon-star"></i>
                                                        <i class="glyphicon glyphicon-star"></i>
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    </span>
                                                    <!-- <span class="rating">
                                                         <span>{{ $tour->rating }}</span>
                                                    </span>-->
                                                    <address class="hotel-address">{{ $tour->region->name }}, {{ $tour->country->name }}</address>
                                                </div>

                                                <p>
                                                    {{ $tour->description }}...
                                                    
                                                </p>
                                                

                                                <div class="price-box float-left">
                                                    <span class="price old-price"></span>
                                                    <span class="price special-price">
                                                        ${{ $tour->price }}
                                                        <small>/день</small>
                                                    </span>
                                                </div>
                                                <div class="hotel-service float-right">
                                                    <img src="{{ asset('public/images/icon-service/icon-service-1.png') }}" alt>
                                                    <img src="{{ asset('public/images/icon-service/icon-service-2.png') }}" alt>                 
                                                    <img src="{{ asset('public/images/icon-service/icon-service-3.png') }}" alt>                                                    
                                                    <img src="{{ asset('public/images/icon-service/icon-service-4.png') }}" alt>                                                    
                                                    <img src="{{ asset('public/images/icon-service/icon-service-5.png') }}" alt>                                                    
                                                    <img src="{{ asset('public/images/icon-service/icon-service-6.png') }}" alt>                                                    
                                                    <img src="{{ asset('public/images/icon-service/icon-service-7.png') }}" alt>                                                </div>
                                            </div>
                                        </div>
                                    @empty

                                    @endforelse
                                    <!-- End Hotel Item -->
                                </div>
                                <!-- End Hotel Grid Content-->


                                <!-- Page Navigation -->
                                <div class="page-navigation-cn">
                                    <ul class="page-navigation">
                                        <!-- LastPage() - повертає номер останьої сторінки посторінкової пагінації  -->
                                        @if($tours->LastPage() > 1)
                                            <!--<li class="first"><a href="" title="">First</a></li>-->

                                            <!-- currentPage() - повертає номер цієї сторінки -->
                                            @if($tours->currentPage() !== 1)
                                                <li><a href="{{ $tours->url(($tours->currentPage() - 1)) }}"> << </a></li>
                                            @endif

                                            @for($i = 1; $i <= $tours->LastPage(); $i++)
                                                @if($tours->currentPage() == $i)
                                                    <li class="current"><a >{{ $i }}</a></li>
                                                @else
                                                    <li><a href="{{ $tours->url($i) }}">{{ $i }}</a></li>
                                                @endif
                                            @endfor


                                            @if($tours->currentPage() !== $tours->LastPage())
                                                <li><a href="{{ $tours->url(($tours->currentPage() + 1)) }}"> >> </a></li>
                                            @endif


                                            <!-- <li class="last"><a href="" title="">Last</a></li> -->
                                        @endif
                                    </ul>
                                </div>
                                <!-- Page Navigation -->
                           
                            </section>
                            <!-- End Hotel List -->
                        </div>
                        <!-- End Hotel Right -->


                        <!-- Sidebar Hotel -->
                        <div class="col-md-3 col-md-pull-9">
                            <!-- Sidebar Content -->
                            <div class="sidebar-cn">
                                <!-- Search Result -->
                                <div class="search-result">
                                    <p>
                                        @lang('tour.we_found')
                                        <br>
                                        <ins>{{ $tours_count }}</ins>
                                        <span>@lang('tour.wonderful_tours')</span>
                                    </p>
                                </div>
                                <!-- End Search Result -->
                                <!-- Hotel facilities -->
                                <div class="widget-sidebar facilities-sidebar">
                                    <h4 class="title-sidebar">Регіони</h4>
                                    <ul class="widget-ul">
                                        @foreach($regions as $region)
                                        <!-- class="bolt" -->
                                        <li>
                                            <a onclick="orderBy({{ $menu }}, 'region_id', {{ $region->id }})">{{ $region->name }}</a>
                                            <span>{{ $region->tour_count }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End Hotel facilities -->
                            </div>
                            <!-- End Sidebar Content -->
                        </div>
                        <!-- End Sidebar Hotel -->


                    </div>
                </div>

            </div>
        </div>
        <!-- End Main -->

    </div>
    
@endsection


@section('js-extra')
    <script>


        function orderBy(specie, order, id) {

            $.ajax({
                url: "/api/tours/" + specie,
                method: 'POST',
                type: 'POST',
                data: { 
                    order: order,
                    id: id
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

                console.log(errorString);
                
            }).done(function (result) {
                console.log('result = ' + result);
                
                $('#view_render').html(result);

            });
        };


    </script>
@endsection