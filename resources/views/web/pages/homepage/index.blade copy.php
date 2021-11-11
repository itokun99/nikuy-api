@extends('web.layout.container')

@section('title')
    Homepage - Elites
@stop

@section('content')

    <link rel="stylesheet" href="/assets/css/home.css">
    <div class="container container-home">
        <!--Carousel-->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!--Carousel Indicators-->
            <ol class="carousel-indicators">
                @foreach ($slider as $key => $sliders)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                        @if ($key == 1) class="active" @endif></li>
                @endforeach
            </ol>
            <!--Carousel Banner-->
            <div class="carousel-inner">
                @foreach ($slider as $key => $sliders)
                    <div class='carousel-item @if ($key == 1) active @endif'>
                        <img class='banner-img' src='/assets/foto/slider/{{ $sliders->foto_slider }}'
                            alt="{{ $sliders->alt }}" />
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>

    </div>
    <!-- NON RESPONSIVE FREE -->
    <div class="container container-home container-card-non-res">
        <h1 class="display-heavy title-class-status">Kelas Gratis</h1>
        <div class="container-grid container-grid-free">
            <!--Pake Grid System-->
            <div class="row">
                <!-- INI UNTUK TITLE -->
                <div class="col col-title">
                    <img class="title-icon" src="/assets/img/Icon.png" alt="icon">

                    <h3 class='headline-heavy title-class title-class'>
                        KELAS 1
                    </h3>
                    <!-- INI MAU PAKE LINK ? -->
                    @if (\Auth::user())
                        <a href='/coursekelas' class='body-light title-link'>Lihat Semua ></a>
                    @else
                        <a href='#' class='body-light title-link btn-daftar-event modal-trigger-daftar'>Lihat Semua ></a>
                    @endif
                </div>

                <!-- INI UNTUK CARDNYA -->
                <div class="col col-slick">
                    <!--Nested Grid System-->
                    <div class="row row-slick slick">

                        @foreach ($kursus as $kursuss)
                            @if ($kursuss->id_paket == 5)
                                <div class='col'>
                                    <div class='card card-slick'>
                                        <img class='card-img-top' src='/assets/foto/kursus/{{ $kursuss->foto_kursus }}'
                                            alt='Image'>
                                        <div class='card-body d-flex flex-column'>
                                            <h5 class='subheader-heavy'>{{ $kursuss->nama_kursus }}</h5>
                                            @if (\Auth::user())
                                                <a href='/course/{{ $kursuss->id_kelas }}/sub/{{ $kursuss->id_kursus }}'
                                                    class='btn mt-auto btn-mulai-slick'>Mulai Kelas</a>
                                            @else
                                                <a href='#' class='btn mt-auto btn-mulai-slick modal-trigger-daftar'>Mulai
                                                    Kelas</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RESPONSIVE FREE -->
    <div class="container container-card-res">
        <div class="d-flex justify-content-between">
            <h1 class="caption-heavy title-class-status">Kelas Gratis </h1>
            <span class="lihat-semua-res"><a href="">Lihat Semua></a></span>
        </div>
        <div class="row row-cols-1">



            @foreach ($kursus as $kursuss)
                @if ($kursuss->id_paket == 5)
                    <div class='col'>
                        <div class='card card-home-res'>
                            <img src='/assets/foto/kursus/{{ $kursuss->foto_kursus }}' class='card-img-top' alt='Image'>
                            <div class='card-body'>
                                <h5 class='card-title small-heavy'>{{ $kursuss->nama_kursus }}</h5>
                                <a href='/course/{{ $kursuss->id_kelas }}/sub/{{ $kursuss->id_kursus }}'
                                    class='btn btn-pri-normal btn-mulai-res'>Mulai
                                    Kelas</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach




            <!-- <div class='col'>
                                                                                            <div class='card card-home-res'>
                                                                                                <img src='/assets/foto/kursus/20210514020325.jpg' class='card-img-top' alt='Image'>
                                                                                                <div class='card-body'>
                                                                                                    <h5 class='card-title small-heavy'>GEM 1 - Dasar Bisnis</h5>
                                                                                                    <a href='/course-detail&pl=28&k=3&p=5&pilid=1' class='btn btn-pri-normal btn-mulai-res'>Mulai
                                                                                                        Kelas</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> -->


        </div>
    </div>

    <!-- NON RESPONSIVE PREMIUM -->
    <div class="container container-home container-card-non-res">
        <h1 class="display-heavy title-class-status">Kelas Premium</h1>
        <div class="container-grid container-grid-premium">
            <!--Pake Grid System-->
            <div class="row">
                <div class="col col-title">
                    <img class="title-icon" src="/assets/img/Icon-2.png" alt="icon">

                    <h3 class='headline-heavy title-class'>
                        PREMIUM
                    </h3>
                    @if (\Auth::user())
                        <a href='/coursekelas' class='body-light title-link'>Lihat Semua ></a>
                    @else
                        <a href='#' class='body-light title-link btn-daftar-event modal-trigger-daftar'>Lihat Semua ></a>
                    @endif
                </div>
                <div class="col col-slick">
                    <!--Nested Grid System-->
                    <div class="row row-slick slick">

                        @foreach ($kursus as $kursuss)
                            @if ($kursuss->id_paket == 7)
                                <div class='col'>
                                    <div class='card card-slick'>
                                        <img class='card-img-top' src='/assets/foto/kursus/{{ $kursuss->foto_kursus }}'
                                            alt='Image'>
                                        <div class='card-body d-flex flex-column'>
                                            <h5 class='card-title'>{{ $kursuss->nama_kursus }}</h5>
                                            @if (Auth::user() && Auth::user()->id_paket == 7)
                                                <a href='/course/{{ $kursuss->id_kelas }}/sub/{{ $kursuss->id_kursus }}'
                                                    class='btn mt-auto btn-mulai-slick'>Mulai Kelas</a>
                                            @else
                                                <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox
                                                    data-src='#pesanUpgrade' href='javascript:;'>Mulai Kelas</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <!-- 

                                                                                                    <div class='col'>
                                                                                                        <div class='card card-slick'>
                                                                                                            <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103733.jpg' alt='Image'>
                                                                                                            <div class='card-body d-flex flex-column'>
                                                                                                                <h5 class='card-title'>Zoo</h5>
                                                                                                                <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                                                                                                    href='javascript:;'>Mulai Kelas</a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>


                                                                                                    <div class='col'>
                                                                                                        <div class='card card-slick'>
                                                                                                            <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103817.jpg' alt='Image'>
                                                                                                            <div class='card-body d-flex flex-column'>
                                                                                                                <h5 class='card-title'>Bisnis di Kota YU</h5>
                                                                                                                <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                                                                                                    href='javascript:;'>Mulai Kelas</a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>


                                                                                                    <div class='col'>
                                                                                                        <div class='card card-slick'>
                                                                                                            <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103748.jpg' alt='Image'>
                                                                                                            <div class='card-body d-flex flex-column'>
                                                                                                                <h5 class='card-title'>Towewew</h5>
                                                                                                                <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                                                                                                    href='javascript:;'>Mulai Kelas</a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>


                                                                                                    <div class='col'>
                                                                                                        <div class='card card-slick'>
                                                                                                            <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103801.jpg' alt='Image'>
                                                                                                            <div class='card-body d-flex flex-column'>
                                                                                                                <h5 class='card-title'>Meeting Hari Ini</h5>
                                                                                                                <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                                                                                                    href='javascript:;'>Mulai Kelas</a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div> -->

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- RESPONSIVE PREMIUM -->
    <div class="container container-card-res">
        <div class="d-flex justify-content-between">
            <h1 class="caption-heavy title-class-status">Kelas Premium</h1>
            <span class="lihat-semua-res">
                @if (\Auth::user())
                    <a href='/coursekelas'>Lihat Semua ></a>
                @else
                    <a href='#' class='btn-daftar-event modal-trigger-daftar'>Lihat Semua ></a>
                @endif
            </span>
        </div>
        <div class="row row-cols-1">

            @foreach ($kursus as $kursuss)
                @if ($kursuss->id_paket == 7)
                    <div class="col">
                        <div class="card card-home-res premium">
                            <img src="/assets/foto/kursus/{{ $kursuss->foto_kursus }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title small-heavy">{{ $kursuss->nama_kursus }}</h5>
                                <!-- <p class="card-text small-light">This is a short card.</p> -->
                                <!-- <a href="#" class="btn btn-pri-normal btn-mulai-res">Mulai Kelas</a> -->
                                @if (Auth::user() && Auth::user()->id_paket == 7)
                                    <a href='/course/{{ $kursuss->id_kelas }}/sub/{{ $kursuss->id_kursus }}'
                                        class='btn btn-pri-normal btn-mulai-res'>Mulai Kelas</a>
                                @else
                                    <a href='#' class='btn btn-pri-normal btn-mulai-res' data-fancybox
                                        data-src='#pesanUpgrade' href='javascript:;'>Mulai Kelas</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- <div class="col">
                                                                                            <div class="card card-home-res premium">
                                                                                                <img src="/assets/img/SM_01 1.png" class="card-img-top" alt="...">
                                                                                                <div class="card-body">
                                                                                                    <h5 class="card-title small-heavy">GEM 01</h5>
                                                                                                    <p class="card-text small-light">This is a short card.</p>
                                                                                                    <a href="#" class="btn btn-pri-normal btn-mulai-res">Mulai Kelas</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> -->
        </div>
    </div>


    <!--Upcoming event non responsive -->
    <div class="container container-home container-card-non-res">
        <div class="d-flex justify-content-between">
            <h1 class="display-heavy title-class-status">Event Mendatang</h1>
            <span class="body-heavy"><a id="lihatSemuaEvent" @if (Auth::user()) href="/event" @else href="#" class="btn subheader-heavy btn-login modal-trigger-login text-primary"  @endif>Lihat Semua ></a></span>
        </div>

        <div class="row row-cols-3">
            @foreach ($event as $events)
                <div class='col'>
                    <div class='card card-home-event'>
                        <img src='/assets/foto/event/{{ $events->foto_event }}' class='card-img-top' alt='...'>
                        <div class='price-event subheader-heavy'>
                            <p>Rp {{ number_format($events->harga_event, 0, ',', '.') }},-</p>
                        </div>
                        <div class='card-body d-flex flex-column'>
                            <h5 class='card-title subheader-heavy'>{{ $events->nama_event }}</h5>
                            <p class='card-text body-heavy'>{{ date('d F Y', strtotime($events->tanggal_post)) }}</p>


                            @if (\Auth::user())
                                <a href='/daftar/{{ $events->id_event }}'
                                    class='btn mt-auto btn-pri-normal btn-daftar-event'>Daftar</a>
                            @else
                                <a href='#'
                                    class='btn mt-auto btn-pri-normal btn-daftar-event modal-trigger-daftar'>Daftar</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <!--Upcoming event responsive -->
    <div class="container container-card-res">
        <div class="d-flex justify-content-between">
            <h1 class="caption-heavy title-class-status">Event Mendatang</h1>
            <span class="lihat-semua-res"><a href="/event">Lihat Semua></a></span>
        </div>
        <div class="row row-cols-1">
            @foreach ($event as $events)
                <div class='col'>
                    <div class='card card-home-res'>
                        <img src='/assets/foto/event/{{ $events->foto_event }}' class='card-img-top' alt='...'>
                        <div class='price-event-res xs-heavy'>
                            <p>Rp {{ number_format($events->harga_event, 0, ',', '.') }},-</p>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title small-heavy'>{{ $events->nama_event }}</h5>
                            <p class='card-text small-light'>{{ date('d F Y', strtotime($events->tanggal_post)) }}</p>


                            <a href='#' class='btn btn-pri-normal btn-mulai-res' data-fancybox
                                data-src='#pesanAwal'>Daftar</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>



    <div class="container container-home container-bottom-banner">
        <h1 class="display-heavy banner-title-res">LEARN HOW TO BECOME ENTREPRENEUR</h1>
        <a href="#" class="btn btn-pri-normal btn-bottom-banner subheader-heavy">Get Started</a>
    </div>

    <link rel="stylesheet" href="/assets/css/footer.css">

    <div class="container container-res container-footer">
        <div class="navfooter subheader-heavy">
            <ul>
                <li>Home</li>
                <li>Contact</li>
                <li>Privacy</li>
            </ul>
            <p class="subheader-heavy">Copyright &copy; The Entrepreneurs Society 2020</p>
        </div>
    </div>

    <link rel="stylesheet" href="/assets/css/modal-login-daftar.css">
    <style>
        #pesanAwal,
        #pesanUpgrade,
        #setujuan {
            display: none;
            width: 700px;
            background-color: black;
            color: white;
        }

        #pesanAwal img,
        #pesanUpgrade img,
        #setujuan img {
            display: block;
            margin: auto;
        }

        #pesanAwal a,
        #pesanUpgrade a,
        #setujuan a {
            width: 100%;
        }

        #setujuan {
            width: 500px;
        }

        #setujuan p {
            margin-top: 25px;
        }

    </style>

    <!-- Button trigger modal -->

    <div id="pesanAwal">

        <img src="/assets/img/Lock.png" width="25%">
        <h2 align="center">Maaf</h2>
        <p align="center">Anda harus melakukan pendaftaran terlebih dahulu...</p>

        <a href='#' id="tombolAwal" class="btn btn-warning text-white">
            <h4>Daftar</h4>
        </a>
    </div>

    <div id="pesanUpgrade">

        <img src="/assets/img/Lock.png" width="25%">
        <h2 align="center">Upgrade Status Membership</h2>
        <p align="center">Anda harus Upgrade Status terlebih dahulu...</p>

        <a href='?hal=akun-membership&tuj=profile' id="tombolUpg" class="btn btn-warning text-white">
            <h4>Upgrade</h4>
        </a>
    </div>




    <div class="modal fade" id="editUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="?hal=akun-respon&mode=edit" enctype="multipart/form-data">
                        <p>
                            <input value="" class="form-control" type="text" name="nama" placeholder="Nama Lengkap"
                                required>
                        </p>
                        <p>
                            <textarea id="my-textarea" class="form-control" name="alamat" placeholder="Alamat"
                                rows="3">Desa Konoha</textarea>
                        </p>
                        <p>
                            <input value="08989898989" class="form-control" type="number" name="nohp"
                                placeholder="No. Handphone" required>
                        </p>
                        <p>
                            <input value="jonileng@gmail.com" class="form-control" type="email" name="email"
                                placeholder="E-Mail" required>
                        </p>



                        <p>
                            <input value="123456" class="form-control tampilinPass" type="password" name="password"
                                placeholder="Password" required>
                            &nbsp;<input type="checkbox" class="tampilPassword"> <small>Tampilkan Password</small> <br>
                        </p>


                        <p>
                            <input type="submit" value="SIMPAN" class="btn btn-primary">
                        </p>
                    </form>

                </div>

            </div>
        </div>
    </div>



    <div id="setujuan">
        <h4 class="text-center">Term and Condition</h4>
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
        type specimen book.
    </div>
@endsection
