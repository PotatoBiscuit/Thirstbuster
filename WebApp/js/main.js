var lastCalled = 1;
var scrollPos = 0;

window.setInterval(function() {
	initOrder(lastCalled);
}, 15000);

$(function(){
    $(window).scroll(function() {
    	if($(this).scrollTop() != 0) {
    		scrollPos = $(this).scrollTop();
    	}
    });
});

function convertDateTime(original){
    dateTime = original.split(" ");

    var date = dateTime[0].split("-");
    var yyyy = date[0];
    var mm = date[1]-1;
    var dd = date[2];

    var time = dateTime[1].split(":");
    var h = time[0];
    var m = time[1];
    var s = time[2];

    return new Date(yyyy,mm,dd,h,m,s);
}

function getTimeDifference(start, end) {
	var timeStart = start.getTime();
	var timeEnd = end.getTime();
	var hourDiff = timeEnd - timeStart;
	var secDiff = Math.floor((hourDiff / 1000) % 60); //in s
	var minDiff = Math.floor((hourDiff / 60 / 1000) % 60); //in minutes
	var hDiff = Math.floor((hourDiff / 3600 / 1000) % 24); //in hours
	console.log("January 1, 2016 " + hDiff + ":" + minDiff + ":" + secDiff);
	var difference = new Date("January 1, 2016 " + hDiff + ":" + minDiff + ":" + secDiff);
	return difference;
}

// ***********************************************************************
// Login Modal Enter Key events
// ***********************************************************************
$("#venue_login").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#login-button").click();
	}
});

$("#password1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#login-button").click();
	}
});


// ***********************************************************************
//Register Modal Enter Key events
// ***********************************************************************

$("#venue_login1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#register-button").click();
	}
});

$("#password2").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#register-button").click();
	}
});

$("#venue_name").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#register-button").click();
	}
});

$("#venue_address").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#register-button").click();
	}
});

$("#venue_city").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#register-button").click();
	}
});

$("#venue_state").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#register-button").click();
	}
});

$("#venue_zip").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#register-button").click();
	}
});

$("#venue_credit").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#register-button").click();
	}
});


// ***********************************************************************
// Settings Modal Enter Key events
// ***********************************************************************

$("#password3").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#settings-save").click();
	}
});

$("#venue_login2").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#settings-save").click();
	}
});

$("#venue_name1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#settings-save").click();
	}
});

$("#venue_address1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#settings-save").click();
	}
});

$("#venue_city1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#settings-save").click();
	}
});

$("#venue_state1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#settings-save").click();
	}
});

$("#venue_zip1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#settings-save").click();
	}
});

$("#venue_credit1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#settings-save").click();
	}
});


// ***********************************************************************
// Add Drink Modal Enter Key events
// ***********************************************************************

$("#password4").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#addDrink-add").click();
	}
});

$("#drink_name").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#addDrink-add").click();
	}
});

$("#drink_cost").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#addDrink-add").click();
	}
});

$("#drink_type").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#addDrink-add").click();
	}
});

$("#drink_description").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#addDrink-add").click();
	}
});


// ***********************************************************************
// Edit Drink Modal Enter Key events
// ***********************************************************************

$("#password5").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#changeButton").click();
	}
});

$("#drink_name1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#changeButton").click();
	}
});

$("#drink_cost1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#changeButton").click();
	}
});

$("#drink_type1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#changeButton").click();
	}
});

$("#drink_description1").keyup(function(event) {
	if(event.keyCode == 13) {
		$("#changeButton").click();
	}
});