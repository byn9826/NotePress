$( document ).ready(function() {
  
    $(".aside-title").click(function() {
      var index = $(".aside-title").index(this);
      if (index === 0) {
        $("#aside-note").toggle();
      } else {
        $("#aside-tag").toggle();
      }
      var arrow = $(".aside-title").eq(index).children("span"); 
      if (arrow.html() === "➙") {
        arrow.html("&#10136;");
      } else {
        arrow.html("&#10137;");
      }
      
    })
    
});