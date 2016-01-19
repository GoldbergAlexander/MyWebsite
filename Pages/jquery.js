$(document).ready(function(){


$(document).on("keyup",".accessInput",function(e){
   // $(".login").on("keyup", "#accessText",function(e){
        if(e.which == 13){
            $.post("login.php",{
                code:$(".accessInput").val()
            },function(){
                $("#accessTab").load("ajaxAccessTab.php");
                $("#navigation").load("ajaxPage.php");
                $("#content").load("ajaxContent.php?page="+ $.urlParam('page'));
                $("#exactContent").load("ajaxGetExactContent.php?page="+ $.urlParam('page'));
            });
        }
   // });
});

$(document).on("click",".accessLogout",function(){
  // $(".login").on("click","#name",function(){
       $.post("login.php",{
           logout:"logout"
       }, function() {
          $("#accessTab").load("ajaxAccessTab.php");
          $("#navigation").load("ajaxPage.php");
          $("#content").load("ajaxContent.php?page="+ $.urlParam('page'));
          $("#exactContent").load("ajaxGetExactContent.php?page="+ $.urlParam('page'));
       });
 //  });
});

});

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}