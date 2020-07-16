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
            <img src="{{ asset('images/region/'. $region->image) }}" width="40" />
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
                    <button class='btn btn-french-5 m-t-5'value="{{ $region->id }}" id="region_delete" type="button"><i class="fa fa-close text-danger"></i></button>
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
                                    <img src="{{ asset('images/region/'. $region->image) }}" width="40" class="img-circle" />
                                    <input type="hidden" value="{{ $region->image }}" name="old_img_up{{ $region->id }}" />

                                    <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                        <span><i class="ion-upload m-r-5"></i>Upload Image</span>
                                        <input type="file" name="image_up{{ $region->id }}" class="upload"> 
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