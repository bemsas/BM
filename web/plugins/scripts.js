$(function(){
    $('.scroll-area').scrollbar();

    if($('.date-slider').length){

        var custom_values = $('.js-date-slider').data('dates').split(',');

        $(".js-date-slider").ionRangeSlider({
            values: custom_values,
        });
    }
});
