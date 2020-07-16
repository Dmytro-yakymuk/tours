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
                            <li class="breadcrumb-item active">Icons</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">

                               
                                <div class="hide alert alert-success"></div>

                                <div class="hide alert alert-danger"></div>
                           

                                @can('view', $icons)
                                    <p style="color: green">Є права на перегляд!!!</p> 
                                @else
                                    <p style="color: red">Немає прав на перегляд!!!</p>
                                @endcan


                                <div class="table-responsive">
                                    <table id="demo-foo-addrow" class="table table-hover contact-list" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Icon</th>
                                                <th>Text</th>
                                                <th>Room</th>
                                                <th>Public</th>
                                                <th>Language</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="icon_view">

                                            @forelse($icons as $key => $icon)
                                                <tr>
                                                    <td>{{ ($key+1) }}</td>
                                                    <td>
                                                        <img src="{{ asset('images/'. $icon->icon) }}" width="20"/>
                                                    </td>
                                                    <td>
                                                        <a>{{ $icon->text }}</a>
                                                    </td>

                                                    <td>
                                                        <input type="checkbox" value="{{ $icon->id }}" id="room" {{ $icon->room ? 'checked' : '' }}  class="js-switch" data-color="#009efb">
                                                    </td>
                                                   
                                                    <td>
                                                        <input type="checkbox" value="{{ $icon->id }}" id="public" {{ $icon->public ? 'checked' : '' }}  class="js-switch" data-color="#009efb">
                                                    </td>
                                                    <td>
                                                        <a>{{ $icon->language->name }}</a>
                                                    </td>

                                                    
                                                    <td class="text-nowrap">

                                                        <a  data-toggle="modal" data-target="#update-icon{{ ($key+1) }}" data-original-title="Edit"> 
                                                            <i class="fa fa-pencil text-inverse m-r-10 m-l-10"></i>
                                                        </a>
                                                        
                                                        <a data-toggle="tooltip" data-original-title="Delete">
                                                            <form method="POST">
                                                                @csrf
                                                                <button class='btn btn-french-5 m-t-5' value="{{ $icon->id }}" id="icon_delete" type="button"><i class="fa fa-close text-danger"></i></button>
                                                            </form>
                                                        </a>
                                                    </td>
                                                
                                                        
                                                    <div id="update-icon{{ ($key+1) }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Update Icons</h4> </div>
                                                                <div class="modal-body">

                                                                    @can('update', $icon)
                                                                        <p style="color: green">Є права на редагування!!!</p> 
                                                                    @else
                                                                        <p style="color: red">Немає прав на редагування!!!</p>
                                                                    @endcan
                                                                    
                                                                    <form class="form-horizontal form-material" method="POST">
                                                                        @csrf
                                                                        
                                                                        <div class="form-group">

                                                                            <div class="col-md-12 m-b-20">
                                                                                <img src="{{ asset('images/'. $icon->icon) }}" width="200"/>
                                                                                <input type="hidden" value="{{ $icon->icon }}" name="old_img_up{{ $icon->id }}" />

                                                                                <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                                                    <span><i class="ion-upload m-r-5"></i>Upload Icon</span>
                                                                                    <input type="file" name="icon_up{{ $icon->id }}" class="upload icon_up"> 
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $icon->text }}" name="text_up{{ $icon->id }}" placeholder="Name"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Room</label>
                                                                                <input name="room_up{{ $icon->id }}" type="checkbox" placeholder="Room" class="js-switch" data-color="#009efb" {{ $icon->room ? 'checked' : '' }}>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Public</label>
                                                                                <input name="public_up{{ $icon->id }}" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $icon->public ? 'checked' : '' }}>
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Languages</label>
                                                                                
                                                                                <select class="selectpicker" name="language_id_up{{ $icon->id }}"  data-style="form-control btn-secondary">
                                                                                    @forelse($languages as $language)
                                                                                        <option  value="{{ $language->id }}" {{ $icon->language_id == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                                                                                    @empty

                                                                                    @endforelse
                                                                                </select> 
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" onclick="update_icon({{ $icon->id }})" id="icon_update" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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
                                                    <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact">Add New icons</button>
                                                </td>
                                                <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="myModalLabel">Add New Icons</h4> </div>
                                                            <div class="modal-body">

                                                                @can('create', $icon)
                                                                    <p style="color: green">Є права на додавання!!!</p> 
                                                                @else
                                                                    <p style="color: red">Немає прав на додавання!!!</p>
                                                                @endcan

                                                                <form class="form-horizontal form-material" method="POST">
                                                                    @csrf
                                                                    
                                                                    <div class="form-group">

                                                                        <div class="col-md-12 m-b-20">
                                                                            <img src="" id="img"  width="200"/>

                                                                            <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                                                <span><i class="ion-upload m-r-5"></i>Upload Image</span>
                                                                                <input type="file" id="icon" class="upload"> 
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 m-b-20">
                                                                            <input type="text" class="form-control" name="text" placeholder="Text"> 
                                                                        </div>
                                                                        
                                                                        <div class="col-md-12 m-b-20">
                                                                            <label class="col-form-label m-r-20">Room</label>
                                                                            <input name="room" type="checkbox" placeholder="Room" class="js-switch" data-color="#009efb" {{ $icon->room ? 'checked' : '' }}>
                                                                        </div>

                                                                        <div class="col-md-12 m-b-20">
                                                                            <label class="col-form-label m-r-20">Public</label>
                                                                            <input name="public" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $icon->public ? 'checked' : '' }}>
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
                                                                <button type="button" id="icon_submit" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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

        $('#icon').change(function (){
            var img_val = $('#icon')[0].files[0].name;
            var img_src = "{{ asset('images' ) }}/" + img_val;
            $('#img').attr("src", img_src);
        });

        $('.icon_up').change(function (){
            var img_val = $(this)[0].files[0].name;
            var img_src = "{{ asset('images' ) }}/" + img_val;
            $(this).parents('.m-b-20').find('img').attr("src", img_src);
        });



    
        $('#icon_submit').on('click', function (){

            var data = new FormData();

            var fil = $('#icon')[0].files[0];
            data.append('icon', fil);

            data.append('text', $("input[name='text']").val());
            data.append('room', $("input[name='room']:checked").val());
            data.append('public', $("input[name='public']:checked").val());
            data.append('language_id', $("select[name='language_id']").val());

            $.ajax({
                url: "/api/icon_store",
                method: 'POST',
                type: 'POST',
                data: data,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false
            })
            .fail(function (data) {
                
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

                $('body, html').animate({scrollTop: '.alert'}, 0);

            }).done(function (result) {
                
                $('#icon_view').html(result);
                $('.alert-success').html('Добавлено!!!');
                $('.alert-success').removeClass('hide');

                setTimeout(function () {
                    $('.alert-success').html();
                    $('.alert-success').addClass('hide');
                }, 10000);
                
                
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                $('#icon_view .js-switch').each(function() {
                    new Switchery($(this)[0], $(this).data());
                });

                $('#icon_view .selectpicker').selectpicker();

                $('body, html').animate({scrollTop: '.alert'}, 0);

            });
        });


        function update_icon(id) {

            var data = new FormData();

            data.append('id', id);

            if($('input[name="icon_up' + id + '"]')[0].files[0]) {
                var fil = $('input[name="icon_up' + id + '"]')[0].files[0].name;
                data.append('icon', fil);
            }
            data.append('old_img', $("input[name='old_img_up" + id + "']").val());

            data.append('text', $("input[name='text_up" + id + "']").val());
            data.append('room', $("input[name='room_up" + id + "']:checked").val());
            data.append('public', $("input[name='public_up" + id + "']:checked").val());
            data.append('language_id', $("select[name='language_id_up" + id + "']").val());

            $.ajax({
                url: "/api/icon_update/" + id,
                method: 'POST',
                type: 'POST',
                data: data,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false
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

                $('body, html').animate({scrollTop: '.alert'}, 0);

            }).done(function (result) {

                try{

                    $('#icon_view').html(result);
                    $('.alert-success').html('Оновлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#icon_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#icon_view .selectpicker').selectpicker();

                    $('body, html').animate({scrollTop: '.alert'}, 0);

                }catch{}
            });
        };


        $('#icon_view').on('change', 'input#room', function (){

            var id = $(this).val();
            $.ajax({
                url: "/api/icon_room",
                method: 'POST',
                type: 'POST',
                data: { 
                    id: id
                }
             }).done(function (result) {
                try{
                    
                    if(result == 'yes'){

                        $('.alert-success').html('На головну!!!');
                        $('.alert-success').removeClass('hide');

                        setTimeout(function () {
                            $('.alert-success').html();
                            $('.alert-success').addClass('hide');
                        }, 2000);

                        $('body, html').animate({scrollTop: '.alert'}, 0);

                    }else {
                        $('.alert-success').html('Скрити!!!');
                        $('.alert-success').removeClass('hide');

                        setTimeout(function () {
                            $('.alert-success').html();
                            $('.alert-success').addClass('hide');
                        }, 2000);

                        $('body, html').animate({scrollTop: '.alert'}, 0);
                    }
                }catch{}
            });
        });

        $('#icon_view').on('change', 'input#public', function (){

            var id = $(this).val();
            $.ajax({
                url: "/api/icon_public",
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

                        $('body, html').animate({scrollTop: '.alert'}, 0);

                    }else {
                        $('.alert-success').html('Не опубліковано!!!');
                        $('.alert-success').removeClass('hide');

                        setTimeout(function () {
                            $('.alert-success').html();
                            $('.alert-success').addClass('hide');
                        }, 2000);

                        $('body, html').animate({scrollTop: '.alert'}, 0);
                    }
                }catch{}
            });
        });


        $('#icon_view').on('click', '#icon_delete', function (){

            var icon_id = $(this).val();
            $.ajax({
                url: "/api/icon_delete/" + icon_id,
                method: 'POST',
                type: 'POST'
            }).done(function (result) {
                try{
                    $('#icon_view').html(result);
                    $('.alert-success').html('Видалено!!!');
                    
                    $('.alert-success').removeClass('hide');
                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 5000);

                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#icon_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#icon_view .selectpicker').selectpicker(); 

                    $('body, html').animate({scrollTop: '.alert'}, 0); 
                }catch{}
            });
        });

    </script>
        

    <!-- {{ asset('admin') }}  -->
@endsection