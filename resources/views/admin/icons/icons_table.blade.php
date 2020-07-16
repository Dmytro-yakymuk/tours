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