
    @if(session('status'))
        <div class="box success-box" >
            <p style="color: green">{{ session('status') }}</p>
        </div>
    @endif