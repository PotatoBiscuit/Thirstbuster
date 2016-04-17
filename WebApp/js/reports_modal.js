function initReports(){
	$('#ViewReportsModal').modal('toggle');
}

function initDisplay(display_choice){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		var result1 = xmlhttp.responseText;
		$('#reports_body').html("");
		$('#reports_body').append(result1);
	};
	if(display_choice == 1){
		xmlhttp.open("GET", "php/Reports_Modal/num_drinks.php", true);
		xmlhttp.send();
	} else if(display_choice == 2){
		xmlhttp.open("GET", "php/Reports_Modal/wait_time.php", true);
		xmlhttp.send();
	} else if(display_choice == 3){
		xmlhttp.open("GET", "php/Reports_Modal/total_sales.php", true);
		xmlhttp.send();
	}
}