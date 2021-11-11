@extends('web.layout.container')

@section('content')





    <link rel="stylesheet" href="/assets/css/course-info.css">
    @include('slidebar')

    <div class="container container-course-info">


        <div class="sidebar">
            <div class="class-title">
                <!--<h2>Class #Nomor: Nama Kelasnya</h2>-->
                <h2>KELAS 1</h2>
            </div>

            <div class="content-title">
                <h2>Konten Kelas #Nomor</h2>
            </div>




            <div class='pilar-dropdown'>
                <a class='btn btn-dropdown turunin1' href='#' id='pilar1' role='button' data-toggle='dropdown'
                    aria-haspopup='true' aria-expanded='false'>
                    GEM <img src='./img/Collapse Arrow Down.png'>
                </a>
                <div class='drop-menu' aria-labelledby='#pilar1'>



                    <a id='gem1' class='drop-item tampil1' href='?hal=course-pilar&pil=1&k=3'>
                        <img src='./img/Circled Play.png'>
                        <div class='drop-text'>
                            <p class='drop-item-title'>GEM</p>
                            <p class='drop-item-desc'>Intro</p>
                        </div>

                    </a>





                    <a id='gem1' class='drop-item tampil1' href='?hal=course-detail&pl=28&k=3'>
                        <img src='./img/Circled Play.png'>
                        <div class='drop-text'>
                            <p class='drop-item-title'>GEM</p>
                            <p class='drop-item-desc'>GEM 1 - Dasar Bisnis</p>
                        </div>

                    </a>





                    <a id='gem1' class='drop-item tampil1' href='?hal=course-detail&pl=29&k=3'>
                        <img src='./img/Circled Play.png'>
                        <div class='drop-text'>
                            <p class='drop-item-title'>GEM</p>
                            <p class='drop-item-desc'>GEM 2 - Bisnis Berkembang</p>
                        </div>

                    </a>





                    <a id='gem1' class='drop-item tampil1' href='?hal=course-detail&pl=31&k=3'>
                        <img src='./img/Circled Play.png'>
                        <div class='drop-text'>
                            <p class='drop-item-title'>GEM</p>
                            <p class='drop-item-desc'>GEM 4 - Yoyoyo</p>
                        </div>

                    </a>



                </div>
            </div>

            <div class='pilar-dropdown'>
                <a class='btn btn-dropdown turunin2' href='#' id='pilar2' role='button' data-toggle='dropdown'
                    aria-haspopup='true' aria-expanded='false'>
                    BA <img src='./img/Collapse Arrow Down.png'>
                </a>
                <div class='drop-menu' aria-labelledby='#pilar2'>



                    <a id='gem2' class='drop-item tampil2' href='?hal=course-pilar&pil=2&k=3'>
                        <img src='./img/Circled Play.png'>
                        <div class='drop-text'>
                            <p class='drop-item-title'>BA</p>
                            <p class='drop-item-desc'>Intro</p>
                        </div>

                    </a>





                    <a id='gem2' class='drop-item tampil2' href='?hal=course-detail&pl=30&k=3'>
                        <img src='./img/Circled Play.png'>
                        <div class='drop-text'>
                            <p class='drop-item-title'>BA</p>
                            <p class='drop-item-desc'>GEM 3 - Visi Misi Bisnis</p>
                        </div>

                    </a>





                    <a id='gem2' class='drop-item tampil2' href='?hal=course-detail&pl=32&k=3'>
                        <img src='./img/Circled Play.png'>
                        <div class='drop-text'>
                            <p class='drop-item-title'>BA</p>
                            <p class='drop-item-desc'>Belajar Sukses</p>
                        </div>

                    </a>



                </div>
            </div>



            <div class="rating">
                <a class="btn tombol-rating" href="?hal=course-rating&k=3&p=">Rating dan Komentar</a>
            </div>
        </div>



        <div class="course-content content">

            <!-- MATERI CONTENT-->

            <div class='card'>
                <div class='card-header'>
                    BA
                </div>
                <div class='card-body'>

                    <h2 align='center'>Belajar Sukses</h2>
                    <br>
                    <center>
                        <img src='/assets/foto/kursus/kursus-20210314103700.jpg' alt='Belajar Sukses' width='55%'>
                    </center>

                    <div class='drop-text-content'>
                        <p><strong>Keterangan:</strong></p>

                        <p>akakjajja hahAK ahhakakhkhak ahkhAKha ahkahk.&nbsp;akakjajja hahAK ahhakakhkhak ahkhAKha
                            ahkahk.&nbsp;akakjajja hahAK ahhakakhkhak ahkhAKha ahkahk.&nbsp;akakjajja hahAK ahhakakhkhak
                            ahkhAKha ahkahk.&nbsp;akakjajja hahAK ahhakakhkhak ahkhAKha ahkahk.&nbsp;akakjajja hahAK
                            ahhakakhkhak ahkhAKha ahkahk.</p>

                    </div>

                </div>
            </div>




        </div>



    </div>


    <div class="content modal-rated-content">
        <div class="modal-rating">
            <a class="close-modal-rating" href=""><img src="Cancel.png" alt=""></a>
            <h1>Rating Sudah Dikirim</h1>
            <img src="Ok (1).png" alt="">
            <a class="btn-form-rated" href="">Kirim Rating dan Komentar</a>
            <a class="back-to-menu" href="">Kembali Ke Menu</a>
        </div>
    </div>


    </div><!-- Button trigger modal -->






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



    <script>
        $(document).ready(function() {

            $('.turunin1').click(function(e) {
                e.preventDefault();
                if ($('.tampil1').css('display') == 'none') {
                    $('.tampil1').css('display', 'block');
                    $('.turunin1 img').attr('src', '/assets/img/Collapse Arrow Up.png');
                } else {
                    $('.tampil1').css('display', 'none');
                    $('.turunin1 img').attr('src', '/assets/img/Collapse Arrow Down.png');
                }
            });

            $('.turunin2').click(function(e) {
                e.preventDefault();
                if ($('.tampil2').css('display') == 'none') {
                    $('.tampil2').css('display', 'block');
                    $('.turunin2 img').attr('src', '/assets/img/Collapse Arrow Up.png');
                } else {
                    $('.tampil2').css('display', 'none');
                    $('.turunin2 img').attr('src', '/assets/img/Collapse Arrow Down.png');
                }
            });

        });
    </script>


@endsection
