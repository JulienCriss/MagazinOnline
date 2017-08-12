<?php  
session_start();

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


// Protect Mysql Injection

$email = mysqli_real_escape_string($conn,$_POST["email"]);
$parola = mysqli_real_escape_string($conn,$_POST["parola"]);


$email = stripslashes($email);
$parola = stripslashes($parola);

$query = "SELECT * FROM $tbl_name WHERE `email`='$email'";

//Make the query
$result=mysqli_query($conn,$query);

$count=$result->num_rows;

if ($count == 0) {
	echo '
	<div class="col-md-4 " style="width:100%;padding-top:10%;">
		<div class="pv-30 ph-20 feature-box bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
			
			<h2><font color="red"><i class="fa fa-lock"></i></font> Eroare la resetarea parolei </h2>
			<div class="separator clearfix"></div>

			<p>
				<b>Ne pare rau, dar se pare ca contul pe care incerci sa il accesezi nu exista. Te rugam sa incerci din nou cu mai multa atentie.</b>
			</p>
			<p>
				<a href="/reset-password">Go Back !</a>
			</p>
			
		</div>
	</div>';
}else if ($count == 1){
	$sql = "UPDATE `USERS` SET `password`='$parola' WHERE `email`='$email'";
	$result_2=mysqli_query($conn,$sql);

	if ($result_2 == 1) {
		// Creare sesiune pentru noul user si setare variabila de sesiune
		session_start();
		$_SESSION['login'] = $email; 				//Define de login variable for checking first if the user is loged in

		echo '
		<div class="col-md-4 " style="width:100%;padding-top:10%;">
			<div class="pv-30 ph-20 feature-box bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
				<span class="icon default-bg circle"><i class="fa fa-user"></i></span>
				<h3> Salut, bine ai revenit!</h3>
				<div class="separator clearfix"></div>
				<div align="left" style="padding-left: 150px;">
					<p>
						<i class="fa fa-unlock-alt"></i> Parola ta a fost resetata cu succes.<br><br>
						<i class="fa fa-opencart"></i> Echipa <b>IT-Zone</b> iti ureaza shoping placut in continuare.
					</p>
				</div>
			</div>
		</div>';
	}

}
?>