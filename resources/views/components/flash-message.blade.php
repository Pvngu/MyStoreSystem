@if(session()->has('message'))
    <div class="message">
        <p>
            {{session('message')}}
        </p>
    </div>
@endif