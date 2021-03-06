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
				$('#error_div').html("");
				$('#error_div').append("Invalid Password");
				$("#error_div").show().delay(3000).fadeOut();
			}
			else{
				$('#success_div').html("");
				$('#success_div').append(result1);
				$("#success_div").show().delay(3000).fadeOut();
				$('#AddDrinkModal').modal('toggle');
				$("#password4").val("");
				$("#drink_name").val("");
				$("#drink_cost").val("");
				$("#drink_type").val("");
				$("#drink_description").val("");
				ViewInitialization();
				
			}
		}
	};
	xmlhttp.open("GET", "php/Drinks_Modal/add_drink.php?q=" + str, true);
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
	
	xmlhttp.open("GET", "php/Drinks_Modal/view_drink_init.php", true);
	xmlhttp.send();
}

function ViewInitRefresh(){
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#view_modal_body').html("");
			$('#view_modal_body').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/Drinks_Modal/view_drink_init.php", true);
	xmlhttp.send();
}

function delDrink(drink_id){
	var result = confirm("Are you sure you want to delete this drink?");
	if (!result){
		return;
	}
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#success_div').html("");
			$('#success_div').append("Drink Deleted");
			$("#success_div").show().delay(3000).fadeOut();
			ViewInitRefresh();
		}
	};
	
	xmlhttp.open("GET", "php/Drinks_Modal/delete_drink.php?q=" + drink_id, true);
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
	
	xmlhttp.open("GET", "php/Drinks_Modal/init_edit_drink.php?q=" + drink_id, true);
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
			if(result1 != "Drink Correctly Changed"){
				$('#error_div').html("");
				$('#error_div').append("Incorrect Password");
				$("#error_div").show().delay(3000).fadeOut();
			}
			else{
				$('#success_div').html("");
				$('#success_div').append("Drink Edited");
				$("#success_div").show().delay(3000).fadeOut();
				$('#EditDrinkModal').modal('toggle');
				ViewInitialization();
			}
		}
	};
	
	xmlhttp.open("GET", "php/Drinks_Modal/edit_drink.php?q=" + str, true);
	xmlhttp.send();
}

function moveToViewDrinks(){
	$('#ViewDrinkModal').modal('toggle');
}
