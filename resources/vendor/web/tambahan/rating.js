$(document).ready(function () 
{
    // $(".bintang1").click(function (e) 
    // { 
    //     $('.bintang1 img').attr("src", "./img/Star_2.png");
    //     $('.bintang2 img').attr("src", "./img/Star_1.png");
    //     $('.bintang3 img').attr("src", "./img/Star_1.png");
    //     $('.bintang4 img').attr("src", "./img/Star_1.png");
    //     $('.bintang5 img').attr("src", "./img/Star_1.png");
    //     $('.bintang').val('1');
    // });   
    // $(".bintang2").click(function (e) 
    // { 
    //     $('.bintang1 img').attr("src", "./img/Star_2.png");
    //     $('.bintang2 img').attr("src", "./img/Star_2.png");
    //     $('.bintang3 img').attr("src", "./img/Star_1.png");
    //     $('.bintang4 img').attr("src", "./img/Star_1.png");
    //     $('.bintang5 img').attr("src", "./img/Star_1.png");
    //     $('.bintang').val('2');
    // }); 
    // $(".bintang3").click(function (e) 
    // { 
    //     $('.bintang1 img').attr("src", "./img/Star_2.png");
    //     $('.bintang2 img').attr("src", "./img/Star_2.png");
    //     $('.bintang3 img').attr("src", "./img/Star_2.png");
    //     $('.bintang4 img').attr("src", "./img/Star_1.png");
    //     $('.bintang5 img').attr("src", "./img/Star_1.png");
    //     $('.bintang').val('3');
    // });    
    // $(".bintang4").click(function (e) 
    // { 
    //     $('.bintang1 img').attr("src", "./img/Star_2.png");
    //     $('.bintang2 img').attr("src", "./img/Star_2.png");
    //     $('.bintang3 img').attr("src", "./img/Star_2.png");
    //     $('.bintang4 img').attr("src", "./img/Star_2.png");
    //     $('.bintang5 img').attr("src", "./img/Star_1.png");
    //     $('.bintang').val('4');
    // }); 
    // $(".bintang5").click(function (e) 
    // { 
    //     $('.bintang1 img').attr("src", "./img/Star_2.png");
    //     $('.bintang2 img').attr("src", "./img/Star_2.png");
    //     $('.bintang3 img').attr("src", "./img/Star_2.png");
    //     $('.bintang4 img').attr("src", "./img/Star_2.png");
    //     $('.bintang5 img').attr("src", "./img/Star_2.png");
    //     $('.bintang').val('5');
    // }); 

    var star_val = $("#star_val").val();
    if(star_val == 1){
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_5.svg");
        $("#star3").attr("src", "/assets/img/Star_5.svg");
        $("#star4").attr("src", "/assets/img/Star_5.svg");
        $("#star5").attr("src", "/assets/img/Star_5.svg");
    }else if(star_val == 2){
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_6.svg");
        $("#star3").attr("src", "/assets/img/Star_5.svg");
        $("#star4").attr("src", "/assets/img/Star_5.svg");
        $("#star5").attr("src", "/assets/img/Star_5.svg");
    }else if(star_val == 3){
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_6.svg");
        $("#star3").attr("src", "/assets/img/Star_6.svg");
        $("#star4").attr("src", "/assets/img/Star_5.svg");
        $("#star5").attr("src", "/assets/img/Star_5.svg");
    }else if(star_val == 4){
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_6.svg");
        $("#star3").attr("src", "/assets/img/Star_6.svg");
        $("#star4").attr("src", "/assets/img/Star_6.svg");
        $("#star5").attr("src", "/assets/img/Star_5.svg");
    }else if(star_val == 5){
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_6.svg");
        $("#star3").attr("src", "/assets/img/Star_6.svg");
        $("#star4").attr("src", "/assets/img/Star_6.svg");
        $("#star5").attr("src", "/assets/img/Star_6.svg");
    }

    $("#star1").click(function (e) {
        $("#star_val").attr("value", 1);
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_5.svg");
        $("#star3").attr("src", "/assets/img/Star_5.svg");
        $("#star4").attr("src", "/assets/img/Star_5.svg");
        $("#star5").attr("src", "/assets/img/Star_5.svg");
    }); 

    $("#star2").click(function (e) {
        $("#star_val").attr("value", 2);
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_6.svg");
        $("#star3").attr("src", "/assets/img/Star_5.svg");
        $("#star4").attr("src", "/assets/img/Star_5.svg");
        $("#star5").attr("src", "/assets/img/Star_5.svg");
    }); 

    $("#star3").click(function (e) {
        $("#star_val").attr("value", 3);
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_6.svg");
        $("#star3").attr("src", "/assets/img/Star_6.svg");
        $("#star4").attr("src", "/assets/img/Star_5.svg");
        $("#star5").attr("src", "/assets/img/Star_5.svg");
    }); 

    $("#star4").click(function (e) {
        $("#star_val").attr("value", 4);
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_6.svg");
        $("#star3").attr("src", "/assets/img/Star_6.svg");
        $("#star4").attr("src", "/assets/img/Star_6.svg");
        $("#star5").attr("src", "/assets/img/Star_5.svg");
    }); 

    $("#star5").click(function (e) {
        $("#star_val").attr("value", 5);
        $("#star1").attr("src", "/assets/img/Star_6.svg");
        $("#star2").attr("src", "/assets/img/Star_6.svg");
        $("#star3").attr("src", "/assets/img/Star_6.svg");
        $("#star4").attr("src", "/assets/img/Star_6.svg");
        $("#star5").attr("src", "/assets/img/Star_6.svg");
    }); 

});