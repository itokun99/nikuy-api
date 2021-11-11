@extends('web.layout.container')


@section('content')


    <link rel="stylesheet" href="/assets/css/event.css">
    @include('slidebar')




    <div class="container container-event">
        <img class="top-banner" src="/assets/foto/Info-20210314114551.jpg" />
    </div>

    <!-- EVENT NON RESPONSIVE -->
    <div class="container container-card-non-res">
        <h1 class="display-heavy status-title">Semua Events</h1>

        <div class="row row-cols-3">
            @foreach ($pagination as $events)
                <div class='col'>
                    <div class='card h-500 card-event'>
                        <img class='card-img-top' src='/assets/foto/event/{{ $events->foto_event }}' alt='test'
                            width='100%'>
                        <div class='price-tag'>
                            <p>Rp {{ number_format($events->harga_event, 0, ',', '.') }},-</p>
                        </div>
                        <div class='card-body d-flex flex-column'>
                            <h5 class='title-heavy'>{{ $events->nama_event }}</h5>
                            <p class='body-light'>{{ date('d F Y', strtotime($events->tanggal_post)) }}</p>

                            <a href='/daftar/{{ $events->id_event }}' class='btn mt-auto btn-daftar-event'>Daftar</a>
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
                    <h4 class='alert-heading'>Belum Ada Event</h4>
                </center>
            </div>
        @endif

    </div>

    </div>

    <!-- EVENT RESPONSIVE -->

    <div class="container container-card-res">
        <div class="d-flex justify-content-between">
            <h1 class="caption-heavy title-class-status">Event Mendatang</h1>
        </div>
        <div class="row row-cols-1">
            @foreach ($pagination as $events)
                <div class='col'>
                    <div class='card card-event-res'>
                        <img src='/assets/foto/event/{{ $events->foto_event }}' class='card-img-top' alt='...'>
                        <div class='price-event-res xs-heavy'>
                            Rp {{ number_format($events->harga_event, 0, ',', '.') }},-
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title small-heavy'>{{ $events->nama_event }}</h5>
                            <p class='card-text small-light'>{{ date('d F Y', strtotime($events->waktu)) }}</p>

                            <a href='/daftar/{{ $events->id_event }}' class='btn btn-pri-normal btn-mulai-res'>Daftar</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        @if (count($pagination) == 0)
            <br><br><br>
            <div class='alert alert-primary marjin-atas-50' role='alert'>
                <center>
                    <h4 class='alert-heading'>Belum Ada Event</h4>
                </center>
            </div>
        @endif

    </div>

    <div class="container page">
        {{ $pagination->links() }}
        <!-- <div class="pagination">
                        <a class="disabled" href="#">&lt;&lt;</a>
                        <a class="disabled" href="#">&lt;</a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">&gt;</a>
                        <a href="#">&gt;&gt;</a>
                    </div> -->
        <!-- LINK FIRST AND PREV -->

        <!-- <a href='?hal=event&page=1'>&lt;&lt;</a>
                        <a href='?hal=event&page=1'>&lt;</a>
                        <a href='?hal=event&page=1' class="active">1</a>
                        <a href='?hal=event&page=2'>2</a>
                        <a href='?hal=event&page=2'>&gt;</a>
                        <a href='?hal=event&page=2'>&gt;&gt;</a> -->
        <!--<a href="#">&gt;</a>
                                <a href="#">&gt;&gt;</a>-->
    </div>
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

        <center>
            <h4>Term and Condition</h4>
        </center>



        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
        type specimen book.
    </div>
@endsection
