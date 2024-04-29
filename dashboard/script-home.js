$(document).ready(function () {
	hideURLParams();
	var ModulSistem = $('section#dashboardsistem');

	var ID = ModulSistem.find('input#id_user_sistem').val();

	listSistem(ID);

});

function getURLParameter(name) {
	return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search) || [, null])[1]);
}

function hideURLParams() {
	//Parameters to hide (ie ?success=value, ?error=value, etc)
	var hide = ['success', 'error'];
	for (var h in hide) {
		if (getURLParameter(h)) {
			history.replaceState(null, document.getElementsByTagName("title")[0].innerHTML, window.location.pathname);
		}
	}
}


function listSistem(idUser) {
	var ModulSistem = $('section#dashboardsistem');

	$.ajax({
		type: "POST"
		, dataType: "json"
		, url: "dashboard/model-home.php"
		, data: { username: idUser }
		, beforeSend: function () {

		}
		, success: function (json) {
			console.log("tes " + json[0]);
			ModulSistem.find('div#listSistem').empty();
			var isiSistem = '';
			$.each(json, function (index, row) {
				console.log("sub " + row.sub_judul);

				isiSistem += '<div class="block block-pricing shadow-4">';
					isiSistem += '<div class="pd-20 mx-auto text-center bd-1">';
						isiSistem += '<div class="icon"> <img src="assets/images/login-icon.png"></i>';
							isiSistem +=' </div>';
						isiSistem += '<h6 class="category">'+row.sub_judul+'</h6>';
						isiSistem += '<p class="block-description"> '+row.judul_sistem+'</p>';
						isiSistem += '<a href="'+row.url_sistem+'" class="btn btn-custom-primary btn-round">Masuk Aplikasi</a>';
						isiSistem += '</div>';
					isiSistem += '</div>';

			});

			ModulSistem.find('div#listSistem').append(isiSistem);
		}
		, complete: function () {

		}

	});

}