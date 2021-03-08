$(document).ready(function() {

    $('#hamburger').click(function() {
        var x = $(window).width();
        $('nav').css("left", "0");
        $('body').css("width", (x - 300) + "px");
        $('body').css("margin-left", "300px");
    });

    $('#nav-close').click(function() {
        $('nav').css("left", "-100%");
        $('body').css("width", "100vw");
        $('body').css("margin-left", "0");
    });

    $('#search-div').click(function() {
        var flag = $(this).data("flag");
        if (flag == 'close') {
            $('#search-form').css("left", "50%");
            $(this).data('flag', 'open');
        } else {
            $('#search-form').css("left", "150%");
            $(this).data('flag', 'close');
        }
    });

    $(window).on('mousedown', function(event) {
        if (event.target.id != 'search-input' && event.target.parentNode.id != 'search-input') {
            $('#search-form').css("left", "150%");
            $('#search-div').data('flag', 'close');
        }
    });

    $('#footer').css('margin-top', '-' + $('#footer').height() + 'px');
    $('.wrapper').css('padding-bottom', $('#footer').height() + 'px');


});