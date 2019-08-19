$(document).ready(function () {

    
    //slider
    $('.clients-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'linear',
        responsive: [
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
    $('.js-partners').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'linear',
        arrows: false,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 2
          }
        }
      ]
    });
    
    
    //datepicker
    $('.datepicker').datepicker();
    
    
    //form tabulation
    $('.js-roundtrip').click(function(){
        $('.form-tab').hide();
        $('.roundtrip').show();
    });
    $('.js-oneway').click(function(){
        $('.form-tab').hide();
        $('.oneway').show();
    });
    $('.js-multy').click(function(){
        $('.form-tab').hide();
        $('.multy').show();
    });
    
    
    //form add/delete row

    $('.form-tab').on('click', '.delete-row', function(){
        $(this).parent().slideUp();
        if ($('.block-multy-city').length > 1){
            $(this).parent().remove();
        }

    });

    $('.add-row').click(function(){
        var count = parseInt($(this).parents('form').attr('data-cityCount') );
        if ($('.block-multy-city:visible').length == 0 ){
            $('.multy .block-multy-city').slideDown();
        }else {
            var firstRow = $('.multy .block-multy-city:first');
            var lastRow = $('.multy .block-multy-city:last');
            $(firstRow).clone().insertAfter(lastRow).hide().slideDown();

            count++;
           $(this).parents('form').attr('data-cityCount',count) ;
            $('.multy .block-multy-city:last input').each(function () {
               var name = $(this).attr('name');
                $(this).attr('name' ,name + count);
            });
        }
        rq_initUIElements();
    });
    
    
    //form dropdown
    $('.class-type').click(function(){
        $(this).parent().find('.dropdown-menu').toggle();
    });
    
    
    //plus-minus
    var count1 = 1;
    var countEl1 = document.getElementById("count1");
    $('#plus1').click(function(){
        count1++;
        countEl1.value = count1;
        $(this).closest('.input-dropdown').find(".number").text(count1);
    });
    $('#minus1').click(function(){
      if (count1 > 1) {
        count1--;
        countEl1.value = count1;
        $(this).closest('.input-dropdown').find(".number").text(count1);
      }  
    });
    var count2 = 1;
    var countEl2 = document.getElementById("count2");
    $('#plus2').click(function(){
        count2++;
        countEl2.value = count2;
        $(this).closest('.input-dropdown').find(".number").text(count2);
    });
    $('#minus2').click(function(){
      if (count2 > 1) {
        count2--;
        countEl2.value = count2;
        $(this).closest('.input-dropdown').find(".number").text(count2);
      }  
    });
    var count3 = 1;
    var countEl3 = document.getElementById("count3");
    $('#plus3').click(function(){
        count3++;
        countEl3.value = count3;
        $(this).closest('.input-dropdown').find(".number").text(count3);
    });
    $('#minus3').click(function(){
      if (count3 > 1) {
        count3--;
        countEl3.value = count3;
        $(this).closest('.input-dropdown').find(".number").text(count3);
      }  
    });
    
    
    //select
    $('#cabin1').click(function(){
        var cabin = $('#cabin1 option:selected').text();
        $('#cabin1').closest('.input-dropdown').find(".type-class").text(cabin);
    });
    $('#cabin2').click(function(){
        var cabin = $('#cabin2 option:selected').text();
        $('#cabin2').closest('.input-dropdown').find(".type-class").text(cabin);
    });
    $('#cabin3').click(function(){
        var cabin = $('#cabin3 option:selected').text();
        $('#cabin3').closest('.input-dropdown').find(".type-class").text(cabin);
    });
    
    
    //form dropdown
    $('.mobile-title').click(function(){
        $('.header-bottom-nav').slideToggle();
    });
    
    
    // Hide Header on on scroll down
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();    
        if (scroll <= 5) {
            $(".header-bottom").removeClass("fixed");
        } else {
            $(".header-bottom").addClass("fixed");
        }
    });
    $('.js-request-but').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1100);
    })
    
});
