function createSlider(){
    calcInitialSlide();
    $('.gallery-list').slick({
        vertical: true,
        slidesToShow: slideCount,
        infinite: false,
        dots: true,
        initialSlide: initialSlide,
        dotsClass: 'vertical-slider-dots',
        prevArrow: '<span class="vertical-slider-button vertical-slider-button-up"></span>',
        nextArrow: '<span class="vertical-slider-button vertical-slider-button-down"></span>',
        asNavFor: '.gallery-big',
        focusOnSelect: true,


    });
    $('.gallery-big').slick({
        vertical: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        initialSlide: 0,
        arrows: false,
    });
}


function calcInitialSlide(){
    getBaseSetting();
    if($(window).height() < slideCollectionHeight){
        slideCount =  Math.floor(($(window).height() - slideCollectionHeight) / $('.gallery-list .vertical-slider-item').height()) - 1;
        if(slideCount <= 0){
            slideCount = 1;
        }
        initialSlide = Math.floor(slideCount / 2);
    }
}

function getBaseSetting(){
    slideCount = $('.gallery-list .vertical-slider-item').length;
    slideCollectionHeight = $('.gallery-list .vertical-slider-item').height() * $('.gallery-list .vertical-slider-item').length;
    initialSlide = 0;
}

function showBigPicture(){
    $('#big-picture').fadeIn(500);
    $('#big-picture')
        .find('img')
        .attr('src', $(this).attr('src'))
        .animate({
            opacity: 1,
        }, 500);
    if($(this).data('caption')){
        $('#big-picture').find('.big-picture-description').text($(this).data('caption')).css('right', 0);
    }
}

function hideBigPicture(){
    $('#big-picture')
        .fadeOut(500)
        .find('img').animate({opacity: 0}, 500).attr('src', '');
    $('#big-picture').find('.big-picture-description').css('right', '-300px').text('');
    $('#big-picture').css('display', 'none');
}

var slideCount;
var slideCollectionHeight;
var initialSlide = 0;

$('.vertical-slider-scroll-zone').on('mousewheel',function(e){
    if(e.originalEvent.deltaY > 0){
        $('.vertical-slider-button-down').trigger('click');
    }else{
        $('.vertical-slider-button-up').trigger('click');
    }
});

$('.gallery-list .vertical-slider-item').on('click', function(){
    $('.gallery-list .vertical-slider-item').removeClass('active');
    $(this).addClass('active');
});

$(window).on('resize', function(){
    $('.vertical-slider').slick('unslick');
    createSlider();
});

createSlider();

$('.gallery-big img').on('click', showBigPicture);
$('#big-picture').on('click', hideBigPicture);
$('.gallery-list').on('afterChange', function(event, slick, currentSlide){
    console.log(currentSlide);
    if(currentSlide == 0){
        $('.vertical-slider-button-up').hide();
    }else{
        $('.vertical-slider-button-up').show();
    }

    if(currentSlide + slideCount == $('.vertical-slider-item').length){
        $('.vertical-slider-button-down').hide();
    }else{
        $('.vertical-slider-button-down').show();
    }
})
