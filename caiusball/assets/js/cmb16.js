$( document ).ready(function() {
  $("img#logo").fadeIn(4000, "swing");

  $('ul.nav.navbar-nav > li > a').click(function(event) {
    event.preventDefault();
    var hash = this.hash;
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 1200, "swing", function(){
      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
    });

    $(".navbar-collapse").collapse('hide');
  });

	function pad(num, size) {
	    var s = "000000000" + num;
	    return s.substr(s.length-size);
	}

	var wheight = $( window ).height();
  var docheight = $( document ).height();
  var bgheight = $( '#bgpic' ).height();

  setTimeout(function() {
    wheight = $( window ).height();
    docheight = $( document ).height();
    bgheight = $( '#bgpic' ).height();
  }, 250);

  var opacity = 1;
  var canshowlines = true;

	$(window).scroll(function () {
    if(($( window ).width() / $( window ).height()) > 0.75) {
      var newtop = -1 * (bgheight - wheight) * ($(document).scrollTop() / (docheight - wheight));

      $('#bgpic').css("top", newtop);
      $('#linespic').css("top", newtop);

      if(canshowlines) {
        $('#linespic').fadeIn(1200);
        $.doTimeout( 'scroll', 500, function(){
          canshowlines = false;
          $( '#linespic' ).fadeOut( 1200 );
          $.doTimeout( 1200, function(){
            canshowlines = true;
          });
        });
      }
    }
    if($( window ).width() >= 992) {
      // opacity = 0.1 + (0.9 * Math.pow( Math.cos(($(document).scrollTop() / wheight) * Math.PI) ,2));
      // $('.logopic').css("opacity", opacity);
      
      var percentscroll = Math.round(((($(document).scrollTop() + (wheight/2)) % wheight) / wheight) * 100) + 1;
      $('.smokepic').attr("src", "assets/images/smokelq/colour_composite_0"+pad(percentscroll,3)+"-min.png");
    }
    if($( window ).width() >= 768) {
      if($(document).scrollTop() <= wheight - 40) {
        opacity = 0.5 + (0.5 * Math.pow( Math.cos((($(document).scrollTop() / (wheight-40)) * Math.PI) ,2)));
        $('nav').css("opacity", opacity);
        $('nav').css("bottom", ($(document).scrollTop() - 40) + "px");
        var shade = 0.95 * (($(document).scrollTop() - (wheight*0.9)) / ((wheight*0.1) - 40));
        if(shade<0) shade = 0;
        $('nav').css("background", "-moz-linear-gradient(top, rgba(0,0,0,"+shade+") 0%, rgba(0,0,0,"+shade+") 40%, rgba(0,0,0,0) 100%)");
        $('nav').css("background", "-webkit-linear-gradient(top,  rgba(0,0,0,"+shade+") 0%,rgba(0,0,0,"+shade+") 40%,rgba(0,0,0,0) 100%)");
        $('nav').css("background", "linear-gradient(to bottom,  rgba(0,0,0,"+shade+") 0%,rgba(0,0,0,"+shade+") 40%,rgba(0,0,0,0) 100%)");
      }
      else {
        $('nav').css("opacity", 1);
        $('nav').css("bottom", (wheight - 80) + "px");
        $('nav').css("background", "-moz-linear-gradient(top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.95) 40%, rgba(0,0,0,0) 100%)");
        $('nav').css("background", "-webkit-linear-gradient(top,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 40%,rgba(0,0,0,0) 100%)");
        $('nav').css("background", "linear-gradient(to bottom,  rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.95) 40%,rgba(0,0,0,0) 100%)");
      }
    }

    // var logoresult = 0.25 + (0.75 * (1 / (Math.exp(($(document).scrollTop() / (wheight / 6))))));
    // $('#logo').stop().css("opacity", logoresult);
    var size = 85 + (15 * (1 / (Math.exp(($(document).scrollTop() / (wheight / 4))))));
    $('#logo').css("width", size + "%");

	});

	$( window ).resize(function() {
    wheight = $( window ).height();
    docheight = $( document ).height();
    bgheight = $( '#bgpic' ).height();
  });

  if($( window ).width() >= 768) {
    var img = [];
    var i = 1;
    for (i = 1; i <= 101; i++) {
      img[i] = new Image();
      img[i].src = "assets/images/smokelq/colour_composite_0"+pad(i,3)+"-min.png";
    }
  }
});