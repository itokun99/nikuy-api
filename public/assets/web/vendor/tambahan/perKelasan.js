$(document).ready(function(){
    // $('.btn-dropdown').click(function(e){
    //     e.preventDefault();
    //     if($('.drop-menu').css('display') == 'none')
    //     {
    //         $('.drop-menu').css('display', 'block');
    //         $('.btn-dropdown img').attr("src", "./img/Collapse Arrow Up.png");
    //     }else{
    //         $('.drop-menu').css('display', 'none');
    //         $('.btn-dropdown img').attr("src", "./img/Collapse Arrow Down.png");
    //     }
    // });

    $('.btn-dropdown').click(function(e){
        e.preventDefault();
        let id = e.target.id;
        if($('.cs-drop-menu'+id).css('display') == 'none')
        {
            $('.cs-drop-menu'+id).css('display', 'block');
            $('.cs-btn-dropdown'+id+' img').attr("src", "/assets/img/Collapse Arrow Up.png");
        }else{
            // $('a#'+id+' .drop-menu').css('display', 'none');
            $('.cs-drop-menu'+id).css('display', 'none');
            // $('a#'+id+'.btn-dropdown img').attr("src", "/assets/img/Collapse Arrow Down.png");
            $('.cs-btn-dropdown'+id+' img').attr("src", "/assets/img/Collapse Arrow Down.png");
        }
    });


    $('#unduh').click(function(e){
        e.preventDefault();
        $('.course-banner').css('display','none');
        $('.course-content').css('display', 'none');
        $('.unduh-content').css('display','inline-block');
        $("#unduh").addClass("active");
        $("#unduh").addClass("last-click");
    });

    $('#gem1').click(function(e){
        e.preventDefault();
        $("#gem1").addClass("active");
        $(".last-click").removeClass("active");
        $("#unduh").addClass("last-click");
        $('.course-content').css('display', 'inline-block');

    });

    $('#konten1').click(function(e){
        e.preventDefault();
        if($('.drop-menu-content').css('display') == 'none'){
            $('.drop-menu-content').css('display','block');
            $('.btn-dropdown-content img').attr("src", "./img/Collapse Arrow Up.png");
        }else{
            $('.drop-menu-content').css('display','none');
            $('.btn-dropdown-content img').attr("src", "./img/Collapse Arrow Down.png");
        }
        
    });

    $(".btn-rating").click(function(e){
        e.preventDefault();
        $('.modal-rating-content').css('display', 'inline-block');
    });

    $(".close-modal-rating").click(function(e){
        e.preventDefault();
        $('.modal-rating-content').css('display', 'none');
        $('.modal-rated-content').css('display', 'none');
    });

    $(".btn-form-rating").click(function(e){
        e.preventDefault();
        $('.modal-rated-content').css('display', 'inline-block');
    });

});