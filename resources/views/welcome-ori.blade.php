@extends('web.layout.container')

@section('content')



    <!-- Navigation -->
    @include('slidebar')

    <!-- Modal -->


    <div class="modal fade" id="Setujuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Term and Condition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">



                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book.

                </div>

            </div>
        </div>
    </div>
    <section id="banner">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class='carousel-indicators'>
                    @foreach ($slider as $key => $sliders)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key - 1 }}" @if ($key == 0) class="active"
                    @endif></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($slider as $key => $sliders)
                        <div class='carousel-item @if ($key == 1) active @endif'>
                            <img src='/assets/foto/slider/{{ $sliders->foto_slider }}' alt="{{ $sliders->alt }}" />
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
                        <a href='#' data-toggle='modal' class='title-link modal-trigger-daftar'>Lihat Semua ></a>
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
                                        <a href='#' class='btn' data-fancybox data-src='#pesanAwal'
                                            href='javascript:;'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets//foto/kursus/kursus-20210314103615.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>GEM 1 - Dasar Bisnis</h5>
                                        <a href='#' class='btn' data-fancybox data-src='#pesanAwal'
                                            href='javascript:;'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets//foto/kursus/kursus-20210314103631.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>GEM 2 - Bisnis Berkembang</h5>
                                        <a href='#' class='btn' data-fancybox data-src='#pesanAwal'
                                            href='javascript:;'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets//foto/kursus/kursus-20210314103647.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>GEM 3 - Visi Misi Bisnis</h5>
                                        <a href='#' class='btn' data-fancybox data-src='#pesanAwal'
                                            href='javascript:;'>Mulai Kelas</a>
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
                        <img class="title-icon" src="/assets//img/Icon-2.png" alt="icon">

                        <h3 class='title-class'>
                            PREMIUM
                        </h3>
                        <a href='#' data-toggle='modal' class='title-link modal-trigger-daftar'>Lihat Semua ></a>
                    </div>
                    <div class="col col-slick">
                        <!--Nested Grid System-->
                        <div class="row row-slick slick">

                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets//foto/kursus/kursus-20210314103719.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>GEM 4 - Yoyoyo</h5>
                                        <a href='#' class='btn' data-fancybox data-src='#pesanAwal'
                                            href='javascript:;'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets//foto/kursus/kursus-20210314103733.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Zoo</h5>
                                        <a href='#' class='btn' data-fancybox data-src='#pesanAwal'
                                            href='javascript:;'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets//foto/kursus/kursus-20210314103748.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Towewew</h5>
                                        <a href='#' class='btn' data-fancybox data-src='#pesanAwal'
                                            href='javascript:;'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets//foto/kursus/kursus-20210314103801.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Meeting Hari Ini</h5>
                                        <a href='#' class='btn' data-fancybox data-src='#pesanAwal'
                                            href='javascript:;'>Mulai Kelas</a>
                                    </div>
                                </div>
                            </div>


                            <div class='col'>
                                <div class='card'>
                                    <img class='card-img-top' src='/assets//foto/kursus/kursus-20210314103817.jpg'
                                        alt='Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Bisnis di Kota YU</h5>
                                        <a href='#' class='btn' data-fancybox data-src='#pesanAwal'
                                            href='javascript:;'>Mulai Kelas</a>
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
            <h1 class="title-status">Event Mendatang<span class="event-link">
                    <a href="?hal=event">Lihat Semua ></a></span>
            </h1>
            <div class="card-deck event row row-cols-3">

                @foreach ($event as $events)

                    <div class='card col-md-4'>
                        <div class='inner-card'>
                            <img src='/assets/foto/event/{{ $events->foto_event }}' class='card-img-top' alt='...'>
                            <div class='price-tag'>
                                <p>Rp {{ number_format($events->harga_event, 0, ',', '.') }},-</p>
                            </div>
                            <div class='card-body'>
                                <h5 class='card-title'>{{ $events->nama_event }}</h5>
                                <p class='card-text hari'>{{ date('d F Y', strtotime($events->tanggal_post)) }}</p>


                                <a href='/daftar/{{ $events->id_event }}'
                                    class='btn modal-trigger-btn modal-trigger-daftar'>Daftar</a>
                            </div>
                        </div>
                    </div>
                @endforeach

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
    <style>
        #pesanAwal,
        #pesanUpgrade {
            display: none;
            width: 700px;
            background-color: black;
            color: white;
        }

        #pesanAwal img,
        #pesanUpgrade img {
            display: block;
            margin: auto;
        }

        #pesanAwal a,
        #pesanUpgrade a {
            width: 100%;
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
                            <input value="<br />
                <b>Notice</b>:  Undefined variable: namauser in <b>C:\baruXampp\htdocs\elites\fungsional\data\modal.php</b> on line <b>58</b><br />
                " class="form-control" type="text" name="nama" placeholder="Nama Lengkap" required>
                        </p>
                        <p>
                            <textarea id="my-textarea" class="form-control" name="alamat" placeholder="Alamat" rows="3"><br />
                <b>Notice</b>:  Undefined variable: alamat in <b>C:\baruXampp\htdocs\elites\fungsional\data\modal.php</b> on line <b>61</b><br />
                </textarea>
                        </p>
                        <p>
                            <input value="<br />
                <b>Notice</b>:  Undefined variable: nohp in <b>C:\baruXampp\htdocs\elites\fungsional\data\modal.php</b> on line <b>64</b><br />
                " class="form-control" type="number" name="nohp" placeholder="No. Handphone" required>
                        </p>
                        <p>
                            <input value="<br />
                <b>Notice</b>:  Undefined variable: email in <b>C:\baruXampp\htdocs\elites\fungsional\data\modal.php</b> on line <b>67</b><br />
                " class="form-control" type="email" name="email" placeholder="E-Mail" required>
                        </p>



                        <p>
                            <input value="<br />
                <b>Notice</b>:  Undefined variable: passw in <b>C:\baruXampp\htdocs\elites\fungsional\data\modal.php</b> on line <b>73</b><br />
                " class="form-control tampilinPass" type="password" name="password" placeholder="Password" required>
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

    <div class="modal modal-daftar">
        <div class="row">
            <div class="col col-gambar">
                <img src="/assets/img/Side_Logo.png" alt="">
            </div>
            <div class="col col-login">
                <div class="container-form">
                    <img class="close close-login" src="/assets/img/Cancel_Icon.png" alt="">
                    <h1>SELAMAT DATANG DI<span>TE SOCIETY</span></h1>
                    <p>Daftar Akun Elites Kamu!</p>

                    <form action="/register" method="post">
                        @csrf
                        <label class="nama" for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="text-input"
                            placeholder="Masukan nama lengkap anda" required>

                        <label class="alamat" for="alamat">Alamat Lengkap</label>
                        <textarea class="text-input input-alamat" name="alamat" id="alamat" required></textarea>

                        <label class="gender" for="gender">Provinsi</label>
                        <select class="text-input" name="provinsi" required>
                            <option selected="true" disabled="disabled">Pilih</option>
                            @foreach ($provinsi as $province)
                                <option value="{{ $province->nama_provinsi }}">{{ $province->nama_provinsi }}</option>
                            @endforeach
                        </select>

                        <label class="tgl-lahir" for="tgl-lahir">Tanggal Lahir</label>
                        <input type="date" name="tglahir" id="tgl-lahir" class="text-input" required>

                        <label class="gender" for="gender">Jenis Kelamin</label>
                        <select class="text-input" id="gender" name="jekel" required>
                            <option selected="true" disabled="disabled">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>

                        <label class="no-hp" for="no-hp">Nomor Handphone</label>
                        <input type="number" name="nohp" id="no-hp" class="text-input"
                            placeholder="Tuliskan nomor handphone aktif anda" required>

                        <label class="email" for="email">E-mail</label>
                        <input type="email" name="email" id="no-hp" class="text-input" placeholder="Masukkan E-mail"
                            required>

                        <label class="pass" for="pass">Kata Sandi</label>
                        <input type="password" name="password" id="pass" class="text-input tampilinPass"
                            style="margin-bottom: 5px;" placeholder="Masukan kata sandi yang terdaftar" required>

                        &nbsp;<input type="checkbox" class="tampilPassword"> <small style="color: black;">Tampilkan
                            Password</small> <br>
                        <small class="text-danger passTaksama">Password yang diketikkan tidak sama</small>

                        <label class="pass" for="pass-conf">Konfirmasi Kata Sandi</label>
                        <input type="password" name="pass-conf" id="pass2" class="text-input"
                            placeholder="Tuliskan ulang kata sandi yang terdaftar" required>
                        <small class="text-danger passTaksama">Password yang diketikkan tidak sama</small>

                        <input type="checkbox" name="setujuan" id="tc" required>
                        <label class="tc" for="tc">Saya telah membaca dan menyetujui<span><a data-toggle="modal"
                                    data-target="#Setujuan" href="#">Syarat dan
                                    Ketentuan</a></span></label>
                        <button type="submit" class="btn">Daftar</button>
                    </form>


                    <p>Sudah punya akun Elites?<span><a class="modal-trigger-login" href="#">Login</a></span></p>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL-->
    <div class="modal modal-login">
        <div class="row">
            <div class="col col-gambar">
                <img src="/assets/img/Side_Logo.png" alt="">
            </div>
            <div class="col col-login">
                <div class="container-form">
                    <img class="close close-login" src="/assets/img/Cancel_Icon.png" alt="">
                    <h1>SELAMAT DATANG DI<span>TE SOCIETY</span></h1>
                    <p>Masuk ke Akun Elites Kamu!</p>

                    <form action="/login" method="post">
                        @csrf
                        <label class="email" for="email">Alamat Email</label>
                        <input type="email" name="email" id="email" class="text-input"
                            placeholder="Masukan alamat email yang terdaftar">
                        <label class="pass" for="pass">Kata Sandi</label>
                        <input type="password" name="password" id="pass" class="text-input"
                            placeholder="Masukan kata sandi yang terdaftar">

                        <button type="submit" class="btn">Login</button>
                        <p>Belum punya akun Elites?<span><a class="modal-trigger-daftar" href="#">Daftar</a></span></p>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            <
            br / >
                <
                b > Notice < /b>:  Undefined variable: pilarKelas in <b>C:\baruXampp\htdocs\elites\index.php</b >
                on line < b > 65 < /b><br / >

        });
    </script>

@endsection
