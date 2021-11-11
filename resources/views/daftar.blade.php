@extends('web.layout.container')

@section('content')


    <link rel="stylesheet" href="/assets/css/event.css">
    <link rel="stylesheet" href="/assets/css/register.css">
    <link rel="stylesheet" href="/assets/css/payment.css">


    @include('slidebar')



    <section id="banner">
        <div class="container">
            <img class="top-banner" src="/assets/foto/Info-20210314114551.jpg" />
        </div>
    </section>

    <section id="registration">

        <div class="container container-registration">

            <div class="registration-form-outer">
                <div class="registration-form-inner">

                    <div class="content">
                        <div class="title-event">
                            <h2>{{ $event->nama_event }}</h2>
                            <h4>{{ date('d F Y', strtotime($event->waktu)) }}</h4>
                        </div>
                        <img class="img-fluid" src="/assets/foto/event/{{ $event->foto_event }}" alt="">

                        <div class="deskripsi">
                            <h4>Deskripsi</h4>
                            {!! $event->deskripsi !!}



                            <!-- <p>Waktunya :<br />
                                                    Senin, 12 april 2021<br />
                                                    Pkl 19.00 WIB - 21.00</p>
                                            </p> -->
                        </div>

                        <div class="details">
                            <div class="category">
                                <h5>Lokasi</h5>
                                <div class="detail-info">{{ $event->lokasi }}</div>
                            </div>

                            <div class="category">
                                <h5>Venue</h5>
                                <div class="detail-info">{{ $event->venue }}</div>
                            </div>

                            <div class="category">
                                <h5>Waktu Pelaksanaan</h5>
                                <div class="detail-info">{{ $event->waktu }}</div>
                            </div>

                            <div class="category">
                                <h5>Kuota Peserta</h5>
                                <div class="detail-info">{{ $event->kuota }} Orang</div>
                            </div>

                            <div class="category">
                                <h5>Biaya</h5>
                                <div class="detail-info">Rp. {{ number_format($event->harga_event, 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="share-banner">
                        <div class="separate part3">

                            <a href="/event/daftar/{{ $event->id_event }}" class="btn">
                                DAFTAR EVENT
                            </a>
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

        <a href='?hal=akun-membership&tuj=profile' id="tombolUpg" class="btn btn-warning text-white">
            <h4>Upgrade</h4>
        </a>
    </div>


    <div id="setujuan">

        <center>
            <h4>Term and Condition</h4>
        </center>



        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
        a type specimen book.
    </div>

    <script>
        $(document).ready(function() {

            //$(selector).slideDown();

        });
    </script>

@endsection
