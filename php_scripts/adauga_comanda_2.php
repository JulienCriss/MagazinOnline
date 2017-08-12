<?php  
session_start();
$_SESSION["cos"] = array_values($_SESSION["cos"]);

if (empty($_SESSION["cos"] )) {
	echo '
		<div style="margin-left: 35%;" class="col-md-4 " align="center">
			<div class="pv-30 ph-20 feature-box light-gray-bg bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
				<span class="icon default-bg circle"><i class="fa fa-opencart"></i></span>
				<h3>Cosul dumneavoastra este momentan gol</h3>
				<div class="separator clearfix"></div>
				<a href="http://it-zone.hol.es/">Viziteaza magazin <i class="pl-5 fa fa-angle-double-right"></i></a>
			</div>
	</div>';
}else{

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


	$query = "SELECT * FROM $tbl_name WHERE `email`='".$_SESSION["login"]."'";

	//Make the query
	$result_2=mysqli_query($conn,$query);

	$count=$result_2->num_rows;

	if ($count == 1) {

		while($row_2 = $result_2->fetch_assoc()) {
			
			$nume = $row_2['Nume'];
			$prenume = $row_2['Prenume'];

			$host="localhost"; 					// Host name 
			$username="u717313805_admin"; 					// Mysql username 
			$password="romania@3"; 				// Mysql password 
			$db_name="u717313805_zone";			 	// Database name 
			$tbl_name="VANZARI"; 				// Table name 
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////

			$conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

			if ($conn->connect_error) {								   // Check connection
			    die("Connection failed: " . $conn->connect_error);
			}

			mysqli_select_db($conn,$db_name);						   // SELECT the database


			// Protect Mysql Injection
			$adresa = mysqli_real_escape_string($conn,$_POST["adresa_livrare_final"]);
			$plata = mysqli_real_escape_string($conn,$_POST["plata"]);

			$query = "INSERT INTO `VANZARI`(`id_produs`, `total_plata`, `metoda_plata`, `adresa_client`, `nume_client`, `prenume_client`, `email_client`, `status_comanda`) VALUES ('".implode(",",$_SESSION["cos"])."','".$_SESSION["total_plata_comanda"]."','$plata','$adresa','$nume','$prenume','".$_SESSION["login"]."','In Prelucrare')";

			$result=mysqli_query($conn,$query);
			if ($result) {

				$tbl_name="PRODUSE"; 										// Table name 

				$conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

				if ($conn->connect_error) {								   // Check connection
				    die("Connection failed: " . $conn->connect_error);
				}

				mysqli_select_db($conn,$db_name);						   // SELECT the database

				$query_2 = "SELECT * FROM  `$tbl_name` WHERE  cod_produs IN (".implode(",",$_SESSION["cos"]).")";

				//Make the query
				$result_2=mysqli_query($conn,$query_2);

				while($row_2 = $result_2->fetch_assoc()) {
						$new_stoc = $row_2['stoc_produs']-1 ;
						$query_3 = "UPDATE `$tbl_name` SET `stoc_produs`=".$new_stoc." WHERE `cod_produs`=".$row_2['cod_produs'];
						$result_3=mysqli_query($conn,$query_3);
				}

				session_start();
				unset($_SESSION["cos"]);
				unset($_SESSION["numar_produse"]) ;
				unset($_SESSION["total_plata_comanda"]);


				echo '<div class="col-md-4 " style="width:100%;padding-top:10%;">
				<div class="pv-30 ph-20 feature-box bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
					<span class="icon default-bg circle"><i class="fa fa-user"></i></span>
					<h3> Comanda ta a fost preluata cu succes si va fi prelucrata in scurt timp.</h3>
					<div class="separator clearfix"></div>
					<div align="left" style="padding-left: 150px;">
						<p>
							<i class="fa fa-opencart"></i> Echipa <b>IT-Zone</b> iti ureaza shoping placut in continuare.
						</p>
					</div>
				</div>
			</div>';
			}
		}

	}

}
?>