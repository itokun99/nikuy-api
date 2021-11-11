@extends('web.layout.container')

@section('content')



    <link rel="stylesheet" href="/assets/css/profile.css">
    <link rel="stylesheet" href="/assets/css/transaksi.css">
    @include('slidebar')

    <div class="container container-transaksi">


        <div class="sidebar">
            <a class="" href=" /user">Profile</a>
            <a class="" href=" /membership">Membership</a>
            <a class="active" href="transaksi">Transaksi</a>
        </div>


        <!-- Fancybox -->
        <div id="fotoan" style="display: none; width:500px; height:500px; background-color: #333333; color:white;">


            <form action="?hal=akun-respon&mode=upload&isi=Kosong" method="post" enctype="multipart/form-data">

                <center>
                    <img id="gambarTampil" src="/assets/img/nofoto.png" width="50%" height="200" alt="Admin">
                    <p style="margin-top: 15px;">
                        <font color="gray">Gambar tampil disini</font>
                    </p>
                    <input type="file" name="foto" id="gambarAmbil" onchange="return uploadFoto(this)" required />

                    <p style="margin-top: 15px;">
                        <button type="submit" class="btn btn-primary btn-lg">
                            SIMPAN
                        </button>
                    </p>
                </center>

            </form>


        </div>



        <div class="container-content">
            <!-- AKUN NAVBAR -->
            <div class="akun-navbar">
                <a id="profil" class="active" href="">Akun Member Anda</a>
            </div>

            <div class="container-card">

                @foreach ($transaksi as $key => $transaksis)
                    <div class='card'>
                        <div class='card-body'>
                            <div class='envelope'>
                                <a href='#'><img src='/assets/img/Envelope-Open.png' alt='Notif'></a>
                            </div>
                            <div class=''></div>
                            <h5 class='card-title'>{{ $transaksis->nama_transaksi }}</h5>
                            <p class='card-text'>Rp {{ number_format($transaksis->biaya_transaksi, 2, ',', '.') }}</p>
                            <p class='card-text'>Tanggal Transaksi: {{ $transaksis->tgl_transaksi }}</p>
                            <p class='card-text'>Tanggal Berakhir: {{ $transaksis->tgl_berakhir }}</p>
                            <a class='btn btn-transaksi' data-fancybox data-src='#transaksi{{ $key }}'
                                href='javascript:;'>Lihat</a>
                        </div>
                    </div>

                    <div id='transaksi{{ $key }}' class='modal-transaksi'>
                        <img class='bukti-trans' src='/assets/foto/struk/{{ $transaksis->foto_struk }}' alt=''>
                        <div class='detail-transaksi'>

                            <h2 class='trans-title'>{{ $transaksis->nama_transaksi }}</h2>
                            <h3 class='detail-trans-title'>Biaya</h3>
                            <h3 class='detail-trans'>Rp {{ number_format($transaksis->biaya_transaksi, 2, ',', '.') }}
                            </h3>

                            <!-- TODO perlu sebuah variabel untuk rekening owner -->
                            <h3 class='detail-trans-title'>Rekening Tujuan</h3>
                            <h3 class='detail-trans'>BCA 001 560 7888 PT Multi Karunia Berkat</h3>

                            <h3 class='detail-trans-title'>No. Rekening yang digunakan</h3>
                            <h3 class='detail-trans'>{{ $transaksis->no_rek }}</h3>

                            <h3 class='detail-trans-title'>Nama Rekening</h3>
                            <h3 class='detail-trans'>{{ $transaksis->nama_rekening }}</h3>

                            <h3 class='detail-trans-title'>Bank</h3>
                            <h3 class='detail-trans'>{{ $transaksis->bank_asal }}</h3>

                            <h3 class='detail-trans-title'>Dibayarkan Pada</h3>
                            <h3 class='detail-trans'>{{ $transaksis->tgl_transaksi }}</h3>

                            <h3 class='detail-trans-title'>Status</h3>
                            <h3 class='detail-trans-status'><span
                                    class='badge badge-success'>{{ $transaksis->keterangan }}</span></h3>
                        </div>
                        <!--<a class='btn btn-modal-close' href='#'>Tutup</a>-->
                    </div>
                @endforeach

            </div>
        </div>

    </div>
    </div>

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
    </section><!-- Button trigger modal -->






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

        });
    </script>


@endsection
