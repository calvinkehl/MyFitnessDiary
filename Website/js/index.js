var header = $("#nav-container");
  $(window).scroll(function() {    
    var scroll = $(window).scrollTop();
       if (scroll >= 1) {
          header.addClass("fixed");
        } else {
          header.removeClass("fixed");
        }
});