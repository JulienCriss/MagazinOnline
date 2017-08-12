<?php  
session_start();

if (isset($_SESSION["login"])) {

	$host="localhost"; 					// Host name 
	$username="u717313805_admin"; 					// Mysql username 
	$password="romania@3"; 				// Mysql password 
	$db_name="u717313805_zone";			 	// Database name 
	$tbl_name="VANZARI"; 	 				// Table name


	$conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

	if ($conn->connect_error) {								   // Check connection
	    die("Connection failed: " . $conn->connect_error);
	}

	mysqli_select_db($conn,$db_name);						   // SELECT the database

	$query = "SELECT * FROM $tbl_name WHERE `email_client`='".$_SESSION["login"]."'";
	//Make the query
	$result=mysqli_query($conn,$query);
	$count=$result->num_rows;
	if($count == 0)
	{
		echo '
		<div style="margin-left: 35%;" class="col-md-4 " align="center">
			<div class="pv-30 ph-20 feature-box light-gray-bg bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
				<span class="icon default-bg circle"><i class="fa fa-opencart"></i></span>
				<h3>Momentan nu aveti nici o comanda inregistrata.</h3>
				<div class="separator clearfix"></div>
				<a href="http://it-zone.hol.es/">Viziteaza magazin <i class="pl-5 fa fa-angle-double-right"></i></a>
			</div>
		</div>';
	}else{
		while($row = $result->fetch_assoc()) {

			$produse = explode(",",$row["id_produs"]);

			echo '
			<div class="col-md-4 " style="width:100%">
				<div class="pv-30 ph-20 feature-box light-gray-bg bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">



					<div class="media margin-clear">
						<div class="media-left">
							<div class="overlay-container_2">
								<h4>Comanda nr:#'.$row["numar_comanda"].'</h4>
							</div>
						</div>
						<br>

						<div class="media-body" style="width:100%;">
							<div style="margin:20px;float:left" align="left">';


			$tbl_name_2="PRODUSE"; 	 				// Table name
			$conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

			if ($conn->connect_error) {								   // Check connection
			    die("Connection failed: " . $conn->connect_error);
			}

			mysqli_select_db($conn,$db_name);						   // SELECT the database

			// Make a Query


			$query_2 = "SELECT * FROM  `$tbl_name_2` WHERE  cod_produs IN (".implode(",",$produse).")";
			//Make the query
			$result_2=mysqli_query($conn,$query_2);

			$prod_val = 0;

			while($row_2 = $result_2->fetch_assoc()) {

				echo '
				<h4><span>Prod. '.++$prod_val.':</span> <a href="/shop-product?id='.$row_2["cod_produs"].'&product_name='.$row_2["nume_produs"].'">'.$row_2["nume_produs"].'</a></h4>';
				if ($row_2["stoc_produs"] <= 10 && $row_2["stoc_produs"] > 0) {
					echo '<span>Disponibilitate: </span><font color="orange"><i class="fa fa-exclamation-triangle"></i> <b>Stoc Limitat ('.$row_2["stoc_produs"].' prod.)</b></font><br>';
				}else if ($row_2["stoc_produs"] > 10) {
					echo '<span>Disponibilitate: <font color="green"><i class="fa fa-check"> </i><b> Stoc magazin suficient </b></font></span>';
				}else{
					echo '<span><font color="red"><i class="fa fa-times-circle"> </i> <b> Nu este in stoc</b></font></span>';
				}
				echo'<br>
				<i class="fa fa-shield"></i> Garantie inclusa: 24 luni
				<hr>';


			}

			echo '
							<div align="left">
								<span><i class="fa fa-dashboard"></i> Status Comanda:'.$row["status_comanda"].'</span>
							</div>
						</div>
						</div>
						
					</div>
				</div>
			</div>';
		}
	}
		
}else{
	echo 0;
}


?>