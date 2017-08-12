<?php
session_start();
//$_SESSION["cos"] = array_values($_SESSION["cos"]);


function total_plata($total,$pret){
	
	if($total == 0){
		$total = $total + $pret ;
	}else
	{
		$total = $total + $pret ;
	}
	return $total;
}



$id =$_GET['id'];
$suma_total = 0;

if ($id == 'undefined' or $id == 0) {

	if(empty($_SESSION["cos"]))
	{
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
		$tbl_name="PRODUSE"; 	 				// Table name 
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

		if ($conn->connect_error) {								   // Check connection
		    die("Connection failed: " . $conn->connect_error);
		}

		mysqli_select_db($conn,$db_name);						   // SELECT the database

		$query = "SELECT * FROM  `$tbl_name` WHERE  cod_produs IN (".implode(",",$_SESSION["cos"]).")";

		//Make the query
		$result=mysqli_query($conn,$query);

		$count=$result->num_rows;

		$_SESSION["numar_produse"] = $count;

		while($row = $result->fetch_assoc()) {

			$poza_principala = explode(";", $row["poza_produs"]);
			$poza_principala = $poza_principala[0];

			$pret =  explode(",",$row["pret_produs"]);
			$pret_prim = $pret[0];
			$zecimale = $pret[1];

			$pret_de_adunat = $row["pret_produs"];
			$pret_de_adunat = str_replace(".","",$pret_de_adunat); 
			$pret_de_adunat = str_replace(",",".",$pret_de_adunat);
			
			$suma_total = total_plata($suma_total,$pret_de_adunat);

			echo '
			<div class="col-md-4 " style="width:100%">
				<div class="pv-30 ph-20 feature-box light-gray-bg bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">

					<div class="media margin-clear">
						<div class="media-left">
							<div class="overlay-container_2">
								<img width="120" height="120" src="imagini_produs/'.$poza_principala.'" alt="">
							</div>
						</div>
						<div class="media-body" style="width:100%; padding-top:2%;">

							<div align="left" style="float:left;max-width:400px;">
								<span style="text-align:left;" class="media-heading"><a href="/shop-product?id='.$row["cod_produs"].'&product_name='.$row["nume_produs"].'">'.$row["nume_produs"].'</a></span>
							</div>		

							<div class="col-md-4 ">
								<div class="ph-20 feature-box text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
									<h4><span class="price">'.$pret[0].'<sup>'.$zecimale.'</sup> RON</span></h4>
								</div>
							</div>

							<div align="left" style="margin:20px;max-width:400px;">';

								if($row["stoc_produs"] == 0){
									echo '<span>Disponibilitate: </span><font color="red"><i class="fa fa-times-circle"> </i>  Nu este in stoc</font><br>';
								}else
								if($row["stoc_produs"] <= 10 && $row["stoc_produs"] > 0){
									echo '<span>Disponibilitate: </span><font color="orange"><i class="fa fa-exclamation-triangle"></i> Stoc Limitat ('.$row["stoc_produs"].' prod.)</font><br>';
								}else{
									echo '<span>Disponibilitate: </span><font color="green"><i class="fa fa-check"> </i> Stoc magazin suficient </font><br>';
								}

								

							echo '	
								<i class="fa fa-shield"></i> Garantie inclusa: 24 luni
							</div>

						</div>
						<hr>
					</div>
					
					<div align="right">
						<button type="button" onclick="delete_produs('.$row['cod_produs'].')" class="btn btn-animated btn-danger btn-sm">Sterge acest produs din cos <i class="fa fa-times"></i></button>
					</div>
				</div>
			</div>';
		}

		
		
		$_SESSION["total_plata_comanda"] = number_format($suma_total, 2, ',', '.');

		$suma_total = number_format($suma_total, 2, '', '.');
		$suma_total  = strval($suma_total );
		$suma_total  = str_split($suma_total ,strlen($suma_total )-2);


		echo '

		<div align="right" style="margin-right: 15%;padding: 20px;">
			<h3>Total: '.$suma_total [0].'<sup>'.$suma_total [1].'</sup></h3>
			<h4>Transport : <span style="color:rgb(0, 128, 0)">Gratuit</span></h4>
		</div>';
		

		echo '

		<div align="center" style="padding: 20px;">
			<button onclick="finalizare_comanda();" class="btn btn-animated btn-success btn-sm"> Trimite comanda <i class="fa fa-check"></i></button>
		</div>';
		
		mysqli_close($conn);
	}
}else{

	if ($id!=0) {
		if (!(in_array($id,$_SESSION["cos"])))
		{
		  array_push($_SESSION["cos"],$id);
		}
	}

	$host="localhost"; 					// Host name 
	$username="u717313805_admin"; 					// Mysql username 
	$password="romania@3"; 				// Mysql password 
	$db_name="u717313805_zone";			 	// Database name 
	$tbl_name="PRODUSE"; 	 				// Table name 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

	if ($conn->connect_error) {								   // Check connection
	    die("Connection failed: " . $conn->connect_error);
	}

	mysqli_select_db($conn,$db_name);						   // SELECT the database

	$query = "SELECT * FROM  `PRODUSE` WHERE  cod_produs IN (".implode(",",$_SESSION["cos"]).")";

	//Make the query
	$result=mysqli_query($conn,$query);

	$count=$result->num_rows;

	$_SESSION["numar_produse"] = $count;

	while($row = $result->fetch_assoc()) {

		$poza_principala = explode(";", $row["poza_produs"]);
		$poza_principala = $poza_principala[0];

		$pret =  explode(",",$row["pret_produs"]);
		$pret_prim = $pret[0];
		$zecimale = $pret[1];

		
		$pret_de_adunat = $row["pret_produs"];
		$pret_de_adunat = str_replace(".","",$pret_de_adunat); 
		$pret_de_adunat = str_replace(",",".",$pret_de_adunat);

		$suma_total = total_plata($suma_total,$pret_de_adunat);

		

		echo '
		<div class="col-md-4 " style="width:100%">
			<div class="pv-30 ph-20 feature-box light-gray-bg bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">

				<div class="media margin-clear">
					<div class="media-left">
						<div class="overlay-container_2">
							<img width="120" height="120" src="imagini_produs/'.$poza_principala.'" alt="">
						</div>
					</div>
					<div class="media-body" style="width:100%; padding-top:2%;">

						<div align="left" style="float:left;max-width:400px;">
							<span style="text-align:left;" class="media-heading"><a href="/shop-product?id='.$row["cod_produs"].'&product_name='.$row["nume_produs"].'">'.$row["nume_produs"].'</a></span>
						</div>
						<div class="col-md-4 ">
							<div class="ph-20 feature-box text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
								<h4><span class="price">'.$pret[0].'<sup>'.$zecimale.'</sup> RON</span></h4>
							</div>
						</div>	

						<div align="left" style="margin:20px;max-width:400px;">';

							if($row["stoc_produs"] == 0){
								echo '<span>Disponibilitate: </span><font color="red"><i class="fa fa-times-circle"> </i>  Nu este in stoc</font><br>';
							}else
							if($row["stoc_produs"] <= 10 && $row["stoc_produs"] > 0){
								echo '<span>Disponibilitate: </span><font color="orange"><i class="fa fa-exclamation-triangle"></i> Stoc Limitat ('.$row["stoc_produs"].' prod.)</font><br>';
							}else{
								echo '<span>Disponibilitate: </span><font color="green"><i class="fa fa-check"> </i> Stoc magazin suficient </font><br>';
							}

							

						echo '	
							<i class="fa fa-shield"></i> Garantie inclusa: 24 luni
						</div>

					</div>
					<hr>
				</div>
				
				<div align="right">
					<button type="button" onclick="delete_produs('.$row['cod_produs'].')" class="btn btn-animated btn-danger btn-sm">Sterge acest produs din cos <i class="fa fa-times"></i></button>
				</div>
			</div>
		</div>';
	}
	$_SESSION["total_plata_comanda"] = number_format($suma_total, 2, ',', '.');

	$suma_total = number_format($suma_total, 2, '', '.');
	$suma_total  = strval($suma_total );
	$suma_total  = str_split($suma_total ,strlen($suma_total )-2);

	echo '

	<div align="right" style="margin-right: 15%;padding: 20px;">
		<h3>Total: '.$suma_total [0].'<sup>'.$suma_total [1].'</sup></h3>
		<h4>Transport : <span style="color:rgb(0, 128, 0)">Gratuit</span></h4>
	</div>';

	echo '

	<div align="center" style="padding: 20px;">
			<button onclick="finalizare_comanda();" class="btn btn-animated btn-success btn-sm"> Trimite comanda <i class="fa fa-check"></i></button>
	</div>';
	mysqli_close($conn);

}

?>