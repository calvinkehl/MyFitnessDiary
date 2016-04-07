var nav = $("#nav-container");
var dumNav = $('#dummy-nav');
  $(window).scroll(function() {    
    var scroll = $(window).scrollTop();
       if (scroll >= 1) {
          nav.addClass("fixed");
          dumNav.height(nav.height());
        } else {
          nav.removeClass("fixed");
          dumNav.height(0);
        }
});

