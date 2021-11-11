@extends('web.layout.container')

@section('content')


    <link rel="stylesheet" href="/assets/css/course.css">
    @include('slidebar')



    <section id="banner">
        <div class="container">
            <img class="top-banner" src=" /assets/foto/Info-20210314114616.jpg" />
        </div>
    </section>



    <!-- INI COURSE -->
    <section id="courses">
        <div class="container">
            <div class="container-card">

                <h1 class='status-member'></h1>

                <div class='alert alert-primary marjin-atas-50' role='alert'>
                    <center>
                        <h4 class='alert-heading'>Data Masih Kosong</h4>
                    </center>
                </div>


                <div class="locked-courses">
                    <img src="/assets/img/Lock.png" alt="">
                    <h3>THIS CLASS IS LOCKED FOR YOUR MEMBER LEVEL</h3>
                    <a class="btn btn-locked" href="">UPGRADE</a>
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
