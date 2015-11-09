

pic1 = new Image(16, 16); 
pic1.src = "loader.gif";

$(document).ready(function(){

$("#email").change(function() { 

var usr = $("#email").val();

if(usr.length >= 4)
{
$("#emailstatus").html('<img src="img/loader.gif" align="absmiddle">&nbsp;Checking email...');

    $.ajax({  
    type: "POST",  
    url: "phpFormValidator/emailRegistrationCheck.php",  
    data: "email="+ usr,  
    success: function(msg){  
   
   $("#emailstatus").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    { 
        $("#email").removeClass('object_error'); // if necessary
        $("#email").addClass("object_ok");
        $(this).html('&nbsp;<img src="img/tick.gif" align="absmiddle">');
    }  
    else  
    {  
        $("#email").removeClass('object_ok'); // if necessary
        $("#email").addClass("object_error");
        $(this).html(msg);
    }  
   
   });

 } 
   
  }); 

}
else
    {
    $("#emailstatus").html('<font color="red">Not Valid email</font>');
    $("#email").removeClass('object_ok'); // if necessary
    $("#email").addClass("object_error");
    }

});


});


