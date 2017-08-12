<?php
session_start();

if ((isset($_SESSION['login']) && $_SESSION['login'] != ''))
{
	if (!(isset($_SESSION['cos']))) {
		$_SESSION["cos"] = array();
		$_SESSION["numar_produse"] = 0;
		$_SESSION["total_plata_comanda"] = 0;
	}

	$host="localhost"; 					// Host name 
	$username="u717313805_admin"; 					// Mysql username 
	$password="romania@3"; 				// Mysql password 
	$db_name="u717313805_zone";			 	// Database name 
	$tbl_name="USERS"; 				// Table name 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

	if ($conn->connect_error) {								   // Check connection
	    die("Connection failed: " . $conn->connect_error);
	}

	mysqli_select_db($conn,$db_name);						   // SELECT the database

	$email = mysqli_real_escape_string($conn,$_SESSION['login']);

	$query = "SELECT * FROM $tbl_name WHERE `email`='$email'";

	//Make the query
	$result=mysqli_query($conn,$query);

	$count=$result->num_rows;

	if($count==0){
		echo '<div class="btn-group">
				<a href="page-signup" class="btn btn-default btn-sm"><i class="fa fa-user pr-10"></i> Sign Up</a>
			</div>
			<div id="login_div" class="btn-group dropdown">
				<button id="login_button" type="button" class="btn dropdown-toggle btn-default btn-sm" data-toggle="dropdown"><i class="fa fa-lock pr-10"></i> Login</button>
				<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
					<li>
						<form class="login-form margin-clear" method="POST">
							<div class="form-group has-feedback">
								<label class="control-label">Email</label>
								<input type="email" id="email" name="email" class="form-control" placeholder="">
								<i class="fa fa-envelope form-control-feedback"></i>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label">Parola</label>
								<input type="password" id="parola" name="parola" class="form-control" placeholder="">
								<i class="fa fa-lock form-control-feedback"></i>
							</div>

							<div id="errorUser" style="padding-bottom:10px;padding-top:10px;display:none">
								<font color="#eea236"><i class="fa fa-warning pr-10"></i>Emailul sau parola sunt incorecte!</font>
							</div>

							<button type="button" onclick="verifica_Login()" class="btn btn-animated btn-gray btn-sm">Log In <i class="fa fa-group"></i></button>
							<ul>
								<li><a href="/reset-password">Reseteaza parola!?</a></li>
							</ul>
						</form>
					</li>
				</ul>
			</div>';
	}

	while($row = $result->fetch_assoc()) {
		echo '<div class="btn-group dropdown">
			<button type="button" class="btn dropdown-toggle btn-default btn-sm" data-toggle="dropdown" aria-expanded="false"><font color="#cc0000"><i class="fa fa-user pr-10"> </i></font>'.$row["Nume"].' '.$row["Prenume"].'</button>
			<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
				<li>
					<div><i class="fa fa-angle-right"></i> <a href="/comenzile-mele"> Comenzile mele</a></div>
				</li>

				
				<li>
					<div style="margin-top:20px;"><button onclick="logOut();" class="btn btn-animated btn-danger btn-sm">Log Out <i class="fa fa-sign-out"></i></button></div>
				</li>
				
			</ul>
		</div>';
	}
mysqli_close($conn);
    	
}else{

	if (!(isset($_SESSION['cos']))) {
		$_SESSION["cos"] = array();
		$_SESSION["numar_produse"] = 0;
		$_SESSION["total_plata_comanda"] = 0;
	}
	echo '<div class="btn-group">
				<a href="page-signup" class="btn btn-default btn-sm"><i class="fa fa-user pr-10"></i> Sign Up</a>
			</div>
			<div id="login_div" class="btn-group dropdown">
				<button id="login_button" type="button" class="btn dropdown-toggle btn-default btn-sm" data-toggle="dropdown"><i class="fa fa-lock pr-10"></i> Login</button>
				<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
					<li>
						<form class="login-form margin-clear" method="POST">
							<div class="form-group has-feedback">
								<label class="control-label">Email</label>
								<input type="email" id="email" name="email" class="form-control" placeholder="">
								<i class="fa fa-envelope form-control-feedback"></i>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label">Parola</label>
								<input type="password" id="parola" name="parola" class="form-control" placeholder="">
								<i class="fa fa-lock form-control-feedback"></i>
							</div>

							<div id="errorUser" style="padding-bottom:10px;padding-top:10px;display:none">
								<font color="#eea236"><i class="fa fa-warning pr-10"></i>Emailul sau parola sunt incorecte!</font>
							</div>

							<button type="button" onclick="verifica_Login()" class="btn btn-animated btn-gray btn-sm">Log In <i class="fa fa-group"></i></button>
							<ul>
								<li><a href="/reset-password">Reseteaza parola!?</a></li>
							</ul>
						</form>
					</li>
				</ul>
			</div>';
}
?>