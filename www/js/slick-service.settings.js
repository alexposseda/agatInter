function createSlider(){
    calcInitialSlide();
    $('.vertical-slider').slick({
        vertical: true,
        slidesToShow: slideCount,
        infinite: false,
        dots: true,
        initialSlide: initialSlide,
        dotsClass: 'vertical-slider-dots',
        prevArrow: '<span class="vertical-slider-button vertical-slider-button-up"></span>',
        nextArrow: '<span class="vertical-slider-button vertical-slider-button-down"></span>',

    });
}

function calcInitialSlide(){
    getBaseSetting();
    if($(window).height() < slideCollectionHeight){
        slideCount +=  Math.floor(($(window).height() - slideCollectionHeight) / $('.vertical-slider-item').height()) - 1;
        if(slideCount <= 0){
            slideCount = 1;
        }
        initialSlide = Math.floor(slideCount / 2);
    }
}

function getBaseSetting(){
    slideCount = $('.vertical-slider-item').length;
    slideCollectionHeight = $('.vertical-slider-item').height() * $('.vertical-slider-item').length;
    initialSlide = 0;
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

$('.vertical-slider-item').on('click', function(){
    $('.vertical-slider-item').removeClass('active');
    $(this).addClass('active');
});

$(window).on('resize', function(){
    $('.vertical-slider').slick('unslick');
    createSlider();
});

createSlider();

$('.vertical-slider').on('afterChange', function(event, slick, currentSlide){
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