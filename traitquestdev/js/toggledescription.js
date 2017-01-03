$(document).ready(function(){
  $("p.kpidetail").hide();

  $("#toggledescription1").click(function() {
    $("#kpidetail1").toggle();
    $("i", this).toggleClass("glyphicon-minus");
  });

  $("#toggledescription2").click(function() {
    $("#kpidetail2").toggle();
    $("i", this).toggleClass("glyphicon-minus");
  });
});
