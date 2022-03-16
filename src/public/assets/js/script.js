$(document).ready(function(){
  $("body").on("click" , "#postBtn" , function(){
   var pass = $("#floatingPassword").val();
   var rpass = $("#floatingRpassword").val();
   if(pass != rpass)
   {
    $("#floatingPassword").val("");
    $("#floatingRpassword").val("");
    $("#floatingPassword").css("border", "2px solid red");
    $("#floatingRpassword").css("border", "2px solid red");
     alert("Password not matching");
   }
  });
});