$( document ).ready(function() {
  
  $(".main-list").eq(0).addClass("main-active");
  
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
  });
  
  $(".main-list").click(function() {
    alert($(".main-list").index(this));
  });
                          
});