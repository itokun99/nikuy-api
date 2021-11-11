@extends('web.layout.container')

@section('content')
    <link rel="stylesheet" href="/assets/css/profile.css">
    <link rel="stylesheet" href="/assets/css/membership.css">
    <link rel="stylesheet" href="/assets/css/payment.css">
    @include('slidebar')

    <center>

        <div class="container container-payment">
            <div class="desc-trans">
                <h2>Transaksi: Event {{ $event->nama_event }}</h2>
            </div>

            <div class="container-card">
                <div class="card">
                    <div class="card-header">
                        BAYAR SEBELUM 16 FEBRUARI 2021 11:32PM
                    </div>
                    <div class="card-body">
                        <h5 class="card-title harga">Rp {{ number_format($event->harga_event, 2, ',', '.') }}</h5>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        TRANSFER BANK
                    </div>
                    <div class="card-body">
                        <img class="logo-bca" src="/assets/img/logo-bca.png" alt="">
                        <p class="card-text">No. Rekening: 001 560 7888</p>
                        <p class="card-text">a.n. PT Multi Karunia Berkat</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        UNGGAH BUKTI TRANSFER
                    </div>
                    <div class="card-body">
                        <h5 class="title-warning">Mohon Diperhatikan!</h5>

                        <div class="warning">
                            <p>Pengiriman bukti transfer <span class="bold">WAJIB</span> dilakukan setelah <span
                                    class="bold">anda melakukan transfer</span>. Kami menyarankan untuk menyimpan
                                /
                                screenshot bukti transfer anda.</p>
                        </div>

                        <form action="/event/daftar/{{ $event->id_event }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="harga" value="{{ $event->harga_event }}">
                            <input type="hidden" name="transaksi" value="Event {{ $event->nama_event }}">

                            <label for="">Bank Asal</label>
                            <select class="input-box" name="bank" required>
                                <option value="">Bank Asal</option>
                                <option value="Bank Mandiri">Bank Mandiri</option>
                                <option value="Bank Bukopin">Bank Bukopin</option>
                                <option value="Bank Danamon">Bank Danamon</option>
                                <option value="Bank Mega">Bank Mega</option>
                                <option value="Bank CIMB Niaga">Bank CIMB Niaga</option>
                                <option value="Bank Permata">Bank Permata</option>
                                <option value="Bank Sinarmas">Bank Sinarmas</option>
                                <option value="Bank QNB">Bank QNB</option>
                                <option value="Bank Lippo">Bank Lippo</option>
                                <option value="Bank UOB">Bank UOB</option>
                                <option value="Panin Bank">Panin Bank</option>
                                <option value="Citibank">Citibank</option>
                                <option value="Bank ANZ">Bank ANZ</option>
                                <option value="Bank Commonwealth">Bank Commonwealth</option>
                                <option value="Bank Maybank">Bank Maybank</option>
                                <option value="Bank Maspion">Bank Maspion</option>
                                <option value="Bank J Trust">Bank J Trust</option>
                                <option value="Bank QNB">Bank QNB</option>
                                <option value="Bank KEB Hana">Bank KEB Hana</option>
                                <option value="Bank Artha Graha">Bank Artha Graha</option>
                                <option value="Bank OCBC NISP">Bank OCBC NISP</option>
                                <option value="Bank MNC">Bank MNC</option>
                                <option value="Bank DBS">Bank DBS</option>
                                <option value="BCA">BCA</option>
                                <option value="BNI">BNI</option>
                                <option value="BRI">BRI</option>
                                <option value="BTN">BTN</option>
                                <option value="Bank DKI">Bank DKI</option>
                                <option value="Bank BJB">Bank BJB</option>
                                <option value="Bank BPD DIY">Bank BPD DIY</option>
                                <option value="Bank Jateng">Bank Jateng</option>
                                <option value="Bank Jatim">Bank Jatim</option>
                                <option value="Bank BPD Bali">Bank BPD Bali</option>
                                <option value="Bank Sumut">Bank Sumut</option>
                                <option value="Bank Nagari">Bank Nagari</option>
                                <option value="Bank Riau Kepri">Bank Riau Kepri</option>
                                <option value="Bank Sumsel Babel">Bank Sumsel Babel</option>
                                <option value="Bank Lampung">Bank Lampung</option>
                                <option value="Bank Jambi">Bank Jambi</option>
                                <option value="Bank Kalbar">Bank Kalbar</option>
                                <option value="Bank Kalteng">Bank Kalteng</option>
                                <option value="Bank Kalsel">Bank Kalsel</option>
                                <option value="Bank Kaltim">Bank Kaltim</option>
                                <option value="Bank Sulsel">Bank Sulsel</option>
                                <option value="Bank Sultra">Bank Sultra</option>
                                <option value="Bank BPD Sulteng">Bank BPD Sulteng</option>
                                <option value="Bank Sulut">Bank Sulut</option>
                                <option value="Bank NTB">Bank NTB</option>
                                <option value="Bank NTT">Bank NTT</option>
                                <option value="Bank Maluku">Bank Maluku</option>
                                <option value="Bank Papua">Bank Papua</option>
                            </select>

                            <!--<input value="" class="form-control" type="hidden" name="norek" placeholder="No. Rekening" required>
                                <input value="" class="form-control" type="hidden" name="nama" placeholder="Atas Nama" required>
                                    -->
                            <label for="">Nama Pemilik Rekening</label>
                            <input name="nama" placeholder="Atas Nama" class="input-box" type="text">


                            <label for="">Nomor Rekening</label>
                            <input name="norek" placeholder="No. Rekening" class="input-box" type="number">

                            <!--
                                <label for="">Nominal Transaksi</label>
                                <input class ="input-box" type="text">
                                -->

                            <label for="">Upload Bukti Pembayaran</label>
                            <input type="file" name="foto" id="gambarAmbil" required>
                            <br><br>

                            <center>
                                <img class="upload-gambar" id="gambarTampil" src="/assets/img/nofoto.png" alt="Gambar">
                                <button type="submit" class="confirm-pay">
                                    Konfirmasi Pembayaran
                                </button>
                            </center>

                        </form>

                    </div>
                </div>


            </div>

        </div>
    </center>

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
