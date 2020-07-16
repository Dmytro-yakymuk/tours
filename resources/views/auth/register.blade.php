@extends('layouts.layout')

@section('content')


    <!-- Wrap -->
    <div id="wrap">

        <!-- Header -->
        <header id="header" class="header">
            <div class="container">
                <!-- Logo -->
                <div class="logo float-left">
                    <a href="index.html" title=""><img src="{{ asset('images/logo-header.png') }}" alt=""></a>
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
                    <img src="images/logo-banner.png" alt="">
                </a>
            </div>
            <!-- End Logo -->
        </section>
        <!--End Banner-->

        <!-- Main -->
        <div class="main">
            <div class="container">
                <div class="main-cn element-page bg-white clearfix">
                    <!--Breakcrumb-->
                    <section class="breakcrumb-sc">
                        <ul class="breadcrumb arrow">
                            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li>User Reviews</li>
                        </ul>
                        <div class="support float-right">
                            <small>Got a question?</small> 123-123-1234
                        </div>
                    </section>
                    <!--End Breakcrumb-->
                    
                    <section class="user-profile">
                        <div class="user-form user-signup">
                            <div class="row">
                                
                                <div class="col-md-6 col-md-offset-3">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <h2 class="user-profile__title">Sign up</h2>
                                        <p>Sign up now and receive exclusive offers with huge discounts </p>

                                        <div class="field-input">
                                            <input id="name" type="text" class="input-text{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="{{ old('name') ? old('name') : 'Name' }}" required autofocus>
                                            
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                        <!-- <div class="field-input">
                                            <input type="text" class="input-text" value="Last name *">
                                        </div> -->


                                        <div class="field-input">
                                            <input id="email" type="email" class="input-text{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ old('email') ? old('email') : 'Email' }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="field-input">
                                            <input id="password" type="password" class="input-text{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="field-input">
                                             <input id="password-confirm" type="password" class="input-text" name="password_confirmation" placeholder="Password Confirmation" required>
                                        </div>

                                        <div class="field-input">
                                            <div class="check-box">
                                                <input type="checkbox" id="offers">
                                                <label for="offers"> Send me Special Offers &amp; Promotions</label>
                                            </div>
                                        </div>

                                        <div class="field-input">
                                            <button type="submit" class="awe-btn awe-btn-1 awe-btn-medium">Sign up</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- End Main -->
    </div>
    
    

@endsection
