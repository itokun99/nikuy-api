@if (Auth::check())
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
                    <form action="/register" method="post">
                        @csrf
                        <div class="container-input-field">
                            <label class="nama" for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="text-input"
                                placeholder="Masukan nama lengkap anda">
                            <p class="error-msg" id="errNama">Error Message</p>
                        </div>

                        <div class="container-input-field">
                            <label class="alamat" for="alamat">Alamat Lengkap</label>
                            <textarea class="text-input input-alamat" name="alamat" id="alamat"
                                placeholder="Masukkan alamat anda"></textarea>
                            <p class="error-msg" id="errAlamat">Error Message</p>
                        </div>

                        <div class="container-input-field">
                            <label class="tgl-lahir" for="tgl-lahir">Tanggal Lahir</label>
                            <input type="date" name="tglahir" id="tgl-lahir" class="text-input">
                            <p class="error-msg" id="errTgl">Error Message</p>
                        </div>

                        <div class="container-input-field">
                            <label class="gender" for="gender">Jenis Kelamin</label>
                            <select class="text-input" id="gender" name="jekel" required>
                                <option value="none" selected="true" disabled="disabled">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <p class="error-msg" id="errGender">Error Message</p>
                        </div>

                        <div class="container-input-field">
                            <label class="no-hp" for="no-hp">Nomor Handphone</label>
                            <input type="number" name="nohp" id="no-hp" class="text-input"
                                placeholder="Masukan nomor handphone aktif anda">
                            <p class="error-msg" id="errPhone">Error Message</p>
                        </div>

                        <div class="container-input-field">
                            <label class="email" for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="text-input"
                                placeholder="Masukkan E-mail">
                            <p class="error-msg" id="errEmail">Error Message</p>
                        </div>

                        <div class="container-input-field">
                            <label class="pass" for="pass">Kata Sandi</label>
                            <input type="password" name="password" id="pass" class="text-input show-pass"
                                placeholder="Masukan kata sandi yang terdaftar">
                            <img class="show-pass-icon toggle-show-pass" src="/assets/img/show_pass_icon.png">
                            <p class="error-msg" id="errPass">Error Message</p>
                        </div>

                        <div class="container-input-field">
                            <label class="pass" for="pass-conf">Konfirmasi Kata Sandi</label>
                            <input type="password" name="pass-conf" id="confirm-pass" class="text-input"
                                placeholder="Tuliskan ulang kata sandi yang terdaftar">
                            <img class="show-pass-icon toggle-show-conf-pass" src="/assets/img/show_pass_icon.png">
                            <p class="error-msg" id="errPassConf">Error Message</p>
                        </div>

                        <div class="container-input-field">
                            <input type="checkbox" name="setujuan" id="tc">
                            <label class="tc" for="tc">Saya telah membaca dan menyetujui<span><a
                                        data-fancybox data-src='#setujuan' href='javascript:;'>Syarat dan
                                        Ketentuan</a></span></label>
                            <p class="error-msg" id="errCheckBox">Error Message</p>
                        </div>
                        <button type="submit" class="btn" id="btn-modal-daftar">Daftar</button>
                    </form>
                    <p>Sudah punya akun Elites?<span><a class="modal-trigger-login" href="#">Login</a></span></p>
                </div>
            </div>
        </div>
    </div>

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

                    <form action="/login" method="post">
                        @csrf
                        <div class="container-input-field">
                            <label class="email" for="email-login">Alamat Email</label>
                            <input type="email" name="email" id="email-login" class="text-input"
                                placeholder="Masukan alamat email yang terdaftar">
                            <p class="error-msg" id="errEmailLogin">Error Message</p>
                        </div>

                        <div class="container-input-field">
                            <label class="pass" for="pass-login">Kata Sandi</label>
                            <input type="password" name="password" id="pass-login" class="text-input"
                                placeholder="Masukan kata sandi yang terdaftar">
                            <p class="error-msg" id="errPassLogin">Error Message</p>
                        </div>

                        <button type="submit" class="btn" id="btn-modal-login">Login</button>
                        <p>Belum punya akun Elites?<span><a class="modal-trigger-daftar" href="#">Daftar</a></span>
                            <br />
                            <br />
                            Lupa kata sandi? <a href="mailto:tessa@te-society.com?subject=Lupa Kata Sandi">klik di
                                sini!</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL RESPONSIVE -->
    <!-- LOGIN -->
    <div class="modal modal-login-res">
        <div class="container-content-modal">
            <img class="close close-login" src="/assets/img/Cancel_Icon.png" alt="">
            <div class="title-heavy-res">Selamat Datang di <span>TE SOCIETY</span></div>
            <div class="btn-toggle-login-daftar">
                <div class="title-light-res modal-toggle-res active">Login</div>
                <div class="title-light-res modal-toggle-res" id="modal-toggle-daftar-res">Daftar</div>
            </div>

            <form action="/login" method="post">
                @csrf
                <div class="container-input-field">
                    <label for="email-login-res" class="caption-heavy">Alamat Email</label>
                    <input id="email-login-res" class="caption-light" type="email" name="email"
                        placeholder="Masukan alamat email yang terdaftar">
                    <p class="error-msg caption-light critical" id="errEmailLoginRes">Error Message</p>
                </div>

                <div class="container-input-field">
                    <label for="pass-login-res" class="caption-heavy">Kata Sandi</label>
                    <input id="pass-login-res" class="caption-light" type="password" name="password"
                        placeholder="Masukan kata sandi yang terdaftar">
                    <img class="show-pass-icon toggle-show-pass" src="/assets/img/show_pass_icon.png">
                    <p class="error-msg caption-light critical" id="errPassLoginRes">Error Message</p>
                </div>

                <div class="d-flex justify-content-between bottom-form">
                    <div>
                        <input type="checkbox">
                        <label class="caption-light">Ingatkan Saya</label>
                    </div>
                    <div class="caption-light critical">Lupa Kata Sandi?</div>
                </div>

                <button id="btn-modal-login-res" class="btn-gold-sec-normal small-heavy" type="submit">MASUK</button>

                <div class="xs-light">Belum Punya Akun Elites?<span class="modal-trigger-daftar-res">Daftar</span>
                </div>
                <div class="xs-light">
                    Lupa kata sandi? <a href="mailto:tessa@te-society.com?subject=Lupa Kata Sandi">klik di sini!</a>
                </div>

            </form>
        </div>

    </div>

    <!-- DAFTAR -->
    <div class="modal modal-daftar-res">
        <div class="container-content-modal">
            <img class="close close-login" src="/assets/img/Cancel_Icon.png" alt="">
            <div class="title-heavy-res">Selamat Datang di <span>TE SOCIETY</span></div>
            <div class="btn-toggle-login-daftar">
                <div class="title-light-res modal-toggle-res" id="modal-toggle-login-res">Login</div>
                <div class="title-light-res modal-toggle-res active">Daftar</div>
            </div>

            <form action="/register" method="post">
                @csrf
                <div class="form-daftar-part1">
                    <div class="container-input-field">
                        <label for="nama-daftar-res" class="caption-heavy">Nama Lengkap</label>
                        <input id="nama-daftar-res" class="caption-light" type="text" name="nama"
                            placeholder="Masukan nama lengkap anda.">
                        <p class="error-msg caption-light critical" id="errNamaDaftarRes">Error Message</p>
                    </div>

                    <div class="container-input-field">
                        <label for="alamat-daftar-res" class="caption-heavy">Alamat Lengkap</label>
                        <input id="alamat-daftar-res" class="caption-light" type="text" name="alamat"
                            placeholder="Masukan alamat lengkap anda">
                        <p class="error-msg caption-light critical" id="errAlamatDaftarRes">Error Message</p>
                    </div>

                    <div class="container-input-field">
                        <label for="birth-daftar-res" class="caption-heavy">Tanggal Lahir</label>
                        <input id="birth-daftar-res" class="caption-light" type="date" name="tglahir">
                        <p class="error-msg caption-light critical" id="errBirthDaftarRes">Error Message</p>
                    </div>

                    <div class="container-input-field">
                        <label for="genderRes" class="caption-heavy">Jenis Kelamin</label>
                        <select class="caption-light" id="genderRes" name="jekel">
                            <option value="none" selected="true" disabled="disabled">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <p class="error-msg caption-light critical" id="errGenderRes">Error Message</p>
                    </div>

                    <button id="btn-modal-daftar-next" type="button"
                        class="btn-gold-sec-normal small-heavy">SELANJUTNYA</button>
                </div>

                <div class="form-daftar-part2">
                    <div class="container-input-field">
                        <label for="phone-daftar-res" class="caption-heavy">Nomor Handphone</label>
                        <input id="phone-daftar-res" class="caption-light" type="number" name="nohp"
                            placeholder="Masukan nomor handphone anda.">
                        <p class="error-msg caption-light critical" id="errPhoneDaftarRes">Error Message</p>
                    </div>

                    <div class="container-input-field">
                        <label for="email-daftar-res" class="caption-heavy">Alamat Email</label>
                        <input id="email-daftar-res" class="caption-light" type="email" name="email"
                            placeholder="Masukan alamat email anda.">
                        <p class="error-msg caption-light critical" id="errEmailDaftarRes">Error Message</p>
                    </div>

                    <div class="container-input-field">
                        <label for="pass-daftar-res" class="caption-heavy">Kata Sandi</label>
                        <input id="pass-daftar-res" class="caption-light" type="password" name="password"
                            placeholder="Masukan password.">
                        <p class="error-msg caption-light critical" id="errPassDaftarRes">Error Message</p>
                    </div>

                    <div class="container-input-field">
                        <label for="cpass-daftar-res" class="caption-heavy">Konfirmasi Kata Sandi</label>
                        <input id="cpass-daftar-res" class="caption-light" type="password" name="pass-conf"
                            placeholder="Masukan ulang password.">
                        <p class="error-msg caption-light critical" id="errCPassDaftarRes">Error Message</p>
                    </div>

                    <div class="d-flex justify-content-between bottom-form">
                        <div>
                            <input id="tcRes" type="checkbox" name="setujuan">
                            <label class="caption-light">Saya telah membaca dan menyetujui <br><span><a data-fancybox
                                        data-src='#setujuan' href='javascript:;'>Syarat dan Ketentuan</a></span></label>
                            <p class="error-msg caption-light critical" id="errTCRes">Error Message</p>
                        </div>
                    </div>

                    <button id="btn-modal-daftar-res" class="btn-gold-sec-normal small-heavy"
                        type="submit">DAFTAR</button>

                </div>

                <div class="xs-light">Sudah punya akun Elites? <span
                        class="modal-trigger-login-res">Login</span>
                </div>

            </form>
        </div>

    </div>
@endif
