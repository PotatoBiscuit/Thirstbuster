function ViewRefresh(){
	$('#view_modal_body').html("");
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#view_modal_body').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/view_order_init.php", true);
	xmlhttp.send();
}

function changeOrderStatus(order_id, type_of_display, order_status){
	//var str = "input[name='sc-1-" + order_id + "']:checked";
	//var order_status = $(str).val();

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			$('#success_div').html("");
			$('#success_div').append("Status Changed");
			$("#success_div").show().delay(3000).fadeOut();
			initOrder(type_of_display);
		}
	};
	var input_str = order_id + "," + order_status;
	xmlhttp.open("GET", "php/Order_Page/change_order_status.php?q=" + input_str, true);
	xmlhttp.send();
}
$(document).ready(function () {
    $(":radio").on("change", function (event) {
        alert('clicked');
    });
});

function viewOrderedDrinks(order_id){
	$('#ViewOrderedDrinkModal').modal('toggle');
	$('#ordered_drinks').html("");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#ordered_drinks').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/view_ordered_drink.php?q=" + order_id, true);
	xmlhttp.send();
}

function initOrder(type_of_display){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#order_holder').html("");
			$('#order_holder').append(result1);
		}
	};
	
	if(type_of_display == 1){
		xmlhttp.open("GET", "php/Order_Page/init_order.php", true);
		xmlhttp.send();
	}
	else if(type_of_display == 2){
		xmlhttp.open("GET", "php/Order_Page/init_table_num.php", true);
		xmlhttp.send();
	}
	else if(type_of_display == 3){
		xmlhttp.open("GET", "php/Order_Page/init_cust_name.php", true);
		xmlhttp.send();
	}
	else if(type_of_display == 4){
		xmlhttp.open("GET", "php/Order_Page/init_drinks.php", true);
		xmlhttp.send();
	}
	else{
		xmlhttp.open("GET", "php/Order_Page/init_order.php", true);
		xmlhttp.send();
	}
}

function deleteOrder(order_id){
	var result = confirm("Are you sure you want to delete this order?");
	if (!result){
		return;
	}
	
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			$('#success_div').html("");
			$('#success_div').append("Order Deleted");
			$("#success_div").show().delay(3000).fadeOut();
			initOrder();
		}
	};
	xmlhttp.open("GET", "php/Order_Page/delete_order.php?q=" + order_id, true);
	xmlhttp.send();
}

function finishOrder(order_id){
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			$('#success_div').html("");
			$('#success_div').append("Order Finished");
			$("#success_div").show().delay(3000).fadeOut();
			initOrder();
		}
	};
	xmlhttp.open("GET", "php/Order_Page/finish_order.php?q=" + order_id, true);
	xmlhttp.send();
}

function changeStatusMinus(order_id, type_of_display){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			initOrder(type_of_display);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/change_order_status_minus.php?q=" + order_id, true);
	xmlhttp.send();
}

function changeStatusPlus(order_id, type_of_display){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			initOrder(type_of_display);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/change_order_status_plus.php?q=" + order_id, true);
	xmlhttp.send();
}
function refreshOrderedDrinks(order_id){
	$('#ordered_drinks').html("");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#ordered_drinks').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/view_ordered_drink.php?q=" + order_id, true);
	xmlhttp.send();
}
function changeDrinkStatusMinus(tab_id, drink_id, order_id){
	
}

function changeDrinkStatusPlus(tab_id, drink_id, order_id){
	
}

function deleteOrderedDrink(ordered_drink_id, order_id){
	var result = confirm("Are you sure you want to delete this drink?");
	if (!result){
		return;
	}
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			$('#success_div').html("");
			$('#success_div').append("Drink Deleted");
			$("#success_div").show().delay(3000).fadeOut();
			refreshOrderedDrinks(order_id);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/delete_ordered_drink.php?q=" + ordered_drink_id, true);
	xmlhttp.send();
}

function finishOrderedDrink(ordered_drink_id, order_id){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			$('#success_div').html("");
			$('#success_div').append("Drink Filled");
			$("#success_div").show().delay(3000).fadeOut();
			refreshOrderedDrinks(order_id);
		}
	};
	
	var str = ordered_drink_id + "," + order_id;
	xmlhttp.open("GET", "php/Order_Page/finish_ordered_drink.php?q=" + str, true);
	xmlhttp.send();
}

function logout(){
	location.reload();
}