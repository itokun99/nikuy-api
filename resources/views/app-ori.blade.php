@extends('web.layout.container')

@section('content')


    @include('slidebar')


    <section id="banner">
        <div class="container">

            <!--Carousel-->

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                <!--Carousel Indicators-->

                <ol class='carousel-indicators'>
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                    </li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                </ol>

                <!--Carousel Banner-->

                <div class="carousel-inner">

                    <div class='carousel-item active'>
                        <img src='/assets/foto/slider/slider-20210314124201.jpg' />
                    </div>


                    <div class='carousel-item '>
                        <img src='/assets/foto/slider/slider-20210314124213.jpg' />
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section id="content">
        <div class="container">
            <h1 class="title-status">Kelas Gratis</h1>
            <div class="container-grid container-grid-free">
                <!--Pake Grid System-->
                <div class="row">
                    <!-- INI UNTUK TITLE -->
                    <div class="col col-title">
                        <img class="title-icon" src="/assets/img/Icon.png" alt="icon">

                        <h3 class='title-class'>
                            KELAS 1
                        </h3>
                        <!-- INI MAU PAKE LINK ? -->
                        <a href='course' class='title-link'>Lihat Semua ></a>
                    </div>

                    <!-- INI UNTUK CARDNYA -->
                    <div class="col col-slick">
                        <!--Nested Grid System-->
                        <div class="row row-slick slick">

                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103700.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Belajar Sukses</h5>
                                        <a href='kelas' class='btn'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103615.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>GEM 1 - Dasar Bisnis</h5>
                                        <a href='kelas' class='btn'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103631.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>GEM 2 - Bisnis Berkembang</h5>
                                        <a href='kelas' class='btn'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103647.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>GEM 3 - Visi Misi Bisnis</h5>
                                        <a href='kelas' class='btn'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h1 class="title-status">Kelas Premium</h1>
            <div class="container-grid container-grid-premium">
                <!--Pake Grid System-->
                <div class="row">
                    <div class="col col-title">
                        <img class="title-icon" src="/assets/img/Icon-2.png" alt="icon">

                        <h3 class='title-class'>
                            PREMIUM
                        </h3>
                        <a href='course' class='title-link'>Lihat Semua ></a>
                    </div>
                    <div class="col col-slick">
                        <!--Nested Grid System-->
                        <div class="row row-slick slick">

                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103719.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>GEM 4 - Yoyoyo</h5>
                                        <a href='kelas' class='btn'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103733.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Zoo</h5>
                                        <a href='kelas' class='btn'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103748.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Towewew</h5>
                                        <a href='kelas' class='btn'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103801.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Meeting Hari Ini</h5>
                                        <a href='kelas' class='btn'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets/foto/kursus/kursus-20210314103817.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Bisnis di Kota YU</h5>
                                        <a href='kelas' class='btn'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!--Upcoming Event-->
        <!--Ini pake Card Deck Bootstrap-->
        <div class="container">
            <h1 class="title-status">Event Mendatang<span class="event-link"><a href="?hal=event">Lihat Semua
                        ></a></span>
            </h1>
            <div class="card-deck event">


                <div class='card'>
                    <div class='inner-card'>
                        <img src='/assets/foto/event/Event-20210314115254.jpg' class='card-img-top' alt='...'>
                        <div class='price-tag'>
                            <p>Rp 100.000,-</p>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title'>Event Baru</h5>
                            <p class='card-text hari'>14 March 2021</p>


                            <a href='daftar_event' class='btn'>Daftar</a>
                        </div>
                    </div>
                </div>




                <div class='card'>
                    <div class='inner-card'>
                        <img src='/assets/foto/event/Event-20210314115310.jpg' class='card-img-top' alt='...'>
                        <div class='price-tag'>
                            <p>Rp 250.000,-</p>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title'>Testingan</h5>
                            <p class='card-text hari'>14 March 2021</p>


                            <a href='daftar_event' class='btn'>Daftar</a>
                        </div>
                    </div>
                </div>




                <div class='card'>
                    <div class='inner-card'>
                        <img src='/assets/foto/event/Event-20210314115329.jpg' class='card-img-top' alt='...'>
                        <div class='price-tag'>
                            <p>Rp 100.000,-</p>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title'>Tips Pebisnis Keren</h5>
                            <p class='card-text hari'>14 March 2021</p>


                            <a href='daftar_event' class='btn'>Daftar</a>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>


    <section id="footer">
        <div class="container container-footer">
            <div class="navfooter">
                <ul>
                    <li>Home</li>
                    <li>Contact</li>
                    <li>Privacy</li>
                </ul>
                <p class="copy">Copyright &copy; The Entrepreneurs Society 2020</p>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->






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
                            <input value="Admin" class="form-control" type="text" name="nama" placeholder="Nama Lengkap"
                                required>
                        </p>
                        <p>
                            <textarea id="my-textarea" class="form-control" name="alamat" placeholder="Alamat"
                                rows="3">Burangrang</textarea>
                        </p>
                        <p>
                            <input value="08989898989" class="form-control" type="number" name="nohp"
                                placeholder="No. Handphone" required>
                        </p>
                        <p>
                            <input value="evenan@mail.com" class="form-control" type="email" name="email"
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



@endsection
