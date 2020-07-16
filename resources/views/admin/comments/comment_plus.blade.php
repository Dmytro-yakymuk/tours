


<div class="form-group row">
    <label  class="col-2 col-form-label">Comment Plus</label>
    <div class="col-10">
        
        <select class='pre-selected-options_up' name="commentpluses_true[]_up{{ $comment->id }}" multiple='multiple'>
            @forelse($commentpluses_selected_true  as $commentplus)
                <option selected value='{{ $commentplus->id }}'>
                    {{ $commentplus->name }}
                </option>
            @empty

            @endforelse

            @forelse($commentpluses_true as $commentpl)
                <option value='{{ $commentpl->id }}'>
                    {{ $commentpl->name }}
                </option>
            @empty

            @endforelse 
        </select>

    </div>
</div>

<div class="form-group row">
    <label  class="col-2 col-form-label">Comment False</label>
    <div class="col-10">
        
        <select class='pre-selected-options_up' name="commentpluses_false[]_up{{ $comment->id }}" multiple='multiple'>
            @forelse($commentpluses_selected_false  as $commentplus)
                <option selected value='{{ $commentplus->id }}'>
                    {{ $commentplus->name }}
                </option>
            @empty

            @endforelse

            @forelse($commentpluses_false as $commentpl)
                <option value='{{ $commentpl->id }}'>
                    {{ $commentpl->name }}
                </option>
            @empty

            @endforelse 
        </select>

    </div>
</div>

