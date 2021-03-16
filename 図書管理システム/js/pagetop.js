$(function() {
   $(window).scroll(function () {
      var TargetPos = 350;
      var ScrollPos = $(window).scrollTop();
      if( ScrollPos >= TargetPos) {
         $("#topbutton").fadeIn();
      }
      else {
         $("#topbutton").fadeOut();
      }
   });
});