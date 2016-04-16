<?php
session_start();

$_SESSION["servername"] = "tund.cefns.nau.edu";
$_SESSION["username"] = "eld66";
$_SESSION["password"] = "cs477rocks";
$_SESSION["dbname"] = "eld66";

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">-->
        <!--<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>-->
        <!--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->

        <!-- JavaScript -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <!--<script type="text/javascript" src="js/materialize.min.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>-->
		<script src="js/bootstrap.js"></script>
        <script>
		
            $(document).ready(function () {
                //$('.parallax').parallax();
				$('#myModal').modal({backdrop: 'static', keyboard: false});
            });

            //$(document).on('scroll', function (e) {
            //    $('.navbar').css('opacity', ($(document).scrollTop() / 500));
           // });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
		<script src="js/order_page.js"></script>
		<script src="js/login_modal.js"></script>
		<script src="js/settings_modal.js"></script>
		<script src="js/drinks_modal.js"></script>
		<script src="js/reports_modal.js"></script>
		<script src="js/main.js"></script>

    </head>
    <body>
        <nav role="navigation" class="navbar navbar-default navbar-transparent navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">Thirst Busters</a>
                </div>
            </div>
        </nav>

        <div id="order_header" class='container'>
			<div class = 'row'>
				<div class = 'col-md-offset-1 col-md-2 col-sm-4'>
					<!-- Button trigger settings modal -->
					<button onclick = 'initSettings()' onkeypress = 'initSettings()' type='button' class='btn btn-primary btn-lg'>Settings</button>
				</div>
				<div class = 'col-sm-4 col-md-2'>
					<!-- Button trigger view modal -->
					<button type='button' class='btn btn-primary btn-lg' onclick = 'ViewInitialization()' onkeypress = 'ViewInitialization()'>View Drinks</button>
				</div>
				<div class = 'col-sm-4 col-md-2'>
					<!-- Button trigger Refresh Orders -->
					<button type='button' class='btn btn-primary btn-lg' onclick = 'initOrder(lastCalled);' onkeypress = 'initOrder(lastCalled)'>Refresh Orders</button>
				</div>
				<div class = 'col-sm-6 col-md-2'>
					<!-- Button trigger View Reports -->
					<button type='button' class='btn btn-primary btn-lg' onclick = 'initReports()' onkeypress = 'initReports()'>View Reports</button>
				</div>
				<div class = 'col-sm-6 col-md-2'>
					<div class='dropdown'>
						<button class='btn btn-primary btn-lg dropdown-toggle' type='button' data-toggle='dropdown'>
							Sort By...<span class='caret'></span>
						</button>
						<ul class='dropdown-menu'>
							<li><a onclick='initOrder(1); lastCalled = 1;' href='#'>Wait Time</a></li>
							<li><a onclick='initOrder(2); lastCalled = 2;' href='#'>Table Number</a></li>
							<li><a onclick='initOrder(3); lastCalled = 3;' href='#'>Customer Name</a></li>
							<li><a onclick='initOrder(4); lastCalled = 4;' href='#'>Drinks</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class = 'row'>
				<div class = 'col-md-12'>
					<h2>Orders</h2>
					<hr />
				</div>
			</div>
		</div>

        <!--<div id="index-banner" class="parallax-container" style = "position: absolute;">
            <div class="section no-pad-bot">
                <div class="container">
                    <br><br><br>
                    <h1>Welcome to</h1>
                    
                    <div class="row center">
                        <h2>Thirst Busters</h2>
                    </div>
                    <br><br>

                </div>
            </div>
            <div class="parallax"><img src="img/2.jpg"></div>
        </div>-->

		<div id = "myModal" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button id="login-close" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Login</h4>
			  </div>
			  <div class="modal-body">
					<div class="form-group">
					  <label for="venue_login">Venue Login: </label>
					  <input id = "venue_login" type="text" class="form-control" id="venue_login"<?php  if(isset($_SESSION["LoginID"])) { echo' value="' . $_SESSION["LoginID"] . '" '; } ?>/>
					</div>
					<div class="form-group">
					  <label for="pwd">Password: </label>
					  <input id = "password1" type="password" class="form-control" id="pwd">
					</div>
			  </div>
			  <div class="modal-footer">
				<button id="login-button" onclick = "loginFunction();" onkeypress = "loginFunction();" type="submit" class="btn btn-primary" >Login</button>
				<button id="go-to-register-modal" onclick = "registerFunction();" onkeypress = "registerFunction();" type="button" class="btn btn-default" >Register</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div id = "RegisterModal" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button id="register-close" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Register</h4>
			  </div>
			  <div class="modal-body">
					<div class="form-group">
					  <label for="venue_login1">Venue Login: </label>
					  <input id = "venue_login1" type="text" class="form-control" id="venue_login">
					</div>
					<div class="form-group">
					  <label for="pwd">Password: </label>
					  <input id = "password2" type="password" class="form-control" id="pwd">
					</div>
					<div class="form-group">
					  <label for="name">Name: </label>
					  <input id = "venue_name" type="text" class="form-control" id="name">
					</div>
					<div class="form-group">
					  <label for="address">Address: </label>
					  <input id = "venue_address" type="text" class="form-control" id="address">
					</div>
					<div class="form-group">
					  <label for="address">City: </label>
					  <input id = "venue_city" type="text" class="form-control" id="address">
					</div>
					<div class="form-group">
					  <label for="address">State: </label>
					  <input id = "venue_state" type="text" class="form-control" id="address">
					</div>
					<div class="form-group">
					  <label for="address">Zip: </label>
					  <input id = "venue_zip" type="text" class="form-control" id="address">
					</div>
					<div class="form-group">
					  <label for="credit">Credit #: </label>
					  <input id = "venue_credit" type="text" class="form-control" id="credit">
					</div>
			  </div>
			  <div class="modal-footer">
				<button id="back-to-login" onclick = "backToLogin();" onkeypress = "backToLogin();" type="button" class="btn btn-default">Cancel</button>
				<button id="register-button" onclick = "addVenueFunction();" onkeypress = "addVenueFunction();" type="submit" class="btn btn-primary">Register</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div id = "SettingsModal" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button id="settings-close" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Settings</h4>
			  </div>
			  <div class="modal-body">
					<div class="form-group">
					  <label for="pwd">Re-enter Password: </label>
					  <input id = "password3" type="password" class="form-control" id="pwd">
					</div>
					<div class="form-group">
					  <label for="venue_login">Venue Login: </label>
					  <input id = "venue_login2" type="text" class="form-control" id="venue_login">
					</div>
					<div class="form-group">
					  <label for="name">Name: </label>
					  <input id = "venue_name1" type="text" class="form-control" id="name">
					</div>
					<div class="form-group">
					  <label for="address">Address: </label>
					  <input id = "venue_address1" type="text" class="form-control" id="address">
					</div>
					<div class="form-group">
					  <label for="address">City: </label>
					  <input id = "venue_city1" type="text" class="form-control" id="address">
					</div>
					<div class="form-group">
					  <label for="address">State: </label>
					  <input id = "venue_state1" type="text" class="form-control" id="address">
					</div>
					<div class="form-group">
					  <label for="address">Zip: </label>
					  <input id = "venue_zip1" type="text" class="form-control" id="address">
					</div>
					<div class="form-group">
					  <label for="credit">Credit #: </label>
					  <input id = "venue_credit1" type="text" class="form-control" id="credit">
					</div>
			  </div>
			  <div class="modal-footer">
				<button id="settings-cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button id="settings-save" onclick = "settingsFunction();" onkeypress = "settingsFunction();" type="submit" class="btn btn-primary">Save</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div id = "AddDrinkModal" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button id="addDrink-close" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Drinks</h4>
			  </div>
			  <div class="modal-body">
					<div class="form-group">
					  <label for="pwd">Re-enter Password: </label>
					  <input id = "password4" type="password" class="form-control" id="pwd">
					</div>
					<div class="form-group">
					  <label for="name">Name: </label>
					  <input id = "drink_name" type="text" class="form-control" id="name">
					</div>
					<div class="form-group">
					  <label for="cost">Cost: </label>
					  <input id = "drink_cost" type="text" class="form-control" id="cost">
					</div>
					<div class="form-group">
					  <label for="al_type">Type: </label>
					  <input id = "drink_type" type="text" class="form-control" id="al_type">
					</div>
					<div class="form-group">
					  <label for="description">Description:</label>
					  <textarea id = "drink_description" class="form-control" rows="5" id="description"></textarea>
					</div>
			  </div>
			  <div class="modal-footer">
				<button id="addDrink-cancel" onclick = "moveToViewDrinks();" onkeypress = "moveToViewDrinks();" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button id="addDrink-add" onclick = "addFunction();" onkeypress = "addFunction();" type="submit" class="btn btn-primary">Add</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div id = "ViewDrinkModal" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button id="viewDrink-close-top" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">View Drinks</h4>
			  </div>
			  <div id = "view_modal_body" class="modal-body">
					<!--This is where data from an SQL call goes -->
			  </div>
			  <div class="modal-footer">
				<button id="viewDrink-close-bottom" type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="viewDrink-addDrinks" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddDrinkModal" data-dismiss="modal">Add Drinks</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div id = "EditDrinkModal" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button id="editDrink-close" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Drinks</h4>
			  </div>
			  <div class="modal-body">
					<div class="form-group">
					  <label for="pwd">Re-enter Password: </label>
					  <input id = "password5" type="password" class="form-control" id="pwd">
					</div>
					<div class="form-group">
					  <label for="name">Name: </label>
					  <input id = "drink_name1" type="text" class="form-control" id="name">
					</div>
					<div class="form-group">
					  <label for="cost">Cost: </label>
					  <input id = "drink_cost1" type="text" class="form-control" id="cost">
					</div>
					<div class="form-group">
					  <label for="al_type">Type: </label>
					  <input id = "drink_type1" type="text" class="form-control" id="al_type">
					</div>
					<div class="form-group">
					  <label for="description">Description:</label>
					  <textarea id = "drink_description1" class="form-control" rows="5" id="description"></textarea>
					</div>
			  </div>
			  <div class="modal-footer">
				<button id="editDrink-cancel" onclick = "moveToViewDrinks();" onkeypress = "moveToViewDrinks();" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button id = "changeButton" onclick = "EditDrink();" onkeypress = "EditDrink();" type="submit" class="btn btn-primary">Change</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div id = "ViewOrderedDrinkModal" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button id="viewOrderedDrink-close" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Drinks</h4>
			  </div>
			  <div id = "ordered_drinks" class="modal-body">
			  </div>
			  <div class="modal-footer">
				<button id="viewOrderedDrink-cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div id = "ViewReportsModal" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button id="viewReports-close" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Reports</h4>
			  </div>
			  <div id = "reports_body" class="modal-body">
					<button id="select-report" class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Select Report
					<span class='caret'></span></button>
					<ul class='dropdown-menu'>
					<li><a onclick='initDisplay(1)' href='#'>Total Drinks Sold</a></li>
					<li><a onclick='initDisplay(2)' href='#'>Ave. Wait Time</a></li>
					<li><a onclick='initDisplay(3)' href='#'>Total Sales</a></li>
					</ul>
			  </div>
			  <div class="modal-footer">
				<button id="viewReports-cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		

		<div id = "order_holder" class='container'>
			<div class='row'>
		</div>
		
    </body>
    
</html>
