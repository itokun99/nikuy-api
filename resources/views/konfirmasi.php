
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ELITES</title>

  <link rel="shortcut icon" href="/assets/img/LogoHitam.png">

  <!-- Bootstrap V4.6 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

  <!--fancybox-->
  <link rel="stylesheet" href="/assets/vendor/fancybox/jquery.fancybox.min.css">

  <!--Slick CSS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" />

  <!-- <link rel="stylesheet" href="css/danny-design.css">
  <link rel="stylesheet" href="css/tampilan.css"> -->
  <link rel="stylesheet" href="/assetscss/ev-design.css">


</head>

<body>



<link rel="stylesheet" href="/assets/css/payment.css">


<section id="navigation-bar">
        <div class="container-navbar">
            <nav class="navbar">
                <a class="logo" href="/">
                    <img src="/assets/img/logoElites.png" alt="logo">
                </a>
                <div class = "nav-list">
                    <a class="btn active " href="?hal=event">Event</a>
                    <a class="btn active " href="?hal=course">Course</a>
                    <a class="btn active " href="?hal=cooming-soon&tuj=forum">Forum</a>
                    <a class="btn active " href="?hal=cooming-soon&tuj=comunity">Community</a>

                    <a class="btn profile-pict" href="/user">
                        <img  title="Admin" src="/assets/img/nofoto.png" />
                    </a>

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <i class="fa fa-bell" aria-hidden="true"></i>




                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                            <a class='dropdown-item' href='#'>Belum ada Transaksi</a>
                                                            </div>

                    <a class="btn logout"href="?hal=logout">Logout</a>

                </div>
            </nav>
        </div>
</section>


<div class="container container-payment">

        <div class="desc-trans">
        <h2>Transaksi: Mengikuti Event STOP MAKING CONTENT LIKE AN AGENCY</h2>
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
            UNGGAH BUKTI TRANSFER
            </div>
            <div class="card-body">
            <h5 class="title-warning">Mohon Diperhatikan!</h5>

            <div class="warning">
                <p>Pengiriman bukti transfer <span class="bold">WAJIB</span> dilakukan setelah <span class="bold">anda melakukan transfer</span>. Kami menyarankan untuk menyimpan / screenshot bukti transfer anda.</p>
            </div>

            <form action="?hal=konfirmasi-respon" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="k" value="18">
                <input type="hidden" name="mau" value="event">
                <input type="hidden" name="harga" value="50000">
                <input type="hidden" name="transaksi" value="Mengikuti Event STOP MAKING CONTENT LIKE AN AGENCY">


                <label for="">Bank Asal</label>
                <select class ="input-box" name="bank" required>
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
                <input name="nama" placeholder="Atas Nama" class ="input-box" type="text" value="aku">


                <label for="">Nomor Rekening</label>
                <input name="norek" placeholder="No. Rekening" class ="input-box" type="number" value="3253453643">

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
</section><style>
  #pesanAwal, #pesanUpgrade, #setujuan
  {
    display: none;
    width: 700px;
    background-color: black;
    color: white;
  }

  #pesanAwal img, #pesanUpgrade img, #setujuan img
  {
    display: block;
    margin: auto;
  }

  #pesanAwal a, #pesanUpgrade a, #setujuan a
  {
    width: 100%;
  }

  #setujuan
  {
    width: 500px;
  }

  #setujuan p
  {
    margin-top: 25px;
  }
</style>

<!-- Button trigger modal -->

<div id="pesanAwal">

    <img src="/assets/img/Lock.png" width="25%">
    <h2 align="center">Maaf</h2>
    <p align="center">Anda harus melakukan pendaftaran terlebih dahulu...</p>

  <a href='#' id="tombolAwal" class="btn btn-warning text-white"><h4>Daftar</h4></a>
</div>

<div id="pesanUpgrade">

    <img src="/assets/img/Lock.png" width="25%">
    <h2 align="center">Upgrade Status Membership</h2>
    <p align="center">Anda harus Upgrade Status terlebih dahulu...</p>

  <a href='?hal=akun-membership&tuj=profile' id="tombolUpg" class="btn btn-warning text-white"><h4>Upgrade</h4></a>
</div>

<div class="modal modal-daftar">
  <div class="row">
    <div class="col col-gambar">
      <img src="/assets/img/Side_Logo.png" alt="">
    </div>
    <div class="col col-login">
      <div class="container-form">
        <img class="close close-login" src="/assets/img/Cancel_Icon.png" alt="">
        <h1>SELAMAT DATANG DI<span>TE SOCIETY</span></h1>
        <p>Daftar Akun Elites Kamu!</p>

        <form action="?hal=daftar-respon" method="post">
          <label class="nama" for="nama">Nama Lengkap</label>
          <input type="text" name="nama" id="nama" class="text-input" placeholder="Masukan nama lengkap anda" required>

          <label class="alamat" for="alamat">Alamat Lengkap</label>
          <textarea class="text-input input-alamat" name="alamat" id="alamat" required></textarea>

          <label class="tgl-lahir" for="tgl-lahir">Tanggal Lahir</label>
          <input type="date" name="tglahir" id="tgl-lahir" class="text-input" required>

          <label class="gender" for="gender">Jenis Kelamin</label>
          <select class="text-input" id="gender" name="jekel" required>
            <option selected="true" disabled="disabled">Pilih</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>

          <label class="no-hp" for="no-hp">Nomor Handphone</label>
          <input type="number" name="nohp" id="no-hp" class="text-input" placeholder="Tuliskan nomor handphone aktif anda" required>

          <label class="email" for="email">E-mail</label>
          <input type="email" name="email" id="no-hp" class="text-input" placeholder="Masukkan E-mail" required>

          <label class="pass" for="pass">Kata Sandi</label>
          <input type="password" name="password" id="pass" class="text-input tampilinPass" style="margin-bottom: 5px;" placeholder="Masukan kata sandi yang terdaftar" required>

          &nbsp;<input type="checkbox" class="tampilPassword"> <small style="color: black;">Tampilkan Password</small> <br>
                <small class="text-danger passTaksama">Password yang diketikkan tidak sama</small>

          <label class="pass" for="pass-conf">Konfirmasi Kata Sandi</label>
          <input type="password" name="pass-conf" id="pass2" class="text-input" placeholder="Tuliskan ulang kata sandi yang terdaftar" required>
          <small class="text-danger passTaksama">Password yang diketikkan tidak sama</small>

          <input type="checkbox" name="setujuan" id="tc" required>
          <label class="tc" for="tc">Saya telah membaca dan menyetujui<span><a data-fancybox data-src='#setujuan' href='javascript:;'>Syarat dan Ketentuan</a></span></label>
          <button type="submit" class="btn">Daftar</button>
        </form>


        <p>Sudah punya akun Elites?<span><a class="modal-trigger-login" href="#">Login</a></span></p>
      </div>
    </div>
  </div>
</div>

<!--MODAL-->
<div class="modal modal-login">
    <div class="row">
        <div class="col col-gambar">
            <img src="/assets/img/Side_Logo.png" alt="">
        </div>
        <div class="col col-login">
            <div class="container-form">
                <img class="close close-login" src="/assets/img/Cancel_Icon.png" alt="">
                <h1>SELAMAT DATANG DI<span>TE SOCIETY</span></h1>
                <p>Masuk ke Akun Elites Kamu!</p>

                <form action="?hal=login-respon" method="post">
                    <label class="email" for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" class="text-input" placeholder="Masukan alamat email yang terdaftar">
                    <label class="pass" for="pass">Kata Sandi</label>
                    <input type="password" name="password" id="pass" class="text-input" placeholder="Masukan kata sandi yang terdaftar">


                    <button type="submit" class="btn">Login</button>
                    <p>Belum punya akun Elites?<span><a class="modal-trigger-daftar" href="#">Daftar</a></span></p>
                </form>


            </div>
        </div>
    </div>
</div>


<div id="setujuan">

  <center>
    <h4>Term and Condition</h4>
  </center>



          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
      </div>


  <!--Bootstrap JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

  <!--Slick JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>

  <!--fancybox-->
  <script src="/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
  <!--<script src="/assets/vendor/tambahan/perKelasan.js"></script>-->
  <script src="/assets/vendor/tambahan/tools.js"></script>
  <script src="/assets/vendor/tambahan/rating.js"></script>
  <script>
    $(document).ready(function ()
    {

        //$(selector).slideDown();

    });
  </script>


</body>

</html>


