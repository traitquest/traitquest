$(document).ready(function(){

$("#openMobileNav").click(openNav);
  function openNav() {
    document.getElementById("mobileNav").style.width = "100%";
  }

$("#closeMobileNav").click(closeNav);
  function closeNav() {
    document.getElementById("mobileNav").style.width = "0";
  }

$(".closeMobileNav").click(closeNav);
  function closeNav() {
    document.getElementById("mobileNav").style.width = "0";
  }

});
