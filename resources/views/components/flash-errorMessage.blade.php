@if(session()->has('message'))
<div x-data="{ show: true}" x-init="setTimeout( () => show = false, 3000)" x-show="show" class="successMessage">
    <audio id="successSound" autoplay>
        <source src="{{asset('sounds\success_sound.mp3')}}" type="audio/mp3">
    </audio>
    <i class='bx bx-check'></i>
    <p>
        <span class="bold">Error: </span>{{session('message')}}
    </p>
    <i x-on:click="show = false" class='bx bx-x'></i>
</div>
<script>
    var audio = document.getElementById('successSound');
    audio.volume = 0.4;
</script>
@endif