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
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <h2 class="user-profile__title">Sign in</h2>
                                        <p>Access your account information and manage your bookings.</p>

                                        <div class="field-input">
                                            <input id="email" type="email" class="input-text{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ old('email') ? old('email') : 'Email'}}" required autofocus>

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
                                            <div class="check-box">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                            <!-- <a href="#">Get a new password</a> -->
                                        </div>


                                        <div class="field-input">
                                            <button type="submit" class="awe-btn awe-btn-1 awe-btn-medium">Sign in</button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
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
