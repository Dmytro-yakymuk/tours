@extends('layouts.admin')

@section('css-extra')


    <!-- Footable CSS -->
    <link href="{{ asset('admin/assets/plugins/footable/css/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <!-- ============================================================== -->


    
    <!-- page CSS ============================================================== -->
    <link href="{{ asset('admin/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
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
                           

                                @can('view', $comments)
                                    <p style="color: green">Є права на перегляд!!!</p> 
                                @else
                                    <p style="color: red">Немає прав на перегляд!!!</p>
                                @endcan


                                <div class="table-responsive">
                                    <table id="demo-foo-addrow" class="table table-hover contact-list" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Text</th>
                                                <th>Country</th>
                                                <th>Rating</th>
                                                <th>Public</th>
                                                <th>Tour_id</th>
                                                <th>User_id</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="comment_view">

                                            @forelse($comments as $key => $comment)
                                                <tr>
                                                    <td>{{ ($key+1) }}</td>
                                                    <td>
                                                        <a>{{ $comment->text }}</a>
                                                    </td>
                                                    <td>
                                                        <a>{{ $comment->country }}</a>
                                                    </td>
                                                    <td>
                                                        <a>{{ $comment->rating }}</a>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" value="{{ $comment->id }}" id="public" {{ $comment->public ? 'checked' : '' }}  class="js-switch" data-color="#009efb">
                                                    </td>
                                                    <td>
                                                        <a>{{ $comment->tour_id }}</a>
                                                    </td>
                                                    <td>
                                                        <a>{{ $comment->user_id }}</a>
                                                    </td>

                                                    <td class="text-nowrap">

                                                        <a data-toggle="modal" data-target="#edit-comment{{ ($key+1) }}" onclick="view_comment_plus({{ $comment->id }})" data-original-title="Edit"> 
                                                            <i class="fa fa-pencil text-inverse m-r-10 m-l-10"></i>
                                                        </a>
                                                        
                                                        <a data-toggle="tooltip" data-original-title="Delete">
                                                            <form method="POST">
                                                                @csrf
                                                                <button class='btn btn-french-5 m-t-5'value="{{ $comment->id }}" id="comment_delete" type="button">
                                                                    <i class="fa fa-close text-danger"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </td>
                                                        
                                                    <div id="edit-comment{{ ($key+1) }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Update comment</h4> </div>
                                                                <div class="modal-body">

                                                                    @can('update', $comment)
                                                                        <p style="color: green">Є права на редагування!!!</p> 
                                                                    @else
                                                                        <p style="color: red">Немає прав на редагування!!!</p>
                                                                    @endcan
                                                                    
                                                                    <form class="form-horizontal form-material" method="POST">
                                                                        @csrf
                                                                        
                                                                        <div class="form-group">

                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $comment->text }}" name="text_up{{ $comment->id }}" placeholder="Text"> 
                                                                            </div>
                                                                            <div class="col-md-12 m-b-20">
                                                                                <input type="text" class="form-control" value="{{ $comment->country }}" name="country_up{{ $comment->id }}" placeholder="Country"> 
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label class="col-2 col-form-label">Rating</label>
                                                                                <div class="col-6">
                                                                                    <input class="rating_up" type="text" value="{{ $comment->rating }}" placeholder="0" name="rating_up{{ $comment->id }}" class=" form-control" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline"> 
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12 m-b-20">
                                                                                <label class="col-form-label m-r-20">Public</label>
                                                                                <input name="public_up{{ $comment->id }}" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $comment->public ? 'checked' : '' }}>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label class="col-2 col-form-label">Tour</label>
                                                                                <div class="col-10">
                                                                                    <select class="selectpicker" name="tour_id_up{{ $comment->id }}"  data-style="form-control btn-secondary">

                                                                                        @forelse($tours as $tour)
                                                                                            @if($tour->id == $comment->tour_id)
                                                                                                <option selected value="{{ $tour->id }}" >{{ $tour->title }}</option>
                                                                                            @else
                                                                                                <option value="{{ $tour->id }}" >{{ $tour->title }}</option>
                                                                                            @endif
                                                                                        @empty

                                                                                        @endforelse

                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label class="col-2 col-form-label">User</label>
                                                                                <div class="col-10">
                                                                                    <select class="selectpicker" name="user_id_up{{ $comment->id }}"  data-style="form-control btn-secondary">

                                                                                        @forelse($users as $user)
                                                                                            @if($user->id == $comment->user_id)
                                                                                                <option selected value="{{ $user->id }}" >{{ $user->name }}</option>
                                                                                            @else
                                                                                                <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                                                                            @endif
                                                                                        @empty

                                                                                        @endforelse

                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="commentpluses_view{{ $comment->id }}"></div>

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" onclick="update_comment({{ $comment->id }})" id="comment_update" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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
                                                    <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-comment">Add New comment</button>
                                                </td>
                                                <div id="add-comment" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="myModalLabel">Add New Comment</h4> </div>
                                                            <div class="modal-body">

                                                                @can('create', $comment)
                                                                    <p style="color: green">Є права на додавання!!!</p> 
                                                                @else
                                                                    <p style="color: red">Немає прав на додавання!!!</p>
                                                                @endcan

                                                                <form class="form-horizontal form-material" method="POST">
                                                                    @csrf
                                                                    
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 m-b-20">
                                                                            <input type="text" class="form-control" name="text" placeholder="Text"> 
                                                                        </div>
                                                                        <div class="col-md-12 m-b-20">
                                                                            <input type="text" class="form-control" name="country" placeholder="country"> 
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label">Rating</label>
                                                                            <div class="col-6 ">
                                                                                <input id="rating" type="text" value="{{ $comment->price }}" placeholder="0" name="rating" class=" form-control" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline"> 
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 m-b-20">
                                                                            <label class="col-form-label m-r-20">Public</label>
                                                                            <input name="public" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $comment->public ? 'checked' : '' }}>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label">Tour</label>
                                                                            <div class="col-10">
                                                                                <select class="selectpicker" name="tour_id"  data-style="form-control btn-secondary">

                                                                                    @foreach($tours as $tour)
                                                                                        <option value="{{ $tour->id }}" >{{ $tour->title }}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label">User</label>
                                                                            <div class="col-10">
                                                                                <select class="selectpicker" name="user_id"  data-style="form-control btn-secondary">

                                                                                    @forelse($users as $user)
                                                                                        
                                                                                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                                                                        
                                                                                    @empty

                                                                                    @endforelse

                                                                                </select>
                                                                            </div>
                                                                        </div>



                                                                        <div class="form-group row">
                                                                            <label  class="col-2 col-form-label">Comment Plus</label>
                                                                            <div class="col-10">
                                                                                
                                                                                <select class='pre-selected-options' name="commentpluses_true[]" multiple='multiple'>
                                                                                    @forelse($commentpluses as $commentplus)
                                                                                        @if($commentplus->position == true)
                                                                                            <option {{ old('commentpluses[]') ? 'selected' : '' }} value='{{ $commentplus->id }}'>
                                                                                                {{ $commentplus->name }}
                                                                                            </option>
                                                                                        @endif
                                                                                        
                                                                                    @empty

                                                                                    @endforelse 
                                                                                </select>

                                                                            </div>
                                                                        </div>

                                                                         <div class="form-group row">
                                                                            <label  class="col-2 col-form-label">Comment False</label>
                                                                            <div class="col-10">
                                                                                
                                                                                <select class='pre-selected-options' name="commentpluses_false[]" multiple='multiple'>
                                                                                    @forelse($commentpluses as $commentplus)
                                                                                        @if($commentplus->position == false)
                                                                                            <option {{ old('commentpluses[]') ? 'selected' : '' }} value='{{ $commentplus->id }}'>
                                                                                                {{ $commentplus->name }}
                                                                                            </option>
                                                                                        @endif
                                                                                        
                                                                                    @empty

                                                                                    @endforelse 
                                                                                </select>

                                                                            </div>
                                                                        </div>

                                                                       

                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" id="comment_submit" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
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
@endsection

@section('js-extra')
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

    <!-- This page plugins ============================================================== -->
    <script src="{{ asset('admin/assets/plugins/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <!-- ============================================================== -->
    
    <script src="{{ asset('admin/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $('.pre-selected-options').multiSelect();

            $("input#rating").TouchSpin({
                min: 0,
                max: 10,
                step: 1,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '%'
            });

            $("input.rating_up").TouchSpin({
                min: 0,
                max: 10,
                step: 1,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '%'
            });
        });  
    </script>

    <script>
        function view_comment_plus(id) {

            $.ajax({
                url: "/api/view_comment_plus",
                method: 'POST',
                type: 'POST',
                data: { 
                    id: id
                }
            }).fail(function (data) {
               
            }).done(function (result) {
                $('.commentpluses_view' + id).html(result);

                $('.pre-selected-options_up').multiSelect();
            });
        };
    
        $('#comment_submit').on('click', function (){

            $.ajax({
                url: "/api/comment_store",
                method: 'POST',
                type: 'POST',
                data: { 
                    text: $("input[name='text']").val(),
                    country: $("input[name='country']").val(),
                    rating: $("input[name='rating']").val(),
                    public: $("input[name='public']:checked").val(),
                    tour_id: $("select[name='tour_id']").val(),
                    user_id: $("select[name='user_id']").val(),
                    comment_pluses_true: $("select[name='commentpluses_true[]']").val(),
                    comment_pluses_false: $("select[name='commentpluses_false[]']").val()
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
                    $('#comment_view').html(result);
                    $('.alert-success').html('Добавлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#comment_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#comment_view .selectpicker').selectpicker();

                    $('body, html').animate({scrollTop: '.alert'}, 1000);

                }catch{}
            });
        });


        function update_comment(id) {

            $.ajax({
                url: "/api/comment_update/" + id,
                method: 'POST',
                type: 'POST',
                data: { 
                    text: $("input[name='text_up" + id + "']").val(),
                    country: $("input[name='country_up" + id + "']").val(),
                    rating: $("input[name='rating_up" + id + "']").val(),
                    public: $("input[name='public_up" + id + "']:checked").val(),
                    tour_id: $("select[name='tour_id_up" + id + "']").val(),
                    user_id: $("select[name='user_id_up" + id + "']").val(),
                    comment_pluses_true: $("select[name='commentpluses_true[]_up" + id + "']").val(),
                    comment_pluses_false: $("select[name='commentpluses_false[]_up" + id + "']").val()
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

                    $('#comment_view').html(result);
                    $('.alert-success').html('Оновлено!!!');
                    $('.alert-success').removeClass('hide');

                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 10000);
                    
                    
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#comment_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#comment_view .selectpicker').selectpicker();

                    $('body, html').animate({scrollTop: '.alert'}, 1000);

                }catch{}
            });
        };

        $('#comment_view').on('change', 'input#public', function (){
            var id = $(this).val();
            $.ajax({
                url: "/api/comment_public",
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



        $('#comment_view').on('click', '#comment_delete', function (){

            var comment_id = $(this).val();
            $.ajax({
                url: "/api/comment_delete/" + comment_id,
                method: 'POST',
                type: 'POST'
            }).done(function (result) {
                try{
                    $('#comment_view').html(result);
                    $('.alert-success').html('Видалено!!!');
                    
                    $('.alert-success').removeClass('hide');
                    setTimeout(function () {
                        $('.alert-success').html();
                        $('.alert-success').addClass('hide');
                    }, 5000);

                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('#comment_view .js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });

                    $('#comment_view .selectpicker').selectpicker(); 

                    $('body, html').animate({scrollTop: '.alert'}, 1000); 
                }catch{}
            });
        });

    </script>
        

    <!-- {{ asset('admin') }}  -->
@endsection