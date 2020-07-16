@extends('layouts.admin')

@section('css-extra')

    <!-- page CSS ============================================================== -->
    <link href="{{ asset('admin/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- ============================================================== -->

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
                            <li class="breadcrumb-item active">Species</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">

                               
                                <div class="hide alert alert-success"></div>

                                <div class="hide alert alert-danger"></div>
                           

                                @can('view', $species_view)
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
                                                <th>Public</th>
                                                <th>Language</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="specie_view">

                                            @forelse($species_view as $key => $specie)
                                                <tr>
                                                    <td>{{ ($key+1) }}</td>
                                                    <td>
                                                        <a>{{ $specie->name }}</a>
                                                    </td>
                                                    <td>
                                                        <a>{{ $specie->slug }}</a>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" value="{{ $specie->id }}" id="public" {{ $specie->public ? 'checked' : '' }}  class="js-switch" data-color="#009efb">
                                                    </td>
                                                    <td>
                                                        <a>{{ $specie->language->name }}</a>
                                                    </td>
                                                    
                                                    <td class="text-nowrap">

                                                        <a  data-toggle="modal" data-target="#update-contact{{ ($key+1) }}" data-original-title="Edit"> 
                                                            <i class="fa fa-pencil text-inverse m-r-10 m-l-10"></i>
                                                        </a>
                                                        
                                                        <a data-toggle="tooltip" data-original-title="Delete">
                                                            <form method="POST">
                                                                @csrf
                                                                <button class='btn btn-french-5 m-t-5'value="{{ $specie->id }}" id="specie_delete" type="button"><i class="fa fa-close text-danger"></i></button>
                                                            </form>
                                                        </a>
                                                    </td>
                                                
                                                        
                                                    <div id="update-contact{{ ($key+1) }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Update Species</h4> </div>
                                                                <div class="modal-body">

                                                                    @can('update', $specie)
                                                                        <p style="color: green">Є права на редагування!!!</p> 
                                                                    @else
                                                                        <p style="color: red">Немає прав на редагування!!!</p>
                                                                    @endcan
                                                                    
                                                                    <form class="form-horizontal form-material" method="POST">
                                                                        @csrf
                                                                        
                                                                        <div class="form-group">
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $specie->name }}" name="name_up{{ $specie->id }}" placeholder="Name"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $specie->slug }}" name="slug_up{{ $specie->id }}" placeholder="Slug"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Public</label>
                                                                                <input name="public_up{{ $specie->id }}" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $specie->public ? 'checked' : '' }}>
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Languages</label>
                                                                                
                                                                                <select class="selectpicker" name="language_id_up{{ $specie->id }}"  data-style="form-control btn-secondary">
                                                                                    @forelse($languages as $language)
                                                                                        <option  value="{{ $language->id }}" {{ $specie->language_id == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                                                                                    @empty

                                                                                    @endforelse
                                                                                </select> 
                                                                            </div>  
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" onclick="updateSpecie({{ $specie->id }})" id="specie_update" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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
                                                    <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact">Add New Species</button>
                                                </td>
                                                <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="myModalLabel">Add New Species</h4> </div>
                                                            <div class="modal-body">

                                                                @can('create', $specie)
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
                                                                            <label class="col-form-label m-r-20">Public</label>
                                                                            <input name="public" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $specie->public ? 'checked' : '' }}>
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
                                                                <button type="button" id="specie_submit" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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

    <!-- This page plugins ============================================================== -->
    <script src="{{ asset('admin/assets/plugins/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script>
    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });

        $('.selectpicker').selectpicker();
    });
    </script>
    <!-- ============================================================== -->


    <!-- Footable -->
    <script src="{{ asset('admin/assets/plugins/footable/js/footable.all.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/main/js/footable-init.js') }}"></script>
    <!-- ============================================================== -->


    <script>
    
        $('#specie_submit').on('click', function (){

            $.ajax({
                url: "/api/specie_store",
                method: 'POST',
                type: 'POST',
                data: { 
                    name: $("input[name='name']").val(),
                    slug: $("input[name='slug']").val(),
                    public: $("input[name='public']:checked").val(),
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
                    $('#specie_view').html(result);
                    $('.alert-success').html('Добавлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#specie_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#specie_view .selectpicker').selectpicker();

                    $('body, html').animate({scrollTop: '.alert'}, 1000);

                }catch{}
            });
        });


        function updateSpecie(id) {

            var specie = $("input[name='slug_up" + id + "']").val();
            $.ajax({
                url: "/api/specie_update/" + specie,
                method: 'POST',
                type: 'POST',
                data: { 
                    id: id,
                    name: $("input[name='name_up" + id + "']").val(),
                    slug: $("input[name='slug_up" + id + "']").val(),
                    public: $("input[name='public_up" + id + "']:checked").val(),
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

                    $('#specie_view').html(result);
                    $('.alert-success').html('Оновлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#specie_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#specie_view .selectpicker').selectpicker();

                    $('body, html').animate({scrollTop: '.alert'}, 1000);

                }catch{}
            });
        };


        $("input#public").change(function(){
            var id = $(this).val();
            $.ajax({
                url: "/api/specie_public",
                method: 'POST',
                type: 'POST',
                data: { 
                    id: id
                }
             }).done(function (result) {
                try{
                    
                    if(result == 'yes'){

                        $('.alert-success').html('Опубліковано!!!');
                        $('.alert-success').removeClass('hide');

                        setTimeout(function () {
                            $('.alert-success').html();
                            $('.alert-success').addClass('hide');
                        }, 2000);

                        $('body, html').animate({scrollTop: '.alert'}, 1000);

                    }else {
                        $('.alert-success').html('Не опубліковано!!!');
                        $('.alert-success').removeClass('hide');

                        setTimeout(function () {
                            $('.alert-success').html();
                            $('.alert-success').addClass('hide');
                        }, 2000);

                        $('body, html').animate({scrollTop: '.alert'}, 1000);
                    }
                }catch{}
            });
        });


        $('#specie_view').on('click', '#specie_delete', function (){

            var specie_id = $(this).val();
            $.ajax({
                url: "/api/specie_delete/" + specie_id,
                method: 'POST',
                type: 'POST'
            }).done(function (result) {
                try{
                    $('#specie_view').html(result);
                    $('.alert-success').html('Видалено!!!');
                    
                    $('.alert-success').removeClass('hide');
                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 5000);

                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#specie_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#specie_view .selectpicker').selectpicker(); 

                    $('body, html').animate({scrollTop: '.alert'}, 1000); 
                }catch{}
            });
        });

    </script>
        

    <!-- {{ asset('admin') }}  -->
@endsection