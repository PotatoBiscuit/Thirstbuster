function loginFunction(){
	var login, password1, result1;
	login = $("#venue_login").val();
	password1 = $("#password1").val();
	str = login + " " + password1;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			result1 = xmlhttp.responseText;
			if(result1 == 'no' || result1 == 'no1'){
				if(result1 == 'no'){
					alert("Your username is not valid");
				}
				else{
					alert("Your password is incorrect");
				}
			}
			else{
				$('#myModal').modal('toggle');
			}
		}
	};
	xmlhttp.open("GET", "php/login.php?q=" + str, true);
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
	credit = $("#venue_credit").val();
	
	str = login + "," + password2 + "," + name + "," + address + "," + credit;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			$('#RegisterModal').modal('toggle');
		}
	};
	xmlhttp.open("GET", "php/register.php?q=" + str, true);
	xmlhttp.send();
}

function settingsFunction(){
	login = $("#venue_login2").val();
	password3 = $("#password3").val();
	name = $("#venue_name1").val();
	address = $("#venue_address1").val();
	credit = $("#venue_credit1").val();
	
	str = login + "," + password3 + "," + name + "," + address + "," + credit;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			result1 = xmlhttp.responseText;
			alert(result1);
			$('#SettingsModal').modal('toggle');
		}
	};
	xmlhttp.open("GET", "php/settings.php?q=" + str, true);
	xmlhttp.send();
	
}

function addFunction(){
	alert("Hello! I am an alert box!!");
	
}