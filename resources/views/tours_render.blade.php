    
    
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
            <!-- Sort by and View by -->
            <div class="sort-view clearfix">
                <!-- Sort by -->
                <div class="sort-by float-left">
                    <label>Sort by:</label>

                    <div class="view-by-sort float-right">
                        <ul>
                        <!-- <li v-on:click="resortCafes('title')" class="float-left">
                            <span>Title</span>
                            <img
                                src="/images/sort/up-arrow.png"
                                v-show="sortBy == 'title' && sortDirection == 'ASC'"
                            >
                            <img
                                src="/images/sort/down-arrow.png"
                                v-show="sortBy == 'title' && sortDirection == 'DESC'"
                            >
                        </li> -->

                        <!-- <li v-on:click="resortCafes('price')" class="float-left view-by-sort-border">
                            <span>Price</span>
                            <img
                            src="/images/sort/up-arrow.png"
                            v-show="sortBy == 'price' && sortDirection == 'ASC'"
                            >
                            <img
                            src="/images/sort/down-arrow.png"
                            v-show="sortBy == 'price' && sortDirection == 'DESC'"
                            >
                        </li> -->
                        </ul>
                    </div>
                </div>
                <!-- End Sort by -->
                <!-- View by -->
                <div class="view-by float-right">
                    <ul>
                        <li>
                            <a href="hotel-list.html" title>
                                <img src="/images/icon-grid.png" alt>
                            </a>
                        </li>
                        <li>
                            <a href="hotel-list-2.html" title class="current">
                                <img src="/images/icon-list.png" alt>
                            </a>
                        </li>
                        <li>
                            <a href="hotel-maps.html" title>
                                <img src="/images/icon-map.png" alt>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- View by -->
            </div>
            <!-- End Sort by and View by -->
            <!-- Hotel Grid Content-->
            <div class="hotel-list-cn clearfix">
                <!-- Hotel Item -->
                @forelse($tours as $tour)
                    <div class="hotel-list-item">
                        <figure class="hotel-img float-left">
                            <a href="{{ route('tours.show', ['cat_tour' => 'hunting', 'slug' => $tour->slug ]) }}" title>
                                <img src="{{ asset('/images/hunting/'. $tour->image) }}" alt>
                            </a>
                        </figure>
                        <div class="hotel-text">
                            <div class="hotel-name">
                                <a href="{{ route('tours.show', ['cat_tour' => 'hunting', 'slug' => $tour->slug ]) }}" title>{{ $tour->title }}</a>
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
                                <a href title>view all 125 reviews</a>
                            </p>
                            <hr class="hr">

                            <div class="price-box float-left">
                                <span class="price old-price">From-</span>
                                <span class="price special-price">
                                    ${{ $tour->price }}
                                    <small>/night</small>
                                </span>
                            </div>
                            <div class="hotel-service float-right">
                                <a href title>
                                    <img src="/images/icon-service-1.png" alt>
                                </a>
                                <a href title>
                                    <img src="/images/icon-service-2.png" alt>
                                </a>
                                <a href title>
                                    <img src="/images/icon-service-3.png" alt>
                                </a>
                                <a href title>
                                    <img src="/images/icon-service-4.png" alt>
                                </a>
                                <a href title>
                                    <img src="/images/icon-service-5.png" alt>
                                </a>
                                <a href title>
                                    <img src="/images/icon-service-6.png" alt>
                                </a>
                                <a href title>
                                    <img src="/images/icon-service-7.png" alt>
                                </a>
                            </div>
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
                    we_found
                    <br>
                    <ins>{{ count($tours) }}</ins>
                    <span>properties_availability</span>
                </p>
            </div>
            <!-- End Search Result -->
            <!-- Hotel facilities -->
            <div class="widget-sidebar facilities-sidebar">
                <h4 class="title-sidebar">Hotel facilities</h4>
                <ul class="widget-ul">
                    @foreach($regions as $region)
                    <!-- class="bolt" -->
                    <li>
                        <a onclick="orderBy('region_id', {{ $region->id }})">{{ $region->name }}</a>
                        <span>{{ $region->tour_count }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- End Hotel facilities -->
            <!-- Area -->
            <div class="widget-sidebar area-sidebar">
                <h4 class="title-sidebar">Area</h4>
                <ul class="widget-ul">
                    @foreach($categories as $category)
                        <li>
                            <a onclick="orderBy('category_id', {{ $category->id }})">{{ $category->name }}</a>
                            <span>{{ $category->tour_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- End Area -->
        </div>
        <!-- End Sidebar Content -->
    </div>
    <!-- End Sidebar Hotel -->