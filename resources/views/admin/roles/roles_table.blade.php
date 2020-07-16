
@forelse($roles as $key => $role)
    <tr>
        <td>{{ ($key+1) }}</td>
        <td>
            <a>{{ $role->name }}</a>
        </td>
        <td>
            <a>{{ $role->title }}</a>
        </td>
        
        <td class="text-nowrap">

            <a data-toggle="modal" data-target="#edit-role{{ ($key+1) }}" data-original-title="Edit"> 
                <i class="fa fa-pencil text-inverse m-r-10 m-l-10"></i>
            </a>
            
            <a data-toggle="tooltip" data-original-title="Delete">
                <form method="POST">
                    @csrf
                    <button class='btn btn-french-5 m-t-5'value="{{ $role->id }}" id="role_delete" type="button"><i class="fa fa-close text-danger"></i></button>
                </form>
            </a>
        </td>
                
            <div id="edit-role{{ ($key+1) }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Update Role</h4> </div>
                        <div class="modal-body">
                            <form class="form-horizontal form-material" method="POST">
                                @csrf
                                
                                <div class="form-group">
                                    <div class="col-md-12 m-b-20">
                                        <input type="text" class="form-control" value="{{ $role->name }}" name="name_up{{ $role->id }}" placeholder="Name"> 
                                    </div>
                                    <div class="col-md-12 m-b-20">
                                        <input type="text" class="form-control" value="{{ $role->title }}" name="slug_up{{ $role->id }}" placeholder="Title"> 
                                    </div>
                                   
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="update_role({{ $role->id }})" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>


            

    </tr>
@empty

@endforelse


