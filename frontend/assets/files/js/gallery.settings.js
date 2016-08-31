var slideCount = $('.vertical-slider-item').length;
var slideCollectionHeight = $('.vertical-slider-item').height() * $('.vertical-slider-item').length;
var initialSlide = 0;

$('.vertical-slider').slick({
    vertical: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: false,
    dots: true,
    centerMode: true,
    focusOnSelect: true,
    initialSlide: initialSlide,
    dotsClass: 'vertical-slider-dots',
    prevArrow: '<span class="vertical-slider-button vertical-slider-button-up"></span>',
    nextArrow: '<span class="vertical-slider-button vertical-slider-button-down"></span>',
    asNavFor: '.big-vertical-slider'
});
$('.big-vertical-slider').slick({
    vertical: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.vertical-slider'
});
