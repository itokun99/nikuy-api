@extends('web.layout.container')

@section('content')


    <link rel="stylesheet" href="/assets/css/course.css">
    @include('slidebar')




    <section id="banner">
        <div class="container">
            <img class="top-banner" src="/assets/foto/Info-20210314114616.jpg" />
        </div>
    </section>



    <!-- INI COURSE -->
    <section id="courses">
        @foreach ($Coursekelas as $key => $cs)
            <div class="container">
                <div class="container-card">

                    <h1 class='status-member'>{{ $key }}</h1>
                    @foreach ($cs as $Coursekelass)

                        <div class='card-course'>
                            <div class='row-1'>
                                <img src='/assets/foto/kelas/{{ $Coursekelass->foto_kelas }}'>
                                <a class='btn btn-mulai' href='/course/{{ $Coursekelass->id_kelas }}'>Mulai Kelas</a>
                            </div>
                            <div class='card-body row-2'>
                                <h2 class='card-title'> {{ $Coursekelass->nama_kelas }}</h2>
                                <p class='subcourse'>5 Pelajaran</p>
                                <h3 class='desc-course'>Description</h3>
                                <p>{!! $Coursekelass->deskripsi !!}</p>
                            </div>
                        </div>

                        <div class="locked-courses">
                            <img src="Lock.png" alt="">
                            <h3>THIS CLASS IS LOCKED FOR YOUR MEMBER LEVEL</h3>
                            <a class="btn btn-locked" href="">UPGRADE</a>
                        </div>
                    @endforeach

                </div>

            </div>
        @endforeach

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
                            <input value="omat" class="form-control" type="text" name="nama" placeholder="Nama Lengkap"
                                required>
                        </p>
                        <p>
                            <textarea id="my-textarea" class="form-control" name="alamat" placeholder="Alamat"
                                rows="3">sasasa</textarea>
                        </p>
                        <p>
                            <input value="21212" class="form-control" type="number" name="nohp"
                                placeholder="No. Handphone" required>
                        </p>
                        <p>
                            <input value="otamat@gmail.com" class="form-control" type="email" name="email"
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
