// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    var zvalue = $(this).scrollTop();
    if ($(window).width() > 900) {
         if (zvalue > 80) {
            $("#header__imglogo").addClass("header__imglogo--scrolled");
            $("#header_mainmenu").addClass("header__mainmenu--scrolled");
          } else {
            $("#header__imglogo").removeClass("header__imglogo--scrolled");
            $("#header_mainmenu").removeClass("header__mainmenu--scrolled");
          }  
    }
} 