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
                            <li class="breadcrumb-item active">regions</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">

                               
                                <div class="hide alert alert-success"></div>

                                <div class="hide alert alert-danger"></div>
                           

                                @can('view', $regions)
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
                                                <th>Image</th>
                                                <th>Public</th>
                                                <th>Language</th>
                                                <th>Country</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="region_view">

                                            @forelse($regions as $key => $region)
                                                <tr>
                                                    <td>{{ ($key+1) }}</td>
                                                    <td>
                                                        <a>{{ $region->name }}</a>
                                                    </td>
                                                    <td>
                                                        <a>{{ $region->slug }}</a>
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('images/region/'. $region->image) }}" width="200"/>
                                                    </td>
                                                   
                                                    <td>
                                                        <input type="checkbox" value="{{ $region->id }}" id="public" {{ $region->public ? 'checked' : '' }}  class="js-switch" data-color="#009efb">
                                                    </td>
                                                    <td>
                                                        <a>{{ $region->language->name }}</a>
                                                    </td>

                                                    <td>
                                                        <a>{{ $region->country->name }}</a>
                                                    </td>
                                                    
                                                    <td class="text-nowrap">

                                                        <a  data-toggle="modal" data-target="#update-contact{{ ($key+1) }}" data-original-title="Edit"> 
                                                            <i class="fa fa-pencil text-inverse m-r-10 m-l-10"></i>
                                                        </a>
                                                        
                                                        <a data-toggle="tooltip" data-original-title="Delete">
                                                            <form method="POST">
                                                                @csrf
                                                                <button class='btn btn-french-5 m-t-5' value="{{ $region->id }}" id="region_delete" type="button"><i class="fa fa-close text-danger"></i></button>
                                                            </form>
                                                        </a>
                                                    </td>
                                                
                                                        
                                                    <div id="update-contact{{ ($key+1) }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Update regions</h4> </div>
                                                                <div class="modal-body">

                                                                    @can('update', $region)
                                                                        <p style="color: green">Є права на редагування!!!</p> 
                                                                    @else
                                                                        <p style="color: red">Немає прав на редагування!!!</p>
                                                                    @endcan
                                                                    
                                                                    <form class="form-horizontal form-material" method="POST">
                                                                        @csrf
                                                                        
                                                                        <div class="form-group">
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $region->name }}" name="name_up{{ $region->id }}" placeholder="Name"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $region->slug }}" name="slug_up{{ $region->id }}" placeholder="Slug"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <img src="{{ asset('images/region/'. $region->image) }}" width="200"/>
                                                                                <input type="hidden" value="{{ $region->image }}" name="old_img_up{{ $region->id }}" />

                                                                                <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                                                    <span><i class="ion-upload m-r-5"></i>Upload Image</span>
                                                                                    <input type="file" name="image_up{{ $region->id }}" class="upload image_up"> 
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Public</label>
                                                                                <input name="public_up{{ $region->id }}" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $region->public ? 'checked' : '' }}>
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Languages</label>
                                                                                
                                                                                <select class="selectpicker" name="language_id_up{{ $region->id }}"  data-style="form-control btn-secondary">
                                                                                    @forelse($languages as $language)
                                                                                        <option  value="{{ $language->id }}" {{ $region->language_id == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                                                                                    @empty

                                                                                    @endforelse
                                                                                </select> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Country</label>
                                                                                
                                                                                <select class="selectpicker" name="country_id_up{{ $region->id }}"  data-style="form-control btn-secondary">
                                                                                    @forelse($countries as $country)
                                                                                        <option  value="{{ $country->id }}" {{ $region->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                                                                    @empty

                                                                                    @endforelse
                                                                                </select> 
                                                                            </div>    
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" onclick="update_region({{ $region->id }})" id="region_update" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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
                                                    <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact">Add New regions</button>
                                                </td>
                                                <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="myModalLabel">Add New regions</h4> </div>
                                                            <div class="modal-body">

                                                                @can('create', $region)
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
                                                                            <img src="" id="img"  width="200"/>

                                                                            <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                                                <span><i class="ion-upload m-r-5"></i>Upload Image</span>
                                                                                <input type="file" id="image" class="upload"> 
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 m-b-20">
                                                                            <label class="col-form-label m-r-20">Public</label>
                                                                            <input name="public" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $region->public ? 'checked' : '' }}>
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
                                                                        <div class="col-md-12 m-b-20">
                                                                            <label class="col-form-label m-r-20">Country</label>
                                                                            
                                                                            <select class="selectpicker" name="country_id"  data-style="form-control btn-secondary">
                                                                                @forelse($countries as $country)
                                                                                    <option  value="{{ $country->id }}" {{ $region->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                                                                @empty

                                                                                @endforelse
                                                                            </select> 
                                                                        </div>     
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" id="region_submit" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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

        $('#image').change(function (){
            var img_val = $('#image')[0].files[0].name;
            var img_src = "{{ asset('images/region' ) }}/" + img_val;
            $('#img').attr("src", img_src);
        });

        $('.image_up').change(function (){
            var img_val = $(this)[0].files[0].name;
            var img_src = "{{ asset('images/region' ) }}/" + img_val;
            $(this).parents('.m-b-20').find('img').attr("src", img_src);
        });



    
        $('#region_submit').on('click', function (){

            var data = new FormData();

            data.append('name', $("input[name='name']").val());
            data.append('slug', $("input[name='slug']").val());

            var fil = $('#image')[0].files[0];
            data.append('image', fil);
            data.append('public', $("input[name='public']:checked").val());
            data.append('language_id', $("select[name='language_id']").val());
            data.append('country_id', $("select[name='country_id']").val());

            $.ajax({
                url: "/api/region_store",
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
                
                $('#region_view').html(result);
                $('.alert-success').html('Добавлено!!!');
                $('.alert-success').removeClass('hide');

                setTimeout(function () {
                    $('.alert-success').html();
                    $('.alert-success').addClass('hide');
                }, 10000);
                
                
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                $('#region_view .js-switch').each(function() {
                    new Switchery($(this)[0], $(this).data());
                });

                $('#region_view .selectpicker').selectpicker();

                $('body, html').animate({scrollTop: '.alert'}, 0);

            });
        });


        function update_region(id) {

            var region = $("input[name='slug_up" + id + "']").val();

            var data = new FormData();

            data.append('id', id);
            data.append('name', $("input[name='name_up" + id + "']").val());
            data.append('slug', $("input[name='slug_up" + id + "']").val());

            if($('input[name="image_up' + id + '"]')[0].files[0]) {
                var fil = $('input[name="image_up' + id + '"]')[0].files[0].name;
                data.append('image', fil);
            }
            

            data.append('old_img', $("input[name='old_img_up" + id + "']").val());
            data.append('public', $("input[name='public_up" + id + "']:checked").val());
            data.append('language_id', $("select[name='language_id_up" + id + "']").val());
            data.append('country_id', $("select[name='country_id_up" + id + "']").val());
            
            $.ajax({
                url: "/api/region_update/" + region,
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

                    $('#region_view').html(result);
                    $('.alert-success').html('Оновлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#region_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#region_view .selectpicker').selectpicker();

                    $('body, html').animate({scrollTop: '.alert'}, 0);

                }catch{}
            });
        };


        $("input#public").change(function(){
            var id = $(this).val();
            $.ajax({
                url: "/api/region_public",
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


        $('#region_view').on('click', '#region_delete', function (){

            var region_id = $(this).val();
            $.ajax({
                url: "/api/region_delete/" + region_id,
                method: 'POST',
                type: 'POST'
            }).done(function (result) {
                try{
                    $('#region_view').html(result);
                    $('.alert-success').html('Видалено!!!');
                    
                    $('.alert-success').removeClass('hide');
                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 5000);

                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#region_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#region_view .selectpicker').selectpicker(); 

                    $('body, html').animate({scrollTop: '.alert'}, 0); 
                }catch{}
            });
        });

    </script>
        

    <!-- {{ asset('admin') }}  -->
@endsection