$(document).ready(function () {
    $("body").append("<span id='back-to-top' class='btn btn-sm btn-default' style='cursor: pointer; position: fixed; bottom: 10px; right: 10px; display: none;'><i class='glyphicon glyphicon-chevron-up text-primary'></i></span>");
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    $('#back-to-top').click(function () {
        $('body,html').animate({ scrollTop: 0 }, 800);
        return false;
    });
});