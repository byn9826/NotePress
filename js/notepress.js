$( document ).ready(function() {
  
  var defaultCat = 1;
  var defaultTag = null;
  
  $(".main-list").eq(0).addClass("main-active");
  $("#aside-note").children(0).eq(0).addClass("aside-active");
  $(".aside-title").eq(1).addClass("aside-active");
  
  //click on notebook or tags
  $(".aside-title").click(function() {
    var index = $(".aside-title").index(this);
    if (index === 0) {
      //click on notebook
      defaultCat = null;
      $("#aside-note").children(0).removeClass("aside-active");
      $(".aside-title").eq(0).addClass("aside-active");
      replaceBook(defaultCat, defaultTag);
    } else {
      //click on tags
      defaultTag = null;
      $("#aside-tag").children(0).removeClass("aside-active");
      $(".aside-title").eq(1).addClass("aside-active");
      replaceBook(defaultCat, defaultTag);
    }
  });
  
  //change category
  $("#aside-note").children(0).click(function() {
    defaultCat = this.id;
    $(".aside-title").eq(0).removeClass("aside-active");
    $("#aside-note").children(0).removeClass("aside-active");
    $("#aside-note").children(0).eq($("#aside-note").children(0).index(this)).addClass("aside-active");
    replaceBook(defaultCat, defaultTag);
  })
 
  //change tag
  $("#aside-tag").children(0).click(function() {
    defaultTag = this.id;
    $(".aside-title").eq(1).removeClass("aside-active");
    $("#aside-tag").children(0).removeClass("aside-active");
    $("#aside-tag").children(0).eq($("#aside-tag").children(0).index(this)).addClass("aside-active");    
    replaceBook(defaultCat, defaultTag);
  })
  
  //change one note
  $(".main-list").click(replaceList);   
  
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


function replaceBook (cat, tag) {
  var ajax_data = {
    action: "readBook",
    nt_action: "readBook",
    read_cat: cat,
    read_tag: tag
  };
  $.post("/wp-admin/admin-ajax.php", ajax_data,
    function(data) {
      $("#data-list").text(data)
      $("#main").empty();
      $("#one").empty();

      var listData = JSON.parse(data);
      listData.map(function(l) {
        var $title = $("<h3>", {class: "main-list-title", text: l.post_title});
        var $date = $("<h5>", {class: "main-list-date", text: l.post_date.substring(0, 10)});
        var inner;
        if (l.post_content.length > 100) {
          inner = l.post_content.substring(0, 100) + " ...";
        } else {
          inner = l.post_content;
        }
        inner = inner.trim();
        var $content = $("<h4>", {class: "main-list-content", html: inner });
        $("<div/>", {
          class: "main-list",
        }).appendTo("#main")
        .append($title).append($date).append($content).click(replaceList);
      });
    }
  );
  
  
}

function replaceList () {
  var list = JSON.parse($("#data-list").text());
  var position = $(".main-list").index(this);
  var replace = list[position];
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

  
  function buildTimes(data) {
  
    //build time
    $("<h5/>", {
      id: "one-time",
      text: data.post_date.substring(0, 10)
    }).appendTo("#one"); 

    //build content
    var result = data.post_content.replace(/\[\/caption\]/gi, "</span>");
    result = result .replace(/\[caption(.*)\]/gi, "<span>");
    
    $("<article/>", {
      id: "one-content",
      html: result
    }).appendTo("#one");

  }
  
  
}