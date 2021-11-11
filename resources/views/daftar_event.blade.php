@extends('web.layout.container')

@section('content')



    <link rel="stylesheet" href="/assets/css/payment.css">


    @include('slidebar')


    <div class="container container-payment">

        <div class="desc-trans">
            <h2>Transaksi: Mengikuti Event STOP MAKING CONTENT LIKE AN AGENCY </h2>
        </div>

        <div class="container-card">
            <div class="card">
                <div class="card-header">
                    BAYAR SEBELUM 16 FEBRUARI 2021 11:32PM
                </div>
                <div class="card-body">
                    <h5 class="card-title harga">Rp 50.000,00</h5>
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
                    KONFIRMASI
                </div>
                <div class="card-body">
                    <h5 class="title-warning">Mohon Diperhatikan!</h5>

                    <div class="warning">
                        <p>Pengiriman bukti transfer <span class="bold">WAJIB</span> dilakukan setelah <span
                                class="bold">anda melakukan transfer</span>. Kami menyarankan untuk menyimpan /
                            screenshot bukti transfer anda.</p>
                    </div>

                    <form action="?hal=konfirmasi-upload" method="post">
                        <input type="hidden" name="k" value="18">
                        <input type="hidden" name="mau" value="event">
                        <input type="hidden" name="harga" value="50000">
                        <input type="hidden" name="transaksi" value="Mengikuti Event STOP MAKING CONTENT LIKE AN AGENCY">


                        <label for="">Nama Pemilik Rekening</label>
                        <input class="input-box" type="text" name="nama" placeholder="Atas Nama" required>

                        <label for="">Nomor Rekening</label>
                        <input class="input-box" type="number" name="norek" placeholder="No. Rekening" required>

                        <button type="submit" class="confirm-pay" href="#">Konfirmasi Pembayaran </button>

                    </form>

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
