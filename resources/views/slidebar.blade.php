@php

use App\Http\Controllers\UserController;
$foto = UserController::check_foto();

@endphp

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            alert("{{ $error }}")
        </script>
    @endforeach
@endif

@if (Session::has('message'))
    <script>
        alert("{{ Session::get('message') }}")
    </script>
@endif



@if (!Auth::user())
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/header-non-login.css">

    <div class='container header-non-login'>
        <nav class='navbar navbar-expand-md navbar-custom'>
            <a href="/">
                <img class="header-logo" src='/assets/img/LogoPutih.png'>
            </a>
            <div>
                <ul class='navbar-nav ml-auto'>
                    <li class='nav-item nav-item-non-res'>
                        <a class='btn subheader-heavy btn-login modal-trigger-login' href='#'>Login</a>
                    </li>
                    <li class='nav-item nav-item-non-res'>
                        <a class='btn btn-pri-normal btn-daftar modal-trigger-daftar' href='#'>Daftar</a>
                    </li>
                    <li class='nav-item nav-item-res'>
                        <a class='btn small-light btn-pri-normal btn-login-res modal-trigger-login-res'
                            href='#'>Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
@else
    <link rel="stylesheet" href="/assets/css/header-login.css">


    <div class='container header-login'>
        <nav class='navbar navbar-expand-md navbar-custom'>
            <a href="/">
                <img class="header-logo" src="/assets/img/LogoPutih.png" alt="logo">
            </a>
            <div>
                <ul class='navbar-nav ml-auto'>
                    <li class='nav-item nav-item-non-res'>
                        <a class='btn subheader-heavy btn-login ' href="/event">Event</a>
                    </li>
                    <li class='nav-item nav-item-non-res'>
                        <a class='btn subheader-heavy btn-daftar ' href="/coursekelas">Course</a>
                    </li>
                    <li class='nav-item nav-item-non-res'>
                        <a class='btn subheader-heavy btn-daftar ' href="/forum">Forum</a>
                    </li>
                    <li class='nav-item nav-item-non-res'>
                        <a class='btn subheader-heavy btn-daftar ' href="/community">Community</a>
                    </li>
                    <li class='nav-item nav-item-non-res'>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class='dropdown-item' href='#'>Belum ada Transaksi</a>
                        </div>
                    </li>
                    <li class='nav-item nav-item-non-res'>
                        <a class="btn profile-pict" href="/user">
                            <img title=""
                                src="{{ \Auth::user()->foto != 'Kosong' ? '/uploads/photo/' . \Auth::user()->foto : '/assets/img/nofoto.png' }}" />
                        </a>
                    </li>
                    <li class='nav-item nav-item-non-res'>
                        <a class='btn subheader-heavy btn-daftar ' href="javascript:void"
                            onclick="$('#logout-form').submit();">Logout</a>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <li class='nav-item nav-item-res'>
                        <a class="btn profile-pict" href="/user">
                            <img title=""
                                src="{{ \Auth::user()->foto != 'Kosong' ? '/uploads/photo/' . \Auth::user()->foto : '/assets/img/nofoto.png' }}" />
                        </a>
                    </li>
                    <li class='nav-item nav-item-res' id="hamMenu">
                        <a class=' btn ham-menu' href='#'><img src="/assets/img/Menu.png"></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="ham-menu-modal float-right text-right">
            <a class="nav-item nav-link body-heavy" href="/">Home</a>
            <a class="nav-item nav-link body-heavy" href="#">Contact</a>
            <a class="nav-item nav-link body-heavy" href="#">Privacy</a>
            <hr>
            <a class="nav-item nav-link body-heavy" href="/event">Event</a>
            <a class="nav-item nav-link body-heavy" href="/coursekelas">Course</a>
            <a class="nav-item nav-link body-heavy" href="/forum">Forum</a>
            <a class="nav-item nav-link body-heavy" href="/community">Community</a>
            <a class="nav-item nav-link body-heavy" href="/user">Profile</a>
            <a class="nav-item nav-link body-heavy" href="/transaksi">Transaksi</a>
            <a class="nav-item nav-link body-heavy" href="/membership">Membership</a>
            <hr>
            <a class="nav-item nav-link body-heavy" href="javascript:void"
                onclick="$('#logout-form').submit();">Logout</a>
        </div>

    </div>



    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script>
        $('.ham-menu-modal').hide();
        $('#hamMenu').on('click', function(e) {
            $(".ham-menu-modal").toggle();
        });
    </script>
@endif
