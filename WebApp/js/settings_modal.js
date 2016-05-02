function initSettings(){
	$('#SettingsModal').modal('toggle');
	$("#venue_login2").val("");
	$("#password3").val("");
	$("#venue_name1").val("");
	$("#venue_address1").val("");
	$("#venue_city1").val("");
	$("#venue_state1").val("");
	$("#venue_zip1").val("");
	$("#venue_credit1").val("");
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			var result2 = result1.split(",");
			
			$("#venue_login2").val(result2[0]);
			$("#venue_name1").val(result2[1]);
			$("#venue_address1").val(result2[2]);
			$("#venue_city1").val(result2[3]);
			$("#venue_state1").val(result2[4]);
			$("#venue_zip1").val(result2[5]);
			$("#venue_credit1").val(result2[6]);
		}
	};
	xmlhttp.open("GET", "php/Settings_Modal/init_settings.php", true);
	xmlhttp.send();
}

function settingsFunction(){
	login = $("#venue_login2").val();
	password3 = $("#password3").val();
	name = $("#venue_name1").val();
	address = $("#venue_address1").val();
	city = $("#venue_city1").val();
	state = $("#venue_state1").val();
	zip = $("#venue_zip1").val();
	credit = $("#venue_credit1").val();
	
	str = login + "," + password3 + "," + name + "," + address + "," + city + "," + state + "," + zip + "," + credit;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			if(result1 != "Info updated successfully"){
				$('#error_div').html("");
				$('#error_div').append(result1);
				$("#error_div").show().delay(3000).fadeOut();
			}
			else{
				$('#success_div').html("");
				$('#success_div').append("Settings Changed");
				$("#success_div").show().delay(3000).fadeOut();
			}
			$('#SettingsModal').modal('toggle');
		}
	};
	xmlhttp.open("GET", "php/Settings_Modal/settings.php?q=" + str, true);
	xmlhttp.send();
	
}