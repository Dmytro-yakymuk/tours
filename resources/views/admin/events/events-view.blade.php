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
                            <li class="breadcrumb-item active">events</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">

                               
                                <div class="hide alert alert-success"></div>

                                <div class="hide alert alert-danger"></div>
                           

                                @can('view', $events)
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
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Icon</th>
                                                <th>Start date</th>
                                                <th>End date</th>
                                                <th>Message</th>
                                                <th>Color</th>
                                                <th>Public</th>
                                                <th>Tour id</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="event_view">

                                            @forelse($events as $key => $event)
                                                <tr>
                                                    <td>{{ ($key+1) }}</td>
                                                    <td>
                                                        <a>{{ $event->name }}</a>
                                                    </td>
                                                    <td>
                                                        <a>{{ $event->email }}</a>
                                                    </td>
                                                    <td>
                                                        <a>{{ $event->phone }}</a>
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('images/'. $event->icon) }}" width="20"/>
                                                    </td>
                                                    <td>
                                                        <a>{{ $event->start_date }}</a>
                                                    </td>

                                                    <td>
                                                        <a>{{ $event->end_date }}</a>
                                                    </td>

                                                    <td>
                                                        <a>{{ $event->message }}</a>
                                                    </td>

                                                    <td>
                                                        <a>{{ $event->color }}</a>
                                                    </td>
                                                   
                                                    <td>
                                                        <input type="checkbox" value="{{ $event->id }}" id="public" {{ $event->public ? 'checked' : '' }}  class="js-switch" data-color="#009efb">
                                                    </td>

                                                    <td>
                                                        <a>{{ $event->tour_id }}</a>
                                                    </td>

                                                    
                                                    <td class="text-nowrap">

                                                        <a  data-toggle="modal" data-target="#update-event{{ ($key+1) }}" data-original-title="Edit"> 
                                                            <i class="fa fa-pencil text-inverse m-r-10 m-l-10"></i>
                                                        </a>
                                                        
                                                        <a data-toggle="tooltip" data-original-title="Delete">
                                                            <form method="POST">
                                                                @csrf
                                                                <button class='btn btn-french-5 m-t-5' value="{{ $event->id }}" id="event_delete" type="button"><i class="fa fa-close text-danger"></i></button>
                                                            </form>
                                                        </a>
                                                    </td>
                                                
                                                        
                                                    <div id="update-event{{ ($key+1) }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Update events</h4> </div>
                                                                <div class="modal-body">

                                                                    @can('update', $event)
                                                                        <p style="color: green">Є права на редагування!!!</p> 
                                                                    @else
                                                                        <p style="color: red">Немає прав на редагування!!!</p>
                                                                    @endcan
                                                                    
                                                                    <form class="form-horizontal form-material" method="POST">
                                                                        @csrf
                                                                        
                                                                        <div class="form-group">

                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $event->name }}" name="name_up{{ $event->id }}" placeholder="Name"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $event->email }}" name="email_up{{ $event->id }}" placeholder="Email"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $event->phone }}" name="phone_up{{ $event->id }}" placeholder="Phone"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <img src="{{ asset('images/'. $event->icon) }}" width="200"/>
                                                                                <input type="hidden" value="{{ $event->icon }}" name="old_img_up{{ $event->id }}" />

                                                                                <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                                                    <span><i class="ion-upload m-r-5"></i>Upload Icon</span>
                                                                                    <input type="file" name="icon_up{{ $event->id }}" class="upload icon_up"> 
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="example-date-input" class="col-2 col-form-label">Start Date</label>
                                                                                <div class="col-10">
                                                                                    <input name="start_date_up{{ $event->id }}" value="{{ $event->start_date }}" class="form-control" type="date" id="example-date-input">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="example-date-input" class="col-2 col-form-label">End Date</label>
                                                                                <div class="col-10">
                                                                                    <input name="end_date_up{{ $event->id }}" value="{{ $event->end_date }}" class="form-control" type="date" id="example-date-input">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Tour</label>
                                                                                
                                                                                <select class="selectpicker" name="tour_id_up{{ $event->id }}"  data-style="form-control btn-secondary">
                                                                                    @forelse($tours as $tour)
                                                                                        <option  value="{{ $tour->id }}" {{ $event->tour_id == $tour->id ? 'selected' : '' }}>{{ $tour->title }}</option>
                                                                                    @empty

                                                                                    @endforelse
                                                                                </select> 
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Message</label>
                                                                                <textarea name="message_up{{ $event->id }}" value="{{ $event->message }}" class="form-control" rows="5"></textarea>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="example-color-input" class="col-2 col-form-label">Color</label>
                                                                                <div class="col-10">
                                                                                    <input name="color_up{{ $event->id }}" value="{{ $event->color }}" class="form-control" type="color" id="example-color-input">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Public</label>
                                                                                <input name="public_up{{ $event->id }}" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $event->public ? 'checked' : '' }}>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" onclick="update_event({{ $event->id }})" id="event_update" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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
                                                    <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact">Add New Events</button>
                                                </td>
                                                <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="myModalLabel">Add New events</h4> </div>
                                                            <div class="modal-body">

                                                                @can('create', $event)
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
                                                                                <input type="text" class="form-control" name="email" placeholder="Email"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" name="phone" placeholder="Phone"> 
                                                                            </div>

                                                                        <div class="col-md-12 m-b-20">
                                                                            <img src="" id="img"  width="200"/>

                                                                            <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                                                                <span><i class="ion-upload m-r-5"></i>Upload Icon</span>
                                                                                <input type="file" id="icon" class="upload"> 
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                                <label for="example-date-input" class="col-2 col-form-label">Start Date</label>
                                                                                <div class="col-10">
                                                                                    <input name="start_date" class="form-control" type="date" id="example-date-input">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="example-date-input" class="col-2 col-form-label">End Date</label>
                                                                                <div class="col-10">
                                                                                    <input name="end_date" class="form-control" type="date" id="example-date-input">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Tour</label>
                                                                                
                                                                                <select class="selectpicker" name="tour_id"  data-style="form-control btn-secondary">
                                                                                    @forelse($tours as $tour)
                                                                                        <option  value="{{ $tour->id }}" {{ $event->tour_id == $tour->id ? 'selected' : '' }}>{{ $tour->title }}</option>
                                                                                    @empty

                                                                                    @endforelse
                                                                                </select> 
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Message</label>
                                                                                <textarea name="message" id="message"  class="form-control" rows="5"></textarea>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="example-color-input" class="col-2 col-form-label">Color</label>
                                                                                <div class="col-10">
                                                                                    <input name="color" class="form-control" type="color" id="example-color-input">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Public</label>
                                                                                <input name="public" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $event->public ? 'checked' : '' }}>
                                                                            </div>

                                                                        
                                                                           
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" id="event_submit" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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



    
        $('#event_submit').on('click', function (){

            var data = new FormData();

            data.append('name', $("input[name='name']").val());
            data.append('email', $("input[name='email']").val());
            data.append('phone', $("input[name='phone']").val());

            var fil = $('#icon')[0].files[0];
            data.append('icon', fil);

            data.append('start_date', $("input[name='start_date']").val());
            data.append('end_date', $("input[name='end_date']").val());
            data.append('tour_id', $("select[name='tour_id']").val());
            data.append('color', $("textarea[name='message']").val());
            data.append('color', $("input[name='color']").val());
            data.append('public', $("input[name='public']:checked").val());

            $.ajax({
                url: "/api/event_store",
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
                
                $('#event_view').html(result);
                $('.alert-success').html('Добавлено!!!');
                $('.alert-success').removeClass('hide');

                setTimeout(function () {
                    $('.alert-success').html();
                    $('.alert-success').addClass('hide');
                }, 10000);
                
                
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                $('#event_view .js-switch').each(function() {
                    new Switchery($(this)[0], $(this).data());
                });

                $('#event_view .selectpicker').selectpicker();

                $('body, html').animate({scrollTop: '.alert'}, 0);

            });
        });


        function update_event(id) {

            var data = new FormData();

            data.append('id', id);

            data.append('name', $("input[name='name_up" + id + "']").val());
            data.append('email', $("input[name='email_up" + id + "']").val());
            data.append('phone', $("input[name='phone_up" + id + "']").val());

            if($('input[name="icon_up' + id + '"]')[0].files[0]) {
                var fil = $('input[name="icon_up' + id + '"]')[0].files[0].name;
                data.append('icon', fil);
            }
            data.append('old_img', $("input[name='old_img_up" + id + "']").val());

            data.append('start_date', $("input[name='start_date_up" + id + "']").val());
            data.append('end_date', $("input[name='end_date_up" + id + "']").val());
            data.append('tour_id', $("select[name='tour_id_up" + id + "']").val());
            data.append('color', $("textarea[name='message_up" + id + "']").val());
            data.append('color', $("input[name='color_up" + id + "']").val());
            data.append('public', $("input[name='public_up" + id + "']:checked").val());

            $.ajax({
                url: "/api/event_update/" + id,
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

                    $('#event_view').html(result);
                    $('.alert-success').html('Оновлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#event_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#event_view .selectpicker').selectpicker();

                    $('body, html').animate({scrollTop: '.alert'}, 0);

                }catch{}
            });
        };


        $('#event_view').on('change', 'input#public', function (){

            var id = $(this).val();
            $.ajax({
                url: "/api/event_public",
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


        $('#event_view').on('click', '#event_delete', function (){

            var event_id = $(this).val();
            $.ajax({
                url: "/api/event_delete/" + event_id,
                method: 'POST',
                type: 'POST'
            }).done(function (result) {
                try{
                    $('#event_view').html(result);
                    $('.alert-success').html('Видалено!!!');
                    
                    $('.alert-success').removeClass('hide');
                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 5000);

                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#event_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#event_view .selectpicker').selectpicker(); 

                    $('body, html').animate({scrollTop: '.alert'}, 0); 
                }catch{}
            });
        });

    </script>
        

    <!-- {{ asset('admin') }}  -->
@endsection