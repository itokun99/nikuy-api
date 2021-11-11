@if (Auth::check())

    @php
        $foto = Auth::user()->foto ? '/uploads/photo/' . Auth::user()->foto : '/assets/img/nofoto.png';
    @endphp

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
                            <img title="{{ Auth::user()->nama_user }}" src="{{ $foto }}" />
                        </a>
                    </li>
                    <li class='nav-item nav-item-non-res'>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                            <button type="submit" class='btn subheader-heavy btn-daftar'>Logout</button>
                        </form>
                    </li>
                    <li class='nav-item nav-item-res' id="hamMenu">
                        <a class=' btn ham-menu' href='#'><img src="/assets/img/Menu.png"></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
@else
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
@endif
