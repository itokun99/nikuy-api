@extends('web.layout.container')

@section('content')






    <link rel="stylesheet" href="/assets/css/home.css">

    @include('slidebar')

    <div class="container container-home">
        <!--Carousel-->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!--Carousel Indicators-->
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <!--Carousel Banner-->
            <div class="carousel-inner">

                <div class='carousel-item active'>
                    <img class='banner-img' src='./foto/slider/slider-20210314124201.jpg' />
                </div>


                <div class='carousel-item '>
                    <img class='banner-img' src='./foto/slider/slider-20210314124213.jpg' />
                </div>


                <div class='carousel-item '>
                    <img class='banner-img' src='./foto/slider/slider-20210331112639.jpg' />
                </div>


                <div class='carousel-item '>
                    <img class='banner-img' src='./foto/slider/20210516091641.jpg' />
                </div>

            </div>
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
                    <img class="title-icon" src="./img/Icon.png" alt="icon">

                    <h3 class='headline-heavy title-class title-class'>
                        KELAS 1
                    </h3>
                    <!-- INI MAU PAKE LINK ? -->
                    <a href='?hal=course' class='body-light title-link'>Lihat Semua ></a>
                </div>

                <!-- INI UNTUK CARDNYA -->
                <div class="col col-slick">
                    <!--Nested Grid System-->
                    <div class="row row-slick slick">

                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/kursus-20210314103700.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='subheader-heavy'>Belajar Sukses</h5>
                                    <a href='?hal=course-detail&pl=32&k=3&p=5&pilid=2'
                                        class='btn mt-auto btn-mulai-slick'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>


                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/20210514020325.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='subheader-heavy'>GEM 1 - Dasar Bisnis</h5>
                                    <a href='?hal=course-detail&pl=28&k=3&p=5&pilid=1'
                                        class='btn mt-auto btn-mulai-slick'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>


                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/kursus-20210314103631.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='subheader-heavy'>GEM 2 - Bisnis Berkembang</h5>
                                    <a href='?hal=course-detail&pl=29&k=3&p=5&pilid=1'
                                        class='btn mt-auto btn-mulai-slick'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>


                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/kursus-20210314103647.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='subheader-heavy'>GEM 3 - Visi Misi Bisnis</h5>
                                    <a href='?hal=course-detail&pl=30&k=3&p=5&pilid=1'
                                        class='btn mt-auto btn-mulai-slick'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>


                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/20210529042142.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='subheader-heavy'>testa</h5>
                                    <a href='?hal=course-detail&pl=39&k=3&p=5&pilid=1'
                                        class='btn mt-auto btn-mulai-slick'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>


                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/20210514055544.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='subheader-heavy'>tests</h5>
                                    <a href='?hal=course-detail&pl=38&k=4&p=5&pilid=4'
                                        class='btn mt-auto btn-mulai-slick'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>

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




            <div class='col'>
                <div class='card card-home-res'>
                    <img src='./foto/kursus/kursus-20210314103700.jpg' class='card-img-top' alt='Image'>
                    <div class='card-body'>
                        <h5 class='card-title small-heavy'>Belajar Sukses</h5>
                        <a href='?hal=course-detail&pl=32&k=3&p=5&pilid=2' class='btn btn-pri-normal btn-mulai-res'>Mulai
                            Kelas</a>
                    </div>
                </div>
            </div>



            <div class='col'>
                <div class='card card-home-res'>
                    <img src='./foto/kursus/20210514020325.jpg' class='card-img-top' alt='Image'>
                    <div class='card-body'>
                        <h5 class='card-title small-heavy'>GEM 1 - Dasar Bisnis</h5>
                        <a href='?hal=course-detail&pl=28&k=3&p=5&pilid=1' class='btn btn-pri-normal btn-mulai-res'>Mulai
                            Kelas</a>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- NON RESPONSIVE PREMIUM -->
    <div class="container container-home container-card-non-res">
        <h1 class="display-heavy title-class-status">Kelas Premium</h1>
        <div class="container-grid container-grid-premium">
            <!--Pake Grid System-->
            <div class="row">
                <div class="col col-title">
                    <img class="title-icon" src="./img/Icon-2.png" alt="icon">

                    <h3 class='headline-heavy title-class'>
                        PREMIUM
                    </h3>
                    <a href='?hal=course' class='body-light title-link'>Lihat Semua ></a>
                </div>
                <div class="col col-slick">
                    <!--Nested Grid System-->
                    <div class="row row-slick slick">

                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/kursus-20210314103719.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='card-title'>GEM 4 - Yoyoyo</h5>
                                    <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                        href='javascript:;'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>


                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/kursus-20210314103733.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='card-title'>Zoo</h5>
                                    <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                        href='javascript:;'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>


                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/kursus-20210314103817.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='card-title'>Bisnis di Kota YU</h5>
                                    <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                        href='javascript:;'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>


                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/kursus-20210314103748.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='card-title'>Towewew</h5>
                                    <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                        href='javascript:;'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>


                        <div class='col'>
                            <div class='card card-slick'>
                                <img class='card-img-top' src='./foto/kursus/kursus-20210314103801.jpg' alt='Image'>
                                <div class='card-body d-flex flex-column'>
                                    <h5 class='card-title'>Meeting Hari Ini</h5>
                                    <a href='#' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                        href='javascript:;'>Mulai Kelas</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- RESPONSIVE PREMIUM -->
    <div class="container container-card-res">
        <div class="d-flex justify-content-between">
            <h1 class="caption-heavy title-class-status">Kelas Premium</h1>
            <span class="lihat-semua-res"><a href="">Lihat Semua></a></span>
        </div>
        <div class="row row-cols-1">
            <div class="col">
                <div class="card card-home-res premium">
                    <img src="./img/SM_01 1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title small-heavy">GEM 00</h5>
                        <p class="card-text small-light">This is a short card.</p>
                        <a href="#" class="btn btn-pri-normal btn-mulai-res">Mulai Kelas</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-home-res premium">
                    <img src="./img/SM_01 1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title small-heavy">GEM 01</h5>
                        <p class="card-text small-light">This is a short card.</p>
                        <a href="#" class="btn btn-pri-normal btn-mulai-res">Mulai Kelas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Upcoming event non responsive -->
    <div class="container container-home container-card-non-res">
        <div class="d-flex justify-content-between">
            <h1 class="display-heavy title-class-status">Event Mendatang</h1>
            <span class="body-heavy"><a id="lihatSemuaEvent" href="?hal=event">Lihat Semua ></a></span>
        </div>

        <div class="row row-cols-3">

            <div class='col'>
                <div class='card card-home-event'>
                    <img src='foto/event/QW6jLq.jpg' class='card-img-top' alt='...'>
                    <div class='price-event subheader-heavy'>
                        Rp. 1.000,00
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h5 class='card-title subheader-heavy'>test</h5>
                        <p class='card-text body-heavy'>16 May 2021</p>


                        <a href='?hal=event-info&k=17' class='btn mt-auto btn-pri-normal btn-daftar-event'>Daftar</a>
                    </div>
                </div>
            </div>


            <div class='col'>
                <div class='card card-home-event'>
                    <img src='foto/event/Event-20210314115254.jpg' class='card-img-top' alt='...'>
                    <div class='price-event subheader-heavy'>
                        Rp. 100.000,00
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h5 class='card-title subheader-heavy'>Event Baru</h5>
                        <p class='card-text body-heavy'>16 May 2021</p>


                        <a href='?hal=event-info&k=16' class='btn mt-auto btn-pri-normal btn-daftar-event'>Daftar</a>
                    </div>
                </div>
            </div>


            <div class='col'>
                <div class='card card-home-event'>
                    <img src='foto/event/Event-20210314115310.jpg' class='card-img-top' alt='...'>
                    <div class='price-event subheader-heavy'>
                        Rp. 250.000,00
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h5 class='card-title subheader-heavy'>Testingan</h5>
                        <p class='card-text body-heavy'>01 February 2021</p>


                        <a href='?hal=event-info&k=15' class='btn mt-auto btn-pri-normal btn-daftar-event'>Daftar</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--Upcoming event responsive -->
    <div class="container container-card-res">
        <div class="d-flex justify-content-between">
            <h1 class="caption-heavy title-class-status">Event Mendatang</h1>
            <span class="lihat-semua-res"><a href="">Lihat Semua></a></span>
        </div>
        <div class="row row-cols-1">

            <div class='col'>
                <div class='card card-home-res'>
                    <img src='foto/event/QW6jLq.jpg' class='card-img-top' alt='...'>
                    <div class='price-event-res xs-heavy'>
                        Rp. 1.000,00
                    </div>
                    <div class='card-body'>
                        <h5 class='card-title small-heavy'>test</h5>
                        <p class='card-text small-light'>16 May 2021</p>


                        <a href='?hal=event-info&k=17' class='btn btn-pri-normal btn-mulai-res'>Daftar</a>
                    </div>
                </div>
            </div>


            <div class='col'>
                <div class='card card-home-res'>
                    <img src='foto/event/Event-20210314115254.jpg' class='card-img-top' alt='...'>
                    <div class='price-event-res xs-heavy'>
                        Rp. 100.000,00
                    </div>
                    <div class='card-body'>
                        <h5 class='card-title small-heavy'>Event Baru</h5>
                        <p class='card-text small-light'>16 May 2021</p>


                        <a href='?hal=event-info&k=16' class='btn btn-pri-normal btn-mulai-res'>Daftar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container container-home container-bottom-banner">
        <h1 class="display-heavy banner-title-res">LEARN HOW TO BECOME ENTREPRENEUR</h1>
        <a href="#" class="btn btn-pri-normal btn-bottom-banner subheader-heavy">Get Started</a>
    </div>

    <link rel="stylesheet" href="./css/footer.css">

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

    <link rel="stylesheet" href="./css/modal-login-daftar.css">
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

        <img src="./img/Lock.png" width="25%">
        <h2 align="center">Maaf</h2>
        <p align="center">Anda harus melakukan pendaftaran terlebih dahulu...</p>

        <a href='#' id="tombolAwal" class="btn btn-warning text-white">
            <h4>Daftar</h4>
        </a>
    </div>

    <div id="pesanUpgrade">

        <img src="./img/Lock.png" width="25%">
        <h2 align="center">Upgrade Status Membership</h2>
        <p align="center">Anda harus Upgrade Status terlebih dahulu...</p>

        <a href='/membership' id="tombolUpg" class="btn btn-warning text-white">
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

        <center>
            <h4>Term and Condition</h4>
        </center>



        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
        type specimen book.
    </div>
@endsection
