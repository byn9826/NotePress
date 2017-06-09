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
    var list = JSON.parse($("#data-list").text());
    let position = $(".main-list").index(this);
    let replace = list[position];
    $(".main-list").removeClass("main-active");
    $(".main-list").eq(position).addClass("main-active");
    var ajax_data = {
      action: "readBook",
      nt_action: "readNote",
      readNote_id: replace.ID
    };
    $.post("/wp-admin/admin-ajax.php", ajax_data,
      function (data) {
        //console.log(data);
        data = JSON.parse(data);
      
        //replace title
        $("#one").empty();
        $("<h1/>", {
          text: replace.post_title
        }).appendTo("#one");  
      
        //replace categories
        if (data[0].length !== 0) {
          data[0].map(function(c){
            var ajax_inner = {
              action: "readBook",
              nt_action: "getCatName",
              getCatName_id: c
            }
            $.post("/wp-admin/admin-ajax.php", ajax_inner,
              function (cat) {
                cat = JSON.parse(cat);
                $("<h5/>", {
                  class: "one-book",
                  text: cat.name
                }).appendTo("#one");  
                //replace tags
                buildTags(data[1]);
                buildTimes(replace);
              }
            )
          }
        )} else {
          //replace tags
          buildTags(data[1]);
          buildTimes(replace);
        }
     
      
      }
    );
    
  });
                          
});

function buildTags(data) {
  if (data.length !== 0) {
    data.map(function(t){
      $("<h5/>", {
        class: "one-tag",
        text: t.name
      }).appendTo("#one"); 
    });
  }
}

function buildTimes(data) {
  
  //build time
  $("<h5/>", {
    id: "one-time",
    text: data.post_date.substring(0, 10)
  }).appendTo("#one"); 
  
  //build content
  $("<article/>", {
    id: "one-content",
    html: data.post_content
  }).appendTo("#one");

}