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