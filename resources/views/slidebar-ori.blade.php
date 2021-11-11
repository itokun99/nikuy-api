@php

use App\Http\Controllers\UserController;
$foto = UserController::check_foto();

@endphp

@if($errors->any())
@foreach($errors->all() as $error)
<script>
    alert("{{$error}}")
</script>
@endforeach
@endif

@if(Session::has('message'))
<script>
    alert("{{Session::get('message')}}")

</script>
@endif

@if(!Auth::user())
<section id="navigation-bar">
    <div class="container-navbar">
        <nav class="navbar">
            <a class="logo" href="/">
                <img src="/assets/img/logoElites.png" alt="logo">
            </a>
            <div class="nav-list">
                <a class="btn btn-login modal-trigger-login" href="#">Login</a>
                <a class="btn btn-daftar modal-trigger-daftar" href="#">Daftar</a>
            </div>
        </nav>
    </div>
</section>
@else`
<section id="navigation-bar">
    <div class="container-navbar">
        <nav class="navbar">
            <a class="logo" href="/">
                <img src="/assets/img/logoElites.png" alt="logo">
            </a>
            <div class="nav-list">
                <a class="btn active " href="/event">Event</a>
                <a class="btn active " href="/coursekelas">Course</a>
                <a class="btn active " href="/forum">Forum</a>
                <a class="btn active " href="/community">Community</a>

                <a class="btn profile-pict" href="user">
                    <img title="Admin"
                        src="{{$foto == 'Kosong' ? '/assets/img/nofoto.png' : '/uploads/photo/'.$foto}}" />
                </a>

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <a class='dropdown-item' href='#'>Belum ada Transaksi</a>
                </div>

                <a href="javascript:void" class="btn logout" onclick="$('#logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <!-- <a class="btn logout" href="/">Logout</a> -->

            </div>
        </nav>
    </div>



</section>
@endif
