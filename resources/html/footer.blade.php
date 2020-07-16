    <footer>
        <div class="container">
            <div class="row">
                <!-- Logo -->
                <div class="col-md-4">
                    <div class="logo-foter">
                        <a href="index.html" title=""><img src="images/logo-footer.png" alt=""></a>
                    </div>
                </div>
                <!-- End Logo -->
                <!-- Navigation Footer -->
                <div class="col-xs-6 col-sm-3 col-md-2">
                    <div class="ul-ft">
                        <ul>
                            
                        </ul>
                    </div>
                </div>
                <!-- End Navigation Footer -->
                <!-- Navigation Footer -->
                <div class="col-xs-6 col-sm-3 col-md-2">
                    <div class="ul-ft">
                        <ul>
                            <li><a href="{{ route('contacts.index') }}" title="">@lang('index.contact_us')</a></li>
                            
                        </ul>
                    </div>
                </div>
                <!-- End Navigation Footer -->
                <!-- Footer Currency, Language -->
                <div class="col-sm-6 col-md-4">
                    <!-- Language -->

                    <div class="currency-lang-bottom dropdown-cn float-left">
                        <div class="dropdown-head">
                            <span class="angle-down"><i class="fa fa-angle-down"></i></span>
                        </div>
                        <div class="dropdown-body">
                            <ul>
                                @forelse($languages as $language)
                                    <li class="{{ session('language') == $language->locale ? 'current' : '' }}" ><a href="{{ route('setlocale', ['lang' => $language->locale ]) }}">{{ $language->name }}</a></li>
                                @empty

                                @endforelse 

                            </ul>
                        </div>
                    </div>
                   
                    <!-- End Language -->
                    <!-- Currency -->
                    <div class="currency-lang-bottom dropdown-cn float-left">
                        <div class="dropdown-head">
                            <span class="angle-down"><i class="fa fa-angle-down"></i></span>
                        </div>
                        <div class="dropdown-body">
                            <ul>
                                <li class="current"><a href="#" title="">US</a></li>

                                @forelse($currencies as $currency)
                                    <li><a onclick="swap({{ $currency->name }})">{{ $currency->name }}</a></li>
                                @empty

                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!-- End Currency -->
                    <!--CopyRight-->
                    <p class="copyright">
                        © 2009 – 2014 Bookyourtrip™ All rights reserved.
                    </p>
                    <!--CopyRight-->
                </div>
                <!-- End Footer Currency, Language -->
            </div>
        </div>
    </footer>