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

function initOrder(){
	$('#order_holder').html("");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#order_holder').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/init_order.php", true);
	xmlhttp.send();
}

function deleteOrder(order_id){
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
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
			initOrder();
		}
	};
	xmlhttp.open("GET", "php/Order_Page/finish_order.php?q=" + order_id, true);
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
	
	xmlhttp.open("GET", "php/Order_Page/change_order_status_minus.php?q=" + order_id, true);
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
	
	xmlhttp.open("GET", "php/Order_Page/change_order_status_plus.php?q=" + order_id, true);
	xmlhttp.send();
}

function initTableNum(){
	$('#order_holder').html("");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#order_holder').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/init_table_num.php", true);
	xmlhttp.send();
}

function initCustName(){
	$('#order_holder').html("");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#order_holder').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/init_cust_name.php", true);
	xmlhttp.send();
}

function initDrinks(){
	$('#order_holder').html("");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#order_holder').append(result1);
		}
	};
	
	xmlhttp.open("GET", "php/Order_Page/init_drinks.php", true);
	xmlhttp.send();
}