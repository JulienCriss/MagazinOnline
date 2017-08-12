<?php
session_start();

function total_plata($total,$pret){
	
	if($total == 0){
		$total = $total + $pret ;
	}else
	{
		$total = $total + $pret ;
	}
	return $total;
}

$suma_total = 0;

if (!empty($_SESSION["cos"])){

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

	$_SESSION['numar_produse'] = $count;

		echo '
		<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-basket-1"></i><span class="cart-count default-bg">'.$_SESSION['numar_produse'].'</span></button>
		<ul class="dropdown-menu dropdown-menu-right dropdown-animation cart">
			<li>
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="product">Produs</th>
							<th class="amount">Subtotal</th>
						</tr>
					</thead>

					<tbody>';

					while($row = $result->fetch_assoc()) {

						$pret =  explode(",",$row["pret_produs"]);
						$pret_prim = $pret[0];
						$zecimale = $pret[1];

						$pret_de_adunat = $row["pret_produs"];
						$pret_de_adunat = str_replace(".","",$pret_de_adunat); 
						$pret_de_adunat = str_replace(",",".",$pret_de_adunat);
						
						$suma_total = total_plata($suma_total,$pret_de_adunat);

						echo '
						<tr>
							<td class="product"><a href="/shop-product?id='.$row["cod_produs"].'&product_name='.$row["nume_produs"].'">'.$row["nume_produs"].'</a></td>
							<td class="amount"><span class="price">'.$pret[0].'<sup>'.$zecimale.'</sup> RON</span></td>
						</tr>';
					}

					$suma_total = number_format($suma_total, 2, '', '.');
					$suma_total  = strval($suma_total );
					$suma_total  = str_split($suma_total ,strlen($suma_total )-2);

					echo '

						<tr>
							<td>Total Plata</td>
							<td>'.$suma_total [0].'<sup>'.$suma_total [1].'</sup> RON</td>
						</tr>';
					
				echo '
					
					</tbody>
				</table>
				<div class="panel-body text-right">	
					<a href="/cos-cumparaturi" class="btn btn-group btn-gray btn-sm">Verifica Cos</a>
				</div>
			</li>
		</ul>';
	}else{

		echo '
		<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-basket-1"></i><span class="cart-count default-bg">0</span></button>
		<ul class="dropdown-menu dropdown-menu-right dropdown-animation cart">
			<li>
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="product">Produs</th>
							<th class="amount">Subtotal</th>
						</tr>
					</thead>

					<tbody>

					</tbody>
				</table>
				<div class="panel-body text-right">	
					<a href="/cos-cumparaturi" class="btn btn-group btn-gray btn-sm">Verifica Cos</a>
				</div>
			</li>
		</ul>';
	}
?>