@extends('layouts.admin')

@section('css-extra')

    <!-- Footable CSS -->
    <link href="{{ asset('admin/assets/plugins/footable/css/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <!-- ============================================================== -->

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
                           

                                @can('view', $role_permissions)
                                    <p style="color: green">Є права на перегляд!!!</p> 
                                @else
                                    <p style="color: red">Немає прав на перегляд!!!</p>
                                @endcan


                                <div class="table-responsive">
                                    <table id="demo-foo-addrow" class="table table-hover contact-list" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Language</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="country_view">

                                            @forelse($countries as $key => $country)
                                                <tr>
                                                    <td>{{ ($key+1) }}</td>
                                                    <td>
                                                        <a>{{ $country->name }}</a>
                                                    </td>
                                                    <td>
                                                        <a>{{ $country->slug }}</a>
                                                    </td>
                                                    <td>
                                                        <a>{{ $country->language->name }}</a>
                                                    </td>

                                                    
                                                    <td class="text-nowrap">

                                                        <a data-toggle="modal" data-target="#edit-country{{ ($key+1) }}" data-original-title="Edit"> 
                                                            <i class="fa fa-pencil text-inverse m-r-10 m-l-10"></i>
                                                        </a>
                                                        
                                                        <a data-toggle="tooltip" data-original-title="Delete">
                                                            <form method="POST">
                                                                @csrf
                                                                <button class='btn btn-french-5 m-t-5'value="{{ $country->id }}" id="country_delete" type="button">
                                                                    <i class="fa fa-close text-danger"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </td>
                                                
                                                        
                                                    <div id="edit-country{{ ($key+1) }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Update country</h4> </div>
                                                                <div class="modal-body">

                                                                    @can('update', $country)
                                                                        <p style="color: green">Є права на редагування!!!</p> 
                                                                    @else
                                                                        <p style="color: red">Немає прав на редагування!!!</p>
                                                                    @endcan
                                                                    
                                                                    <form class="form-horizontal form-material" method="POST">
                                                                        @csrf
                                                                        
                                                                        <div class="form-group">
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $country->name }}" name="name_up{{ $country->id }}" placeholder="Name"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $country->slug }}" name="slug_up{{ $country->id }}" placeholder="Slug"> 
                                                                            </div>

                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Languages</label>
                                                                                
                                                                                <select class="selectpicker" name="language_id_up{{ $country->id }}"  data-style="form-control btn-secondary">
                                                                                    @forelse($languages as $language)
                                                                                        <option  value="{{ $language->id }}" {{ $country->language_id == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                                                                                    @empty

                                                                                    @endforelse
                                                                                </select> 
                                                                            </div>

                                                                            
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" onclick="update_country({{ $country->id }})" id="country_update" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </tr>
                                            @empty

                                            @endforelse
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-country">Add New Country</button>
                                                </td>
                                                <div id="add-country" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="myModalLabel">Add New Country</h4> </div>
                                                            <div class="modal-body">

                                                                @can('create', $country)
                                                                    <p style="color: green">Є права на додавання!!!</p> 
                                                                @else
                                                                    <p style="color: red">Немає прав на додавання!!!</p>
                                                                @endcan

                                                                <form class="form-horizontal form-material" method="POST">
                                                                    @csrf
                                                                    
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 m-b-20">
                                                                            <input type="text" class="form-control" name="name" placeholder="Name"> 
                                                                        </div>
                                                                        <div class="col-md-12 m-b-20">
                                                                            <input type="text" class="form-control" name="slug" placeholder="Slug"> 
                                                                        </div>

                                                                        <div class="col-md-12 m-b-20">
                                                                            <label class="col-form-label m-r-20">Languages</label>
                                                                            
                                                                            <select class="selectpicker" name="language_id"  data-style="form-control btn-secondary">
                                                                                @forelse($languages as $language)
                                                                                    <option {{ old('language_id') ? 'selected' : '' }} value="{{ $language->id }}" >{{ $language->name }}</option>
                                                                                @empty

                                                                                @endforelse
                                                                            </select> 
                                                                        </div>  

                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" id="country_submit" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <td colspan="7">
                                                    <div class="text-right">
                                                        <ul class="pagination"> </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
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

    <!-- Footable -->
    <script src="{{ asset('admin/assets/plugins/footable/js/footable.all.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/main/js/footable-init.js') }}"></script>
    <!-- ============================================================== -->


    <script>

    $('#country_submit').on('click', function (){

            $.ajax({
                url: "/api/country_store",
                method: 'POST',
                type: 'POST',
                data: { 
                    name: $("input[name='name']").val(),
                    slug: $("input[name='slug']").val(),
                    language_id: $("select[name='language_id']").val()
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

                $('.alert-danger').html(errorString);
                $('.alert-danger').removeClass('hide');

                setTimeout(function () {
                    $('.alert-danger').html();
                    $('.alert-danger').addClass('hide');
                }, 10000);

                $('body, html').animate({scrollTop: '.alert'}, 1000);

            }).done(function (result) {
                console.log('result = ' + result);
                try{
                    $('#country_view').html(result);
                    $('.alert-success').html('Добавлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#country_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#country_view .selectpicker').selectpicker();

                    $('body, html').animate({scrollTop: '.alert'}, 1000);

                }catch{}
            });
        });

        function update_country(id) {

            $.ajax({
                url: "/api/country_update/" + id,
                method: 'POST',
                type: 'POST',
                data: { 
                    name: $("input[name='name_up" + id + "']").val(),
                    emaslugil: $("input[name='slug_up" + id + "']").val(),
                    language_id: $("select[name='language_id_up" + id + "']").val()
                }
            }).fail(function (data) {
                var response = JSON.parse(data.responseText);
                var errorString = '<ul>';
                $.each(response.errors, function (key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';

                $('.alert-danger').html(errorString);
                $('.alert-danger').removeClass('hide');

                setTimeout(function () {
                    $('.alert-danger').html();
                    $('.alert-danger').addClass('hide');
                }, 10000);

                $('body, html').animate({scrollTop: '.alert'}, 1000);

            }).done(function (result) {

                try{

                    $('#country_view').html(result);
                    $('.alert-success').html('Оновлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#country_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#country_view .selectpicker').selectpicker();

                    $('body, html').animate({scrollTop: '.alert'}, 1000);

                }catch{}
            });
        };



        $('#country_view').on('click', '#country_delete', function (){

            var country_id = $(this).val();
            $.ajax({
                url: "/api/country_delete/" + country_id,
                method: 'POST',
                type: 'POST'
            }).done(function (result) {
                try{
                    $('#country_view').html(result);
                    $('.alert-success').html('Видалено!!!');
                    
                    $('.alert-success').removeClass('hide');
                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 5000);

                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#country_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#country_view .selectpicker').selectpicker(); 

                    $('body, html').animate({scrollTop: '.alert'}, 1000); 
                }catch{}
            });
        });

    </script>
        

    <!-- {{ asset('admin') }}  -->
@endsection