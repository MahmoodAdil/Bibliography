

pic1 = new Image(16, 16); 
pic1.src = "loader.gif";

$(document).ready(function(){

$("#username").change(function() { 

var usr = $("#username").val();

if(usr.length >= 4)
{
$("#usernamestatus").html('<img src="img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "phpFormValidator/checkUserName.php",  
    data: "username="+ usr,  
    success: function(msg){  
   
   $("#usernamestatus").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    { 
        $("#username").removeClass('object_error'); // if necessary
        $("#username").addClass("object_ok");
        $(this).html('&nbsp;<img src="img/tick.gif" align="absmiddle">');
    }  
    else  
    {  
        $("#username").removeClass('object_ok'); // if necessary
        $("#username").addClass("object_error");
        $(this).html(msg);
    }  
   
   });

 } 
   
  }); 

}
else
    {
    $("#usernamestatus").html('<font color="red">The username should have at least <strong>4</strong> characters.</font>');
    $("#username").removeClass('object_ok'); // if necessary
    $("#username").addClass("object_error");
    }

});


});


