function uploadFoto(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
          $('#gambarTampil').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#gambarAmbil").change(function() {
  uploadFoto(this).fadeIn();
});


function uploadUsaha(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
          $('#gambarUsaha').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#gambarAmbUsaha").change(function() {
  uploadUsaha(this).fadeIn();
});


$(document).ready(function() {
    
    $('.row-slick').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1
    });


    $(".modal-trigger-login").on('click', function() {
        $(".modal-login").css("display", "flex");
    });

    $(".modal-trigger-login-res").on('click', function() {
        $(".modal-daftar-res").css("display", "none");
        $(".modal-login-res").css("display", "block");
    });

    $(".modal-trigger-daftar").on('click', function() {
        $(".modal-login").css("display", "none");
        $(".modal-daftar").css("display", "flex");
    });

    $(".modal-trigger-daftar-res").on('click', function() {
        $(".modal-login-res").css("display", "none");
        $(".modal-daftar-res").css("display", "block");
    });

    $(".modal-trigger-btn").on('click', function() {
        $(".modal-daftar").css("display", "flex");
    });

    
    $(".form-daftar-part1").css("display", "block");
    $(".form-daftar-part2").css("display", "none");

    $("#btn-modal-daftar-next").on('click', function() {
        $(".form-daftar-part1").css("display", "none");
        $(".form-daftar-part2").css("display", "block");
    });

    $("#modal-toggle-login-res").on('click', function() {
        $(".modal-daftar-res").css("display", "none");
        $(".modal-login-res").css("display", "block");
    });

    $("#modal-toggle-daftar-res").on('click', function() {
        $(".modal-login-res").css("display", "none");
        $(".modal-daftar-res").css("display", "block");
    });


    $(".close").on('click', function() {
        $(".modal").css("display", "none");
    });

    $("#tombolAwal").click(function(e) {
        $.fancybox.close();

        //$(".modal-daftar").fadeIn();
        $(".modal-daftar").css("display", "flex");
        //$(".modal-daftar").fadeIn();
    });

    $("#tombolUpg").click(function(e) {
        $.fancybox.close();

        //$(".modal-daftar").fadeIn();
        //$(".modal-daftar").css("display", "flex");
        //$(".modal-daftar").fadeIn();
    });



});

//FORM VALIDATION
$(document).ready(function() {

    function togglePass(classToggle, idPass){
        $("body").on('click', classToggle, function() {
            var input = $(idPass);
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
    
        });
    }

    togglePass('.toggle-show-pass', '#pass');
    togglePass('.toggle-show-conf-pass', '#confirm-pass');
    togglePass('.toggle-show-pass', '#pass-login-res');

    function validateFormDaftar() {
        var isNameValid = false;
        var isAlamatValid = false;
        var isBirthDateValid = false;
        var isGenderValid = false;
        var isPhoneValid = false;
        var isEmailValid = false;
        var isPassValid = false;
        var isCPassValid = false;
        var isTnCCheck = false;

        isNameValid = validateName('#nama', '#errNama');
        isAlamatValid = validateAlamat('#alamat', '#errAlamat');
        isPhoneValid = validatePhone('#no-hp', '#errPhone');
        isEmailValid = validateEmail('#email', '#errEmail');
        isPassValid = validatePass('#pass', '#errPass');
        isCPassValid = validateCPass('#pass', '#confirm-pass', '#errPassConf');
        isTnCCheck = validateTnC('#tc', '#errCheckBox');
        isBirthDateValid = validateBirth('#tgl-lahir', '#errTgl');
        isGenderValid = validateGender('#gender', '#errGender');


        $('#btn-modal-daftar').prop('disabled', !(isNameValid && isAlamatValid && isBirthDateValid && isGenderValid && isPhoneValid && isEmailValid && isPassValid && isCPassValid && isTnCCheck));
    }

    function validateFormDaftarResPart1() {
        var isNameValid = false;
        var isAlamatValid = false;
        var isBirthDateValid = false;
        var isGenderValid = false;

        isNameValid = validateName('#nama-daftar-res', '#errNamaDaftarRes');
        isAlamatValid = validateAlamat('#alamat-daftar-res', '#errAlamatDaftarRes');
        isBirthDateValid = validateBirth('#birth-daftar-res', '#errBirthDaftarRes');
        isGenderValid = validateGender('#genderRes', '#errGenderRes');

        $('#btn-modal-daftar-next').prop('disabled', !(isNameValid && isAlamatValid && isBirthDateValid && isGenderValid ));
    }

    function validateFormDaftarResPart2() {
        var isPhoneValid = false;
        var isEmailValid = false;
        var isPassValid = false;
        var isCPassValid = false;
        var isTnCCheck = false;

        isPhoneValid = validatePhone('#phone-daftar-res', '#errPhoneDaftarRes');
        isEmailValid = validateEmail('#email-daftar-res', '#errEmailDaftarRes');
        isPassValid = validatePass('#pass-daftar-res', '#errPassDaftarRes');
        isCPassValid = validateCPass('#pass-daftar-res', '#cpass-daftar-res', '#errCPassDaftarRes');
        isTnCCheck = validateTnC('#tcRes', '#errTCRes');

        $('#btn-modal-daftar-res').prop('disabled', !(isPhoneValid && isEmailValid && isPassValid && isCPassValid && isTnCCheck));
    }

    function validateFormLogin(idEmail, idPass, idErrEmail, idErrPass, idButton) {
        var isEmailValid = false;
        var isPassValid = false;

        isEmailValid = validateEmail(idEmail, idErrEmail);
        isPassValid = validatePass(idPass, idErrPass);
        $(idButton).prop('disabled', !(isEmailValid && isPassValid));
    }

    function validateName(idName, idError) {
        var nama = $(idName).val();
        var stringPattern = /^[a-zA-Z ]*$/;

        if (nama == "") {
            $(idError).css("display", "block");
            $(idError).html("*Please input your name.");
            return false;
        } else if (stringPattern.test(nama) == false) {
            $(idError).css("display", "block");
            $(idError).html("*Your name contains number.");
            return false;
        } else {
            $(idError).css("display", "none");
            return true;
        }
    }

    function validateAlamat(idAlamat, idError) {
        var alamat = $(idAlamat).val();

        if (alamat == "") {
            $(idError).css("display", "block");
            $(idError).html("*Please input your address.");
            return false;
        } else {
            $(idError).css("display", "none");
            return true;
        }
    }

    function validatePhone(idPhone, idError) {
        var phone = $(idPhone).val();
        var phonePattern = /^08[0-9]*$/;

        if (phone == "") {
            $(idError).css("display", "block");
            $(idError).html("*Please input your phone number.");
            return false;
        } else if (phonePattern.test(phone) == false || phone.length > 13) {
            $(idError).css("display", "block");
            $(idError).html("*Wrong phone number.");
            return false;
        } else {
            $(idError).css("display", "none");
            return true;
        }
    }

    function validateEmail(idEmail, idErrorEmail) {
        var email = $(idEmail).val();
        var emailPattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (email == "") {
            $(idErrorEmail).css("display", "block");
            $(idErrorEmail).html("*Please input your email.");
            return false;
        } else if (emailPattern.test(email) == false) {
            $(idErrorEmail).css("display", "block");
            $(idErrorEmail).html("*Wrong email.");
            return false;
        } else {
            $(idErrorEmail).css("display", "none");
            return true;
        }
    }

    function validatePass(idPass, idErrorPas) {
        var pass = $(idPass).val();

        if (pass == "") {
            $(idErrorPas).css("display", "block");
            $(idErrorPas).html("*Please input your Password.");
            return false;
        } else {
            $(idErrorPas).css("display", "none");
            return true;
        }
    }

    function validateCPass(idPass, idCPass, idError) {
        var confirm_pass = $(idCPass).val();
        var pass = $(idPass).val();

        if (confirm_pass == "") {
            $(idError).css("display", "block");
            $(idError).html("*Please reinput the password.");
            return false;
        } else if (pass != confirm_pass) {
            $(idError).css("display", "block");
            $(idError).html("*Password didn't match.");
            return false;
        } else {
            $(idError).css("display", "none");
            return true;
        }
    }

    function validateTnC(idTnC, idError) {
        var tnc_status = $(idTnC).prop('checked');
        if (!tnc_status) {
            $(idError).css("display", "block");
            $(idError).html("*Please agree to terms and conditions.");
            return false;
        } else {
            $(idError).css("display", "none");
            return true;
        }
    }

    function validateBirth(idBirth, idError) {
        var birth = $(idBirth).val();
        if (!birth) {
            $(idError).css("display", "block");
            $(idError).html("*Please input your birthdate.");
            return false;
        } else {
            $(idError).css("display", "none");
            return true;
        }
    }

    function validateGender(idGender, idError) {
        var gender = $(idGender).val();
        if (!gender) {
            $(idError).css("display", "block");
            $(idError).html("*Please select your Gender.");
            return false;
        } else {
            $(idError).css("display", "none");
            return true;
        }
    }

    $('#btn-modal-daftar').prop('disabled', true);
    $('#btn-modal-login').prop('disabled', true);
    $('#btn-modal-login-res').prop('disabled', true);
    $('#btn-modal-daftar-next').prop('disabled', true);
    $('#btn-modal-daftar-res').prop('disabled', true);

    $('#nama-daftar-res').on('keyup', function(e) {
        validateFormDaftarResPart1();
    });

    $('#nama').on('keyup', function(e) {
        validateFormDaftar();
    });

    $('#alamat-daftar-res').on('keyup', function(e) {
        validateFormDaftarResPart1();
    });

    $('#alamat').on('keyup', function(e) {
        validateFormDaftar();
    });

    $('#phone-daftar-res').on('keyup', function(e) {
        validateFormDaftarResPart2();
    });

    $('#no-hp').on('keyup', function(e) {
        validateFormDaftar();
    });

    $('#email-daftar-res').on('keyup', function(e) {
        validateFormDaftarResPart2();
    });

    $('#email').on('keyup', function(e) {
        validateFormDaftar();
    });

    $('#pass-daftar-res').on('keyup', function(e) {
        validateFormDaftarResPart2();
    });

    $('#pass').on('keyup', function(e) {
        validateFormDaftar();
    });

    $('#cpass-daftar-res').on('keyup', function(e) {
        validateFormDaftarResPart2();
    });

    $('#confirm-pass').on('keyup', function(e) {
        validateFormDaftar();
    });

    $('#tcRes').on('click', function(e) {
        validateFormDaftarResPart2();
    });

    $('#tc').on('click', function(e) {
        validateFormDaftar();
    });

    $('#birth-daftar-res').on('change', function(e) {
        validateFormDaftarResPart1();
    });

    $('#tgl-lahir').on('change', function(e) {
        validateFormDaftar();
    });

    $('#genderRes').on('change', function(e) {
        validateFormDaftarResPart1();
    });

    $('#gender').on('change', function(e) {
        validateFormDaftar();
    });

    $('#email-login').on('keyup', function(e) {
        validateFormLogin('#email-login', '#pass-login', '#errEmailLogin', '#errPassLogin', '#btn-modal-login');
    });

    $('#pass-login').on('keyup', function(e) {
        validateFormLogin('#email-login', '#pass-login', '#errEmailLogin', '#errPassLogin', '#btn-modal-login');
    });

    $('#email-login-res').on('keyup', function(e) {
        validateFormLogin('#email-login-res', '#pass-login-res', '#errEmailLoginRes', '#errPassLoginRes', '#btn-modal-login-res');
    });

    $('#pass-login-res').on('keyup', function(e) {
        validateFormLogin('#email-login-res', '#pass-login-res', '#errEmailLoginRes', '#errPassLoginRes', '#btn-modal-login-res');
    });

});