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