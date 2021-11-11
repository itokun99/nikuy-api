@extends('web.layout.container')

@section('content')


    <link rel="stylesheet" href="/assets/css/course.css">
    @include('slidebar')




    <div class="container container-course">
        <img class="top-banner" src="/assets/foto/banner-web-tes.png" />
    </div>

<!-- COURSE NON RESPONSIVE -->
<div class="container container-card-non-res">
<section id="courses">
    @foreach($coursekel_auth as $key => $cs)
        <div class="container-card">

            <!-- <h1 class='status-member'>$key</h1> -->
            <h1 class='status-member'>Daftar Kelas</h1>
            @foreach($cs as $Coursekelass)

            <div class='card-course row'>
                <div class="card-course-left col-4 d-flex d-flex flex-column justify-content-between">
                    <div class="card-course-image-wrapper">
                        <img class="w-100" src='/assets/foto/kelas/{{$Coursekelass->foto_kelas}}' >
                    </div>
                    <div class="card-course-action">
                        <a class='btn btn-mulai w-100' href='/course/{{$Coursekelass->id_kelas}}'>Mulai Kelas</a>
                    </div>
                </div>
                <div class="course-content-right col-8">
                    <div class='course-content-body'>
                        <h2 class='card-title'> {{$Coursekelass->nama_kelas}}</h2>
                        <p class='subcourse'>5 Pelajaran</p>
                        <h3 class='desc-course'>Description</h3>
                        <p class="desc-course-text">{!! $Coursekelass->deskripsi !!}</p>
                    </div>
                </div>
            </div>

            <div class="locked-courses">
                <img src="/assets/img/Lock.png" alt="">
                <h3>THIS CLASS IS LOCKED FOR YOUR MEMBER LEVEL</h3>
                <a class="btn btn-locked" href="">UPGRADE</a>
            </div>
            @endforeach

        </div>

    @endforeach

    @foreach($coursekelas as $key => $cs)
        <div class="container-card">

            @foreach($cs as $Coursekelass)

            <div class='card-course row'>
                <div class="card-course-left col-4 d-flex d-flex flex-column justify-content-between">
                    <div class="card-course-image-wrapper">
                        <img class="w-100" src='/assets/foto/kelas/{{$Coursekelass->foto_kelas}}' >
                    </div>
                    <div class="card-course-action">
                        <a class='btn btn-mulai w-100' href='/membership' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                    href='javascript:;'>Mulai Kelas</a>
                    </div>
                </div>
                <div class="course-content-right col-8">
                    <div class='course-content-body'>
                        <h2 class='card-title'> {{$Coursekelass->nama_kelas}}</h2>
                        <p class='subcourse'>5 Pelajaran</p>
                        <h3 class='desc-course'>Description</h3>
                        <p class="desc-course-text">{!! $Coursekelass->deskripsi !!}</p>
                    </div>
                </div>
            </div>

            <div class="locked-courses">
                <img src="/assets/img/Lock.png" alt="">
                <h3>THIS CLASS IS LOCKED FOR YOUR MEMBER LEVEL</h3>
                <a class="btn btn-locked" href="">UPGRADE</a>
            </div>
            @endforeach

        </div>

                        <div class="locked-courses">
                            <img src="/assets/img/Lock.png" alt="">
                            <h3>THIS CLASS IS LOCKED FOR YOUR MEMBER LEVEL</h3>
                            <a class="btn btn-locked" href="">UPGRADE</a>
                        </div>
                    @endforeach

                </div>

        <!-- INI UNTUK LOCKED COURSE,
                KALAU MAU PAKE DISPLAY:BLOCK,
                KALAU GAK MAU DIPAKAI DISPLAY: NONE
                (SILAHKAN UBAH DI CSS (di .locked-courses)).
                DEFAULT DISPLAY NONE-->
        <div class="locked-courses">
            <img src="/assets/img/Lock.png" alt="">
            <h3>THIS CLASS IS LOCKED FOR YOUR MEMBER LEVEL</h3>
            <a class="btn btn-locked" href="">UPGRADE</a>
        </div>
    </div>
</div>

<!-- COURSE RESPONSIVE -->
<div class="container container-card-res">
<section id="courses">
    @foreach($coursekel_auth as $key => $cs)
    <div class="container inner">
        <div class="container-card">
            <div class="section-header">
                <h3 class="section-title">Daftar Kelas</h3>
                <a href="#" class="section-link">Lihat semua > </a>
            </div>
            @foreach($cs as $Coursekelass)

            <div class='card-course'>
                <div class='row-1'>
                    <div style='background-image:url(/assets/foto/kelas/{{$Coursekelass->foto_kelas}})' class="card-image"></div>
                </div>
                <div class='card-body row-2'>
                    <h2 class='card-title'> {{$Coursekelass->nama_kelas}}</h2>
                    <p class='subcourse'>5 Pelajaran</p>
                    <a class='btn btn-mulai' href='/course/{{$Coursekelass->id_kelas}}'>Mulai Kelas</a>
                </div>
            </div>

            <!-- INI UNTUK LOCKED COURSE,
                                KALAU MAU PAKE DISPLAY:BLOCK,
                                KALAU GAK MAU DIPAKAI DISPLAY: NONE
                                (SILAHKAN UBAH DI CSS (di .locked-courses)).
                                DEFAULT DISPLAY NONE-->
            <div class="locked-courses">
                <img src="/assets/img/Lock.png" alt="">
                <h3>THIS CLASS IS LOCKED FOR YOUR MEMBER LEVEL</h3>
                <a class="btn btn-locked" href="">UPGRADE</a>
            </div>
            @endforeach

        </div>

    </div>
    @endforeach

    @foreach($coursekelas as $key => $cs)
    <div class="container inner">
        <div class="container-card">
            @foreach($cs as $Coursekelass)

            <div class='card-course'>
                <div class='row-1'>
                    <div style='background-image:url(/assets/foto/kelas/{{$Coursekelass->foto_kelas}})' class="card-image"></div>
                </div>
                <div class='card-body row-2'>
                    <h2 class='card-title'> {{$Coursekelass->nama_kelas}}</h2>
                    <p class='subcourse'>5 Pelajaran</p>
                    <a class='btn btn-mulai' href='/membership' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                    href='javascript:;'>Mulai Kelas</a>
                </div>
            </div>

            <div class="locked-courses">
                <img src="/assets/img/Lock.png" alt="">
                <h3>THIS CLASS IS LOCKED FOR YOUR MEMBER LEVEL</h3>
                <a class="btn btn-locked" href="">UPGRADE</a>
            </div>
            @endforeach

        </div>

    </div>
    @endforeach


        <div class="locked-courses">
            <img src="/assets/img/Lock.png" alt="">
            <h3>THIS CLASS IS LOCKED FOR YOUR MEMBER LEVEL</h3>
            <a class="btn btn-locked" href="">UPGRADE</a>
        </div>
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
