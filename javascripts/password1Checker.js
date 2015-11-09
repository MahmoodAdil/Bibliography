pic1 = new Image(16, 16); 
pic1.src = "loader.gif";

$(document).ready(function(){

    $("#pass1").change(function() { 

        var pass1tocheck = $("#pass1").val();

if(pass1tocheck.length >= 6){
$("#pass1status").html('<img src="img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "phpFormValidator/pass1check.php",  
    data: "pass1="+ pass1tocheck,  
    success: function(msg){  
   
   $("#pass1status").ajaxComplete(function(event, request, settings){ 

    if(msg == 'OK')
    { 
        $("#pass1").removeClass('object_error'); // if necessary
        $("#pass1").addClass("object_ok");
        $(this).html('&nbsp;<img src="img/tick.gif" align="absmiddle">');
        
    }  
    else  
    {  
        $("#pass1").removeClass('object_ok'); // if necessary
        $("#pass1").addClass("object_error");
        $(this).html(msg);
    }  
   
   });

 } 
   
  }); 

}
else
    {
    $("#pass1status").html('<font color="red">Password must have <strong>6</strong> characters.</font>');
    $("#pass1").removeClass('object_ok'); // if necessary
    $("#pass1").addClass("object_error");
    }

});


});


