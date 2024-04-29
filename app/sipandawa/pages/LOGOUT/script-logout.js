$(document).ready(function () {
	
    var Modul = $("section#viewSupplier");
	Modul.find("div#list").addClass("animated fadeInDown");
	Modul.find("button#btnLogout").click(function () {
		$.ajax({
			url: "../pages/LOGOUT/controller-logout.php",
			success: function (json) {
				alert(json);
			},
			complete: function(){
				window.location="../../../index.php";
			}
		});
    });

});
