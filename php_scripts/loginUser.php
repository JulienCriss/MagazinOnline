<?php

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


// Protectectie pentru MySql Injection
$email = mysqli_real_escape_string($conn,$_POST["email"]);
$parola = mysqli_real_escape_string($conn,$_POST["parola"]);

$email = stripslashes($email);
$parola = stripslashes($parola);

$query = "SELECT * FROM $tbl_name WHERE `email`='$email' and `password`='$parola'";

//Make the query
$result=mysqli_query($conn,$query);

$count=$result->num_rows;

if($count==0){
	//echo $email.' '.$parola;
	echo "0";
}else{
	session_start();
	$_SESSION['login'] = $email;

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
}
 


?>