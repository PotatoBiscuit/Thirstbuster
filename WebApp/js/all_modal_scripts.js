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
					alert("Your username is not valid");
				}
				else{
					alert("Your password is incorrect");
				}
			}
			else{
				$('#myModal').modal('toggle');
				initOrder();
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

function initSettings(){
	$('#SettingsModal').modal('toggle');
	$("#venue_login2").val("");
	$("#password3").val("");
	$("#venue_name1").val("");
	$("#venue_address1").val("");
	$("#venue_credit1").val("");
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			var result2 = result1.split(",");
			
			$("#venue_login2").val(result2[0]);
			$("#venue_name1").val(result2[1]);
			$("#venue_address1").val(result2[2]);
			$("#venue_credit1").val(result2[3]);
		}
	};
	xmlhttp.open("GET", "php/init_settings.php", true);
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
			var result1 = xmlhttp.responseText;
			alert(result1);
			$('#SettingsModal').modal('toggle');
		}
	};
	xmlhttp.open("GET", "php/settings.php?q=" + str, true);
	xmlhttp.send();
	
}

function addFunction(){
	password4 = $("#password4").val();
	drink_name = $("#drink_name").val();
	drink_cost = $("#drink_cost").val();
	drink_type = $("#drink_type").val();
	drink_description = $("#drink_description").val();
	
	str = password4 + "," + drink_name + "," + drink_cost + "," + drink_type + "," + drink_description;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			if (result1 == 'no'){
				alert("Invalid Password");
			}
			else{
				alert(result1);
				$('#AddDrinkModal').modal('toggle');
				ViewInitialization();
				
			}
		}
	};
	xmlhttp.open("GET", "php/add_drink.php?q=" + str, true);
	xmlhttp.send();
}

function ViewInitialization(){
	
	$('#view_modal_body').html("");
	$('#ViewDrinkModal').modal('toggle');
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#view_modal_body').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/view_drink_init.php", true);
	xmlhttp.send();
}

function delDrink(drink_id){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			ViewRefresh();
		}
	};
	
	xmlhttp.open("GET", "php/delete_drink.php?q=" + drink_id, true);
	xmlhttp.send();
}

function initEditDrink(drink_id){
	$('#ViewDrinkModal').modal('toggle');
	$('#EditDrinkModal').modal('toggle');
	$('#changeButton').attr('onclick', "EditDrink(" + drink_id + ")");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			var result2 = result1.split(",");
			$('#password5').val("");
			$('#drink_name1').val(result2[0]);
			$('#drink_cost1').val(result2[1]);
			$('#drink_type1').val(result2[2]);
			$('#drink_description1').val(result2[3]);
		}
	};
	
	xmlhttp.open("GET", "php/init_edit_drink.php?q=" + drink_id, true);
	xmlhttp.send();
}

function EditDrink(drink_id){
	password5 = $('#password5').val();
	drink_name1 = $('#drink_name1').val();
	drink_cost1 = $('#drink_cost1').val();
	drink_type1 = $('#drink_type1').val();
	drink_description1 = $('#drink_description1').val();
	
	str = drink_id + "," + password5 + "," + drink_name1 + "," + drink_cost1 + "," + drink_type1 + "," + drink_description1;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			alert(result1);
			$('#EditDrinkModal').modal('toggle');
			moveToViewDrinks();
			ViewRefresh();
		}
	};
	
	xmlhttp.open("GET", "php/edit_drink.php?q=" + str, true);
	xmlhttp.send();
}

function ViewRefresh(){
	$('#view_modal_body').html("");
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#view_modal_body').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/view_drink_init.php", true);
	xmlhttp.send();
}

function initOrder(){
	$('#order_holder').html("");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#order_holder').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/init_order.php", true);
	xmlhttp.send();
}

function changeStatusMinus(order_id){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			initOrder();
		}
	};
	
	xmlhttp.open("GET", "php/change_order_status_minus.php?q=" + order_id, true);
	xmlhttp.send();
}

function changeStatusPlus(order_id){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			initOrder();
		}
	};
	
	xmlhttp.open("GET", "php/change_order_status_plus.php?q=" + order_id, true);
	xmlhttp.send();
}

function moveToViewDrinks(){
	$('#ViewDrinkModal').modal('toggle');
}