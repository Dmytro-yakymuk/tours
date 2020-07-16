@forelse($services as $key => $service)
    <tr>
        <td>{{ ($key+1) }}</td>
        <td>
            <a>{{ $service->name }}</a>
        </td>
        <td>
            <a>{{ $service->addition }}</a>
        </td>
        <td>
            <a>{{ $service->poition }}</a>
        </td>

        <td>
            <a>{{ $service->language->name }}</a>
        </td>
        
        <td class="text-nowrap">

            <a  data-toggle="modal" data-target="#update-service{{ ($key+1) }}" data-original-title="Edit"> 
                <i class="fa fa-pencil text-inverse m-r-10 m-l-10"></i>
            </a>
            
            <a data-toggle="tooltip" data-original-title="Delete">
                <form method="POST">
                    @csrf
                    <button class='btn btn-french-5 m-t-5'value="{{ $service->id }}" id="service_delete" type="button"><i class="fa fa-close text-danger"></i></button>
                </form>
            </a>
        </td>
    
            
        <div id="update-service{{ ($key+1) }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Update Service</h4> </div>
                    <div class="modal-body">

                        @can('update', $service)
                            <p style="color: green">Є права на редагування!!!</p> 
                        @else
                            <p style="color: red">Немає прав на редагування!!!</p>
                        @endcan
                        
                        <form class="form-horizontal form-material" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <div class="col-md-12 m-b-20">
                                    <input type="text" class="form-control" value="{{ $service->name }}" name="name_up{{ $service->id }}" placeholder="Name"> 
                                </div>
                                <div class="col-md-12 m-b-20">
                                    <input type="text" class="form-control" value="{{ $service->addition }}" name="addition_up{{ $service->id }}" placeholder="Addition"> 
                                </div>

                                <div class="col-md-12 m-b-20">
                                    <label class="col-form-label m-r-20">Position</label>
                                    
                                    <select class="selectpicker" name="position_up{{ $service->id }}"  data-style="form-control btn-secondary">
                                        <option  value="{{ $service->position }}" {{ $service->position == 1 ? 'selected' : '' }}><span class="label label-danger">root</span></option>
                                        <option  value="{{ $service->position }}" {{ $service->position == 2 ? 'selected' : '' }}><span class="label label-success">hunting</span></option>
                                        <option  value="{{ $service->position }}" {{ $service->position == 3 ? 'selected' : '' }}><span class="label label-warning">drem</span></option>
                                    </select> 
                                </div>  
                            
                                <div class="col-md-12 m-b-20">
                                    <label class="col-form-label m-r-20">Public</label>
                                    <input name="public_up{{ $service->id }}" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $service->public ? 'checked' : '' }}>
                                </div>
                                <div class="col-md-12 m-b-20">
                                    <label class="col-form-label m-r-20">Languages</label>
                                    
                                    <select class="selectpicker" name="language_id_up{{ $service->id }}"  data-style="form-control btn-secondary">
                                        @forelse($languages as $language)
                                            <option  value="{{ $language->id }}" {{ $service->language_id == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                                        @empty

                                        @endforelse
                                    </select> 
                                </div>  
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="update_service({{ $service->id }})" id="specie_update" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </tr>
@empty

@endforelse