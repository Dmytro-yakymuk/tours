@extends('layouts.admin')

@section('css-extra')

    <!-- {{ asset('admin') }} -->
@endsection

@section('content')
    <div id="main-wrapper">

        @include('admin.header')

        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="profile-img"> <img src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user" /> </div>
                    <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe <span class="caret"></span></a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                            <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div> <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                    @include('admin.sidebar_navigation')
                <!-- End Sidebar navigation -->
            </div>
            <div class="sidebar-footer">
                <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
        </aside>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <ol class="breadcrumb m-l-20">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Admin</a></li>
                            <li class="breadcrumb-item active">Roles</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">

                               
                                <div class="hide alert alert-success"></div>

                                <div class="hide alert alert-danger"></div>
                           


                                <div class="table-responsive">
                                    <table class="table table-hover contact-list table-bordered" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>Ім'я</th>
                                                @foreach($roles as $role)
                                                    <th>
                                                        {{ $role->title }}
                                                        
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody id="specie_view">

                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                        @foreach($roles as $role)
                                                        <td>
                                                            <label class="custom-control custom-checkbox">
                                                                @if($user->hasRole($role->name))
                                                                    <input name="{{ $user->id }}" value="{{ $role->id }}" checked type="checkbox" class="custom-control-input public">
                                                                @else
                                                                    <input name="{{ $user->id }}" value="{{ $role->id }}" type="checkbox" class="custom-control-input public">
                                                                @endif
                                                                <span class="custom-control-indicator"></span>
                                                             </label>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer"> © 2017 Monster Admin by wrappixel.com </footer>
        </div> 
@endcontent

@section('js-extra')
    <!-- Checkbox -->
    <script src="{{ asset('admin/main/js/jasny-bootstrap.js') }}"></script>
    <!-- End Checkbox ====================================================== -->

    <script>
        
        $(".public").change(function(){
            var role = $(this).val();
            var user = $(this).attr('name');
            $.ajax({
                url: "/api/roles_users_public",
                method: 'POST',
                type: 'POST',
                data: { 
                    user: user,
                    role: role
                }
            }).done(function (result) {
                try{
                    if(result == 'save'){

                        $('.alert-success').html('Опубліковано!!!');
                        $('.alert-success').removeClass('hide');

                        setTimeout(function () {
                            $('.alert-success').html();
                            $('.alert-success').addClass('hide');
                        }, 2000);
                    } else {
                        $('.alert-success').html('Не опубліковано!!!');
                        $('.alert-success').removeClass('hide');

                        setTimeout(function () {
                            $('.alert-success').html();
                            $('.alert-success').addClass('hide');
                        }, 2000);
                    }
                }catch{}
            });
        });
        
    </script>
    <!-- {{ asset('admin') }}  -->
@endsection