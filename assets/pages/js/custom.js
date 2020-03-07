$(document).ready(function() {
$(".nav-link").click(function () {
    $(".nav-link").removeClass("active");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("active");   
});
});
$(document).ready(function() {
$("#myTab li").click(function () {
    $("#myTab li").removeClass("active");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("active");   
});
});

$("#carousel").owlCarousel({
  loop: true,
  margin: 20,
  nav: true,
  autoplay: true,
  autoPlaySpeed: 5000,
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 1
    },

    1024: {
      items: 1
    }
}
});
	$("#clinet").owlCarousel({
  loop: true,
  margin: 20,
  nav: true,
  autoplay: true,
  autoPlaySpeed: 500,
  responsive: {
    0: {
      items: 2
    },

    600: {
      items: 3
    },

    1024: {
      items: 5
    }
}
});

	$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav',
	autoplay: true
});
$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  centerMode: false,
  focusOnSelect: true,
  autoplay: true,
  responsive: [
        {
            breakpoint: 980, // tablet breakpoint
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 600, // mobile breakpoint
            settings: {
                slidesToShow: 2
               
            }
        },
        {
            breakpoint: 480, // mobile breakpoint
            settings: {
                slidesToShow: 1
               
            }
        }

    ]

});