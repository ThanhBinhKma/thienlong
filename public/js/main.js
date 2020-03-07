$('#owl-hotel-offers').owlCarousel({
    items:3,
    loop:true,
    margin:10,
    loop: true,
    autoplay: true,
    nav : true,
    navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
});
$('#owl-tour-offers').owlCarousel({
    items:3,
    loop:true,
    margin:30,
    loop: true,
    autoplay: true,
    nav : true,
    navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
});

$('.flexslider').flexslider({
    animation: "slide",
    flexDirectionNav: false,
    controlNav: false,
});
    // Cache Selectors
    var mainWindow      =$(window),
    mainDocument    =$(document),
    myLoader        =$(".loader"),
    myNav           =$(".main-navbar"),
    mytopBar        =$('#top-bar'),
    searchBtn       =$(".search-button"),
    closeBtn        =$("#close-button"),
    closeButn       =$("#closebtn"),
    menuBtn         =$("#menu-button"),
    mySidenav       =$("#mySidenav"),
    overlay         =$(".overlay");


    // Loader
    mainWindow.on('load', function () {
    myLoader.fadeOut("slow");
    });


    myNav.affix({
    offset: { 
    top: function() { return mytopBar.height(); }
    }
    });

    searchBtn.click(
    function(){
    overlay.css('transform','translateY(0%)');
    });

    closeBtn.click(
    function(){
    overlay.css('transform','translateY(-120%)');
    });

    menuBtn.on('click',
    function(){
    mySidenav.css('transform','translateX(0%)');
    });

    closeButn.on('click',
    function(){
    mySidenav.css('transform','translateX(120%)');
    });

$('.feature-slider').not('.slick-initialized').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.feature-slider-nav',
  autoplay: true,
  autoplaySpeed: 4000,
  adaptiveHeight: true
});


$('.feature-slider-nav').not('.slick-initialized').slick({
  centerMode: false,
  slidesToShow: 4,
  slidesToScroll: 1,
  focusOnSelect: true,
  asNavFor: '.feature-slider',
  autoplay: true,
  autoplaySpeed: 4000,
  adaptiveHeight: true,
  infinite:true,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2
      }
    }
  ]
});

var video     = $('.popup-youtube');


//Magnific Video 
video.magnificPopup({
  disableOn: 700,
  type: 'iframe',
  mainClass: 'mfp-fade',
  removalDelay: 160,
  preloader: false,
  fixedContentPos: false
});
