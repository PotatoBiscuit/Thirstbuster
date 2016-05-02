function initReceipts(){
	$('#ViewReceiptsModal').modal('toggle');
}

function resetReceipts(){
	$('#receipt-footer').html("");
	$('#receipts_body').html("");
	$('#receipt-footer').append("<button id='viewReceipts-cancel' type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>");
	$('#receipts_body').append("<div class='form-group'>" +
					  "<label for='keyword'>Keyword: </label>" +
					  "<input id = 'keyword' type='text' class='form-control'>" +
					"</div>" +
					"<div class='form-group'>" +
					"<label for='search_type'>Sort By: </label>" +
					"<select class='form-control' id='search_type'>" +
					"<option value = 'Recency'>Recency</option>" +
					"<option value = 'Customer'>Customer Name</option>" +
					"<option value = 'Table'>Table Number</option>" +
					"</select>" +
					"</div>" +
					"<button id='search-button' onclick = 'searchFunction();' onkeypress = 'searchFunction();' type='submit' class='btn btn-primary' >Search</button>");
}

function searchFunction(){
	createReceipts($('#search_type').val());
}

function createReceipts(type_of_receipt){
	$('#receipt-footer').html("");
	var search_value = $('#keyword').val();
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result1 = xmlhttp.responseText;
			$('#receipts_body').html("");
			$('#receipts_body').append(result1);
			$('#receipt-footer').append("<button type='button' class='btn btn-primary' onclick='resetReceipts()'>New Search</button>\n" +
			"<button id='viewReceipts-cancel' type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>");
		}
	};
	
	if(type_of_receipt == "Recency"){
		xmlhttp.open("GET", "php/Receipts_Modal/search_by_recency.php", true);
		xmlhttp.send();
	}
	else if(type_of_receipt == "Customer"){
		xmlhttp.open("GET", "php/Receipts_Modal/search_by_cust_name.php?q=" + search_value, true);
		xmlhttp.send();
	}
	else if(type_of_receipt == "Table"){
		xmlhttp.open("GET", "php/Receipts_Modal/search_by_table_num.php?q=" + search_value, true);
		xmlhttp.send();
	}
	else{
		xmlhttp.open("GET", "php/Receipts_Modal/search_by_recency.php", true);
		xmlhttp.send();
	}
}