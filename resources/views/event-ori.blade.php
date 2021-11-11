@extends('web.layout.container')

@section('content')


    <link rel="stylesheet" href="/assets/css/event.css">
    @include('slidebar')

    <section id="banner">
        <div class="container">
            <img class="top-banner" src="/assets/foto/Info-20210314114551.jpg" />
        </div>
    </section>


    <section id="all-events">
        <div class="container">
            <h1 class="status-title">Semua Events</h1>

            <div class="row row-cols-3">
                @foreach ($event as $events)
                    <div class='col'>
                        <div class='card card-all-event'>
                            <div class='inner-card'>
                                <img src='/assets/foto/event/{{ $events->foto_event }}'
                                    alt='STOP MAKING CONTENT LIKE AN AGENCY' width='100%'>
                                <div class='price-tag'>
                                    <p>Rp {{ number_format($events->harga_event, 0, ',', '.') }},-</p>
                                </div>
                                <div class='card-body'>
                                    <h5 class='card-title'>{{ $events->nama_event }}</h5>
                                    <p class='card-text hari'>{{ date('d F Y', strtotime($events->tanggal_post)) }}</p>
                                    <a href='/daftar/{{ $events->id_event }}' class='btn'>Daftar</a>
                                    <a class='details' href='/daftar/{{ $events->id_event }}'>See Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            @if (count($event) == 0)
                <br>
                <br>
                <br>
                <div class='alert alert-primary marjin-atas-50' role='alert'>
                    <center>
                        <h4 class='alert-heading'>Data Masih Kosong</h4>
                    </center>
                </div>
            @endif

        </div>


        <div class="container page">
            {{ $pagination->links() }}


            <!-- <div class="pagination">
                            <a href='?hal=event&page=1'>&lt;&lt;</a>
                            <a href='?hal=event&page=1'>&lt;</a>
                            <a href='?hal=event&page=1' class="active">1</a>
                            <a href='?hal=event&page=2'>2</a>
                            <a href='?hal=event&page=2'>&gt;</a>
                            <a href='?hal=event&page=2'>&gt;&gt;</a>
                        </div> -->




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


    <div id="setujuan">

        <center>
            <h4>Term and Condition</h4>
        </center>



        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
        type specimen book.
    </div>

    <script>
        $(document).ready(function() {

            //$(selector).slideDown();

        });
    </script>


@endsection
