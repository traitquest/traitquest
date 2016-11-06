$(document).ready(function(){

  $('body').scrollspy({target: ".navbar", offset: 50}); // add scrollspy to <body>


  $("#Navbar a").on('click', function(event) { // add smooth scrolling

    if (this.hash !== "") { // make sure this.hash has a value before overriding default behavior

      event.preventDefault(); // prevent default anchor click behavior

      var hash = this.hash; // store hash

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 400, function(){


        window.location.hash = hash; // add hash to URL when done scrolling (default click behavior)
      });
    }  // end if
  });
});
