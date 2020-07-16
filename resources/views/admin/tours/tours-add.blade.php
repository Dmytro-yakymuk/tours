@extends('layouts.admin')


@section('css-extra')
    <!-- Html5 Editor -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/html5-editor/bootstrap-wysihtml5.css') }}" />
    <!-- ============================================================== -->

    <!-- Cropper CSS -->
    <link href="{{ asset('admin/assets/plugins/cropper/cropper.min.css') }}" rel="stylesheet">
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

    <!-- Ssi Uploader ============================================================== -->
    <link href="{{ asset('admin/assets/plugins/ssi-uploader/dist/ssi-uploader/styles/ssi-uploader.min.css') }}" rel="stylesheet"/>
    <!-- ============================================================== -->


    <!-- {{ asset('admin') }} -->
@endsection


@section('content')
    <div id="main-wrapper">

        @include('admin.header')

        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="profile-img"> <img src="{{ asset('admin') }}/assets/images/users/1.jpg" alt="user" /> </div>
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
                
                @include('admin.sidebar_navigation')

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
                            <li class="breadcrumb-item active"><a href="{{ route('admin.tours.index', ['specie' => $specie]) }}">Tours</a></li>
                            <li class="breadcrumb-item">Create Tour</li>
                        </ol>
                    </div>

                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">

                                <h4 class="card-title"></h4>

                                <form class="form form1" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" value="{{ $locale }}"  name="locale" id="locale"> 
                                    

                                    <div class="form-group row m-t-10">
                                        <label class="col-2 col-form-label">Title</label>
                                        <div class="col-10">
                                            <input name="title" value="{{ old('title') ? old('title') : '' }}" class="form-control" type="text"  placeholder="Title">
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Description</label>
                                        <div class="col-10">
                                            <textarea name="description" class="textarea_editor form-control" rows="15" placeholder="Enter description ...">{{ old('description') ? old('description') : '' }}</textarea>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Text</label>
                                        <div class="col-10">
                                            <textarea name="text" class="textarea_editor2 form-control" rows="15" placeholder="Enter text ...">{{ old('text') ? old('text') : '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Image</label>
                                        <div class="col-10">
                                            
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="img-container"><img id="image" src="{{ asset('images/hunting') }}/{{ old('image') ? old('image') : 'img-layouts.jpg' }}" class="img-responsive" alt="Picture"></div>
                                                </div>
                                            
                                                <div class="col-md-12 docs-buttons p-20">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info" data-method="setDragMode" data-option="move" title="Move"> <span class="docs-tooltip" data-toggle="tooltip" title="Move"> <span class="fa fa-arrows"></span> </span>
                                                        </button>
                                                        <button type="button" class="btn btn-info" data-method="setDragMode" data-option="crop" title="Crop"> <span class="docs-tooltip" data-toggle="tooltip" title="Crop"> <span class="fa fa-crop"></span> </span>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" data-method="zoom" data-option="0.1" title="Zoom In"> <span class="docs-tooltip" data-toggle="tooltip" title="Zoom In"> <span class="fa fa-search-plus"></span> </span>
                                                        </button>
                                                        <button type="button" class="btn btn-success" data-method="zoom" data-option="-0.1" title="Zoom Out"> <span class="docs-tooltip" data-toggle="tooltip" title="Zoom Out"> <span class="fa fa-search-minus"></span> </span>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="move" data-option="-10" data-second-option="0" title="Move Left"> <span class="docs-tooltip" data-toggle="tooltip" title="Move Left"> <span class="fa fa-arrow-left"></span> </span>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="move" data-option="10" data-second-option="0" title="Move Right"> <span class="docs-tooltip" data-toggle="tooltip" title="Move Right"> <span class="fa fa-arrow-right"></span> </span>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="move" data-option="0" data-second-option="-10" title="Move Up"> <span class="docs-tooltip" data-toggle="tooltip" title="Move Up"> <span class="fa fa-arrow-up"></span> </span>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="move" data-option="0" data-second-option="10" title="Move Down"> <span class="docs-tooltip" data-toggle="tooltip" title="Move Down"> <span class="fa fa-arrow-down"></span> </span>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="rotate" data-option="-45" title="Rotate Left"> <span class="docs-tooltip" data-toggle="tooltip" title="Rotate Left"> <span class="fa fa-rotate-left"></span> </span>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="rotate" data-option="45" title="Rotate Right"> <span class="docs-tooltip" data-toggle="tooltip" title="Rotate Right"> <span class="fa fa-rotate-right"></span> </span>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="scaleX" data-option="-1" title="Flip Horizontal"> <span class="docs-tooltip" data-toggle="tooltip" title="Flip Horizontal"> <span class="fa fa-arrows-h"></span> </span>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="scaleY" data-option="-1" title="Flip Vertical"> <span class="docs-tooltip" data-toggle="tooltip" title="Flip Vertical"> <span class="fa fa-arrows-v"></span> </span>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="crop" title="Crop"> <span class="docs-tooltip" data-toggle="tooltip" title="Crop"> <span class="fa fa-check"></span> </span>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="clear" title="Clear"> <span class="docs-tooltip" data-toggle="tooltip" title="Clear"> <span class="fa fa-remove"></span> </span>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="disable" title="Disable"> <span class="docs-tooltip" data-toggle="tooltip" title="Disable"> <span class="fa fa-lock"></span> </span>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="enable" title="Enable"> <span class="docs-tooltip" data-toggle="tooltip" title="Enable"> <span class="fa fa-unlock"></span> </span>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary btn-outline" data-method="reset" title="Reset"> <span class="docs-tooltip" data-toggle="tooltip" title="Reset"> <span class="fa fa-refresh"></span> </span>
                                                        </button>
                                                        <label class="btn btn-secondary btn-outline btn-upload" for="inputImage" title="Upload image file">
                                                            <input type="file" name="image" class="sr-only" id="inputImage" >
                                                            <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs"> <span class="fa fa-upload"></span> </span>
                                                        </label>
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-12">

                                                    <div class="docs-preview clearfix">
                                                        <div class="img-preview preview-lg"></div>
                                                    </div>
                                                    
                                                    <div class="docs-data">
                                                        <div class="input-group input-group-sm">
                                                            <input type="hidden" id="dataX"  name="x">
                                                            <input type="hidden" id="dataY" name="y">
                                                            <input type="hidden" id="dataWidth" name="width">
                                                            <input type="hidden" id="dataHeight" name="height">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Public</label>
                                        <div class="col-10">
                                            <input name="public" {{ old('public') ? 'checked' : '' }} type="checkbox" class="js-switch" data-color="#009efb">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-email-input" class="col-2 col-form-label">New</label>
                                        <div class="col-10">
                                            <input name="new" {{ old('new') ? 'checked' : '' }} type="checkbox" class="js-switch" data-color="#009efb">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Sold</label>
                                        <div class="col-10">
                                            <input name="sold" {{ old('sold') ? 'checked' : '' }} type="checkbox" class="js-switch" data-color="#009efb">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-email-input" class="col-2 col-form-label">Root</label>
                                        <div class="col-10">
                                            <input name="root" {{ old('root') ? 'checked' : '' }} type="checkbox" class="js-switch" data-color="#009efb">
                                        </div>
                                    </div>


                                    

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Region</label>
                                        <div class="col-10">
                                            <select class="selectpicker" name="region_id"  data-style="form-control btn-secondary">
                                                
                                                @forelse($countries as $country)
                                                    <optgroup label="{{ $country->name }}">
                                                        @forelse($regions as $region)
                                                            @if($region->country_id == $country->id)
                                                                <option {{ old('region_id') ? 'selected' : '' }} value="{{ $region->id }}" >{{ $region->name }}</option>
                                                            @endif
                                                        @empty

                                                        @endforelse
                                                        
                                                    </optgroup>
                                                @empty

                                                @endforelse
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Languages</label>
                                        <div class="col-10">
                                            <select class="selectpicker" name="language_id"  data-style="form-control btn-secondary">
                                                @forelse($languages as $language)
                                                    <option {{ old('language_id') ? 'selected' : '' }} value="{{ $language->id }}" >{{ $language->name }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                            
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Price and Discont</label>
                                        <div class="col-3">
                                            <input id="price_discount" type="text" value="{{ old('price') ? old('price') : 'Price' }}" placeholder="0" name="price_discount" class=" form-control" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline"> 
                                        </div>
                                        <div class="col-3">
                                            <input id="discount" type="text" value="{{ old('discount') ? old('discount') : 'Discount' }}" name="discount" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline">
                                        </div>
                                        <label> = </label>
                                        <span id="result"></span>
                                        <input type="hidden" id="price" name="price">
                                    </div>


                                    <button type="button" id="tour_button1" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                </form>






                                <form class="form form2 hide" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" value="{{ $locale }}"  name="locale" id="locale"> 
                                    <input type="hidden" name="tour_id" id="tour_id"> 

                                    <div class="form-group row">
                                        <label  class="col-2 col-form-label">Icons</label>
                                        <div class="col-10">
                                            
                                            <select id='pre-selected-options' name="icons[]" multiple='multiple'>
                                                @forelse($icons as $icon)
                                                    <option {{ old('icons[]') ? 'selected' : '' }} value='{{ $icon->id }}'>
                                                        {{ $icon->text }}
                                                    </option>
                                                @empty

                                                @endforelse 
                                            </select>

                                        </div>
                                    </div>
                                    
                                    <div class="form-group row"> 
                                        <label for="example-tel-input" class="col-2 col-form-label">Services</label>
                                        <div class="col-10">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Stan</th>
                                                            <th>Name</th>
                                                            <th>Description</th>
                                                            <th>Root</th>
                                                            <th>Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($services as $key => $service)
                                                            
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td>
                                                                    <label class="custom-control custom-checkbox">
                                                                        @if($service->service_price)
                                                                            <input type="checkbox" checked value="{{ $service->id }}" name="stan{{ $service->id }}" class="custom-control-input">
                                                                        @else
                                                                            <input type="checkbox" value="{{ $service->id }}" name="stan{{ $service->id }}" class="custom-control-input">
                                                                        @endif
                                                                        <span class="custom-control-indicator"></span>
                                                                    </label>
                                                                </td>
                                                                <td>{{ $service->name }}</td>
                                                                <td>
                                                                    @if($service->addition)
                                                                        ({{ $service->addition }})
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($service->position == 1)
                                                                        <span class="label label-danger">root</span> 
                                                                    @elseif($service->position == 2)
                                                                        <span class="label label-success">hunting</span>
                                                                    @elseif($service->position == 3)
                                                                        <span class="label label-warning">drem</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <input id="service_price" type="text"  placeholder="0" name="service_price{{ $service->id }}" class="service_price form-control" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline"> 
                                                                </td>
                                                            </tr>
                                                            
                                                        @empty

                                                        @endforelse
                                                        
                                                    </tbody>

                                                    
                                                </table>
                                            </div>
                                        </div>    
                                    </div>



                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Upload Images</label>
                                        <div class="col-10">
                                            <input type="file" name="images[]" multiple id="ssi-upload5" class="upload5"/>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Images with Tour</label>
                                        <div class="col-10">
                                            <button id="clearBtn" type="button" class="m-b-10 ssi-button info">Clear</button>
                                        </div>
                                        
                                        <div class="col-2"></div>
                                        <div class="col-10" id="imageUpload"></div>
                                    </div>


                                    <button type="button" id="tour_button2" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                </form>




                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <footer class="footer">
                © 2017 Monster Admin by wrappixel.com
            </footer>
    </div>
            
@endcontent

@section('js-extra')
    <!-- Html5 Text Editor ============================================================== -->
    <script src="{{ asset('admin/assets/plugins/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/html5-editor/bootstrap-wysihtml5.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.textarea_editor').wysihtml5();
            $('.textarea_editor2').wysihtml5();
        });
    </script>
    <!-- ============================================================== -->

    <!-- Image cropper JavaScript -->
    <script src="{{ asset('admin/assets/plugins/cropper/cropper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/cropper/cropper-init.js') }}"></script>
    <!-- ============================================================== -->

    <!-- This page plugins ============================================================== -->
    <script src="{{ asset('admin/assets/plugins/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <!-- ============================================================== -->

    <script>

        var tour_id = "";

        $('.card-title').html('Custom create tour');

        $('.card-block').on('click', '#tour_button1', function (){
            console.log($("input[name='image']").val());
            $.ajax({
                url: "/api/store",
                method: 'POST',
                type: 'POST',
                data: { 
                    title: $("input[name='title']").val(),
                    description: $("textarea[name='description']").val(),
                    text: $("textarea[name='text']").val(),

                    image: $("input[name='image']").val(),
                    dataX: $("input[name='dataX']").val(),
                    dataY: $("input[name='dataY']").val(),
                    dataWidth: $("input[name='dataWidth']").val(),
                    dataHeight: $("input[name='dataHeight']").val(),

                    public: $("input[name='public']:checked").val(),
                    new: $("input[name='new']:checked").val(),
                    sold: $("input[name='sold']:checked").val(),
                    root: $("input[name='root']:checked").val(),
               
                    region_id: $("select[name='region_id']").val(),
                    language_id: $("select[name='language_id']").val(),
                    price_discount: $("input[name='price_discount']").val(),
                    discount: $("input[name='discount']").val(),
                    price: $("input[name='price']").val()
                }
            }).done(function (result) {

                if(result.status == 'yes') {

                    $('.form1').addClass('hide');
                    $('.form2').removeClass('hide');
                    
                    $("input[name='tour_id']").val(result.tour_id);

                    $('.card-title').html('Add to tour detailes');

                    var tour_id = $('input#tour_id').val();
                    var locale = $('input#locale').val();
                    $('#ssi-upload5').ssi_uploader({
                        url: "/api/images_upload/" + tour_id,
                        allowed: ['png', 'jpg', 'pdf', 'txt'],
                        maxFileSize: 122,//mb
                        locale: locale
                    });

                }
            });
        });


        $('.card-block').on('click', '#tour_button2', function (){
            
            var tour_id = $('#tour_id').val();
            var icons = $("select[name='icons[]']").val();

            var stan = {};
            $.each($(".custom-checkbox input:checked"), function(key, value) {
                stan[$(this).val()] = $("input#service_price[name='service_price" + $(this).val() +"']").val();
            });

            $.ajax({
                url: "/api/store2",
                method: 'POST',
                type: 'POST',
                data: { 
                    tour_id: tour_id,
                    icons: icons,
                    stan: stan
                }
            }).done(function (result) {
                console.log(result);
                if(result == 'yes') {
                    $('.form2').addClass('hide');
                    $('.card-title').html('Tour created!!!');
                }
            });
        });

    </script>
    
    <!-- Ssi Uploader ============================================================== -->
    <script src="{{ asset('admin/assets/plugins/ssi-uploader/dist/ssi-uploader/js/ssi-uploader.js') }}"></script>  
    <script>

        // Видаляєм по 1 фото
        $('#imageUpload').on('click', '.ssi-removeBtn', function (){
            var image_name = $(this).val();
            var tour_id = $('#tour_id').val();
            $.ajax({
                url: "/api/image_destroy",
                method: 'POST',
                type: 'POST',
                data: { image_name: image_name, tour_id: tour_id}
            }).done(function (result) {
                $('#imageUpload').html(result);
            });
        });

        // Видаляєм всі фото
        $('#clearBtn').on('click', function (){
            var tour_id = $('#tour_id').val();
            $.ajax({
                url: "/api/images_destroy",
                method: 'POST',
                type: 'POST',
                data: { tour_id: tour_id }
            }).done(function (result) {
                $('#imageUpload').html(result);
            });
        });
    </script>
    <!-- ============================================================== -->

    <script>
    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }



        var price_discount = $("input#price_discount").val();
        var discount = $("input#discount").val();
        $('#result').html((price_discount - (discount * price_discount / 100 )).toFixed());
        $('#price').val((price_discount - (discount * price_discount / 100 )).toFixed());

        
        $("input#price_discount").change(function(){
            price_discount = $(this).val();
            $('#result').html((price_discount - (discount * price_discount / 100 )).toFixed());
            $('#price').val((price_discount - (discount * price_discount / 100 )).toFixed());
        });

        $("input#discount").change(function(){
            discount = $(this).val();
            $('#result').html((price_discount - (discount * price_discount / 100 )).toFixed());
            $('#price').val((price_discount - (discount * price_discount / 100 )).toFixed());
        });

        $("input#price_discount").keyup(function(){
            price_discount = $(this).val();
            $('#result').html((price_discount - (discount * price_discount / 100 )).toFixed());
        });

        $("input#discount").keyup(function(){
            discount = $(this).val();
            $('#result').html((price_discount - (discount * price_discount / 100 )).toFixed());
        });
        

        $("input[name='price_discount']").TouchSpin({
            min: 0,
            max: 1000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='discount']").TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });


        $("input.service_price").TouchSpin({
            min: 0,
            max: 1000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });



    

        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();

        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
    </script>
    <!-- ============================================================== -->

        
    <!-- {{ asset('admin') }}  -->
@endsection