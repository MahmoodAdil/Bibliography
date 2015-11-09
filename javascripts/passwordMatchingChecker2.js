pic1 = new Image(16, 16); 
pic1.src = "loader.gif";

$(document).ready(function(){

    $("#pass2").change(function() { 

        var pass1 = $("#pass1").val();
        var comparingPass = $("#pass2").val();

if(pass1 == comparingPass){
$("#pass2status").html('<img src="img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "phpFormValidator/pass2check.php",  
    data: "pass2="+ comparingPass,  
    success: function(msg){  
   
   $("#pass2status").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    { 
        $("#pass2").removeClass('object_error'); // if necessary
        $("#pass2").addClass("object_ok");
        $(this).html('&nbsp;<img src="img/tick.gif" align="absmiddle">');
    }  
    else  
    {  
        $("#pass2").removeClass('object_ok'); // if necessary
        $("#pass2").addClass("object_error");
        $(this).html(msg);
    }  
   
   });

 } 
   
  }); 

}
else
    {
    $("#pass2status").html('<font color="red">Both password <strong> does not</strong> matched.</font>');
    $("#pass2").removeClass('object_ok'); // if necessary
    $("#pass2").addClass("object_error");
    }

});


});


