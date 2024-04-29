$(document).ready(function(){
    
	var Modul = $('section#viewLogin');
	Modul.find('button#btnLogin').click(function(){
		login();
	});
	
	Modul.find('#password').keypress(function(event){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13'){
        login();
      }
    });
		
});

function login(){
    var Modul = $('section#viewLogin');
    var user = Modul.find('input#username').val();
		var pass = Modul.find('input#password').val();

		$.ajax({
			type	    : "POST"
			,dataType   : "json"
			,url		: "login/model-login.php"
			,data	    : {username:user,password:pass}
			,success	: function(json) {
				
			    if(json){
					window.location="index.php?page=dashboard";
				} else {
					alert("Password dan username salah");
				}
				
			}
		});
}