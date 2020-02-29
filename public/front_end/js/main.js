$(document).ready(function() {
    $("#bannerhd").lightSlider({
        item: 1,
        loop: true,
        auto: true
    });
    $("#touch-on").click(function() {
        $(this).addClass("active"),
        $("header").addClass("active");
        $('.overlay-sticker').show();
    });
    $("#touch-off, .overlay-sticker").click(function(){
        $("header, #touch-on").removeClass("active");
        $('.overlay-sticker').hide();
    });
});
new WOW().init();