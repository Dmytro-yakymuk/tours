@forelse($comment_pluses as $key => $comment_plus)
    <tr>
        <td>{{ ($key+1) }}</td>
        <td>
            <a>{{ $comment_plus->name }}</a>
        </td>
        <td>
            <a>{{ $comment_plus->position }}</a>
        </td>
        <td>
            <input type="checkbox" value="{{ $comment_plus->id }}" id="public" {{ $comment_plus->public ? 'checked' : '' }}  class="js-switch" data-color="#009efb">
        </td>
        <td>
            <a>{{ $comment_plus->language_id }}</a>
        </td>

        <td class="text-nowrap">

            <a data-toggle="modal" data-target="#edit-comment_plus{{ ($key+1) }}" onclick="view_comment_plus_plus({{ $comment_plus->id }})" data-original-title="Edit"> 
                <i class="fa fa-pencil text-inverse m-r-10 m-l-10"></i>
            </a>
            
            <a data-toggle="tooltip" data-original-title="Delete">
                <form method="POST">
                    @csrf
                    <button class='btn btn-french-5 m-t-5'value="{{ $comment_plus->id }}" id="comment_plus_delete" type="button">
                        <i class="fa fa-close text-danger"></i>
                    </button>
                </form>
            </a>
        </td>
            
        <div id="edit-comment_plus{{ ($key+1) }}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Update comment_plus</h4> </div>
                    <div class="modal-body">

                        @can('update', $comment_plus)
                            <p style="color: green">Є права на редагування!!!</p> 
                        @else
                            <p style="color: red">Немає прав на редагування!!!</p>
                        @endcan
                        
                        <form class="form-horizontal form-material" method="POST">
                            @csrf
                            
                            <div class="form-group">

                                <div class="col-md-12 m-b-20">
                                    <input type="text" class="form-control" value="{{ $comment_plus->name }}" name="name_up{{ $comment_plus->id }}" placeholder="Name"> 
                                </div>

                                <div class="col-md-12 m-b-20">
                                    <label class="col-form-label m-r-20">Position</label>
                                    <input name="position_up{{ $comment_plus->id }}" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $comment_plus->position ? 'checked' : '' }}>
                                </div>

                                <div class="col-md-12 m-b-20">
                                    <label class="col-form-label m-r-20">Public</label>
                                    <input name="public_up{{ $comment_plus->id }}" type="checkbox" placeholder="Public" class="js-switch" data-color="#009efb" {{ $comment_plus->public ? 'checked' : '' }}>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Language</label>
                                    <div class="col-10">
                                        <select class="selectpicker" name="language_id_up{{ $comment_plus->id }}"  data-style="form-control btn-secondary">

                                            @forelse($languages as $language)
                                                @if($language->id == $comment_plus->language_id)
                                                    <option selected value="{{ $language->id }}" >{{ $language->name }}</option>
                                                @else
                                                    <option value="{{ $language->id }}" >{{ $language->name }}</option>
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
                        <button type="button" onclick="update_comment_plus({{ $comment_plus->id }})" id="comment_plus_update" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </tr>
@empty

@endforelse