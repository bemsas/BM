$(function(){
    $('.scroll-area').scrollbar();

    var custom_values = $('.js-date-slider').data('dates').split(',');

    $(".js-date-slider").ionRangeSlider({
        values: custom_values,

        onChange: function(data) {
            console.log("value", data.from)
        }
    });
});
