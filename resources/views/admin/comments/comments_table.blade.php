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
                                                    <option selected value="{{ $tour->id }}" >{{ $tour->name }}</option>
                                                @else
                                                    <option value="{{ $tour->id }}" >{{ $tour->name }}</option>
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