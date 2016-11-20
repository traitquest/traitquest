$(document).ready(function() {
  function setHeight() {
    windowHeight = $(window).innerHeight();
    $('.sideBar').css('min-height', windowHeight);
  };
  setHeight();

  $(window).resize(function() {
    setHeight();
  });



});
