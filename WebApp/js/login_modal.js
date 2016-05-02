function loginFunction(){
	var login, password1, result1;
	login = $("#venue_login").val();
	password1 = $("#password1").val();
	str = login + "," + password1;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			if(result1 == 'no' || result1 == 'no1'){
				if(result1 == 'no'){
					$('#error_div').html("");
					$('#error_div').append("Username not valid");
					$("#error_div").show().delay(3000).fadeOut();
				}
				else{
					$('#error_div').html("");
					$('#error_div').append("Password is incorrect");
					$("#error_div").show().delay(3000).fadeOut();
				}
			}
			else{
				$('#myModal').modal('toggle');
				$('#success_div').html("");
				$('#success_div').append("Login Success");
				$("#success_div").show().delay(3000).fadeOut();
				initOrder();
			}
		}
	};
	xmlhttp.open("GET", "php/Login_Modal/login.php?q=" + str, true);
	xmlhttp.send();
}

function registerFunction(){
	$('#myModal').modal('toggle');
	$('#RegisterModal').modal({backdrop: 'static', keyboard: false});
}

function backToLogin(){
	$('#RegisterModal').modal('toggle');
	$('#myModal').modal({backdrop: 'static', keyboard: false});
}

function addVenueFunction(){
	login = $("#venue_login1").val();
	password2 = $("#password2").val();
	name = $("#venue_name").val();
	address = $("#venue_address").val();
	city = $("#venue_city").val();
	state = $("#venue_state").val();
	zip = $("#venue_zip").val();
	credit = $("#venue_credit").val();
	
	str = login + "," + password2 + "," + name + "," + address + "," + city + "," + state + "," + zip + "," + credit;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			$('#RegisterModal').modal('toggle');
			$('#success_div').html("");
			$('#success_div').append("Registration Success");
			$("#success_div").show().delay(3000).fadeOut();
			initOrder();
		}
	};
	xmlhttp.open("GET", "php/Login_Modal/register.php?q=" + str, true);
	xmlhttp.send();
}