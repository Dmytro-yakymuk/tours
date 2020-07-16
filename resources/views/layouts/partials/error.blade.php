@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- @if(count($errors) > 0)
      <div class="box error-box" >
          @foreach($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
          @endforeach
      </div>
    @endif -->
            
