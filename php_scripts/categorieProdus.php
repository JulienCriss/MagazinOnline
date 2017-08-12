<?php  

$host="localhost"; 					// Host name 
$username="u717313805_admin"; 		// Mysql username 
$password="romania@3"; 				// Mysql password 
$db_name="u717313805_zone";			// Database name 
$tbl_name="PRODUSE"; 				// Table name 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

if ($conn->connect_error) {								   // Check connection
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn,$db_name);						   // SELECT the database

// Make a Query


$categorie = mysqli_real_escape_string($conn,$_GET['catProduct']);



if ($categorie == 'TV &amp; Electronice') {
	$categorie = 'TV & Electronice';
}

$sql="SELECT * FROM $tbl_name WHERE categorie_produs = '$categorie' AND stoc_produs <>0";

$result=mysqli_query($conn,$sql);

// Mysql_num_row is counting table row
$count=$result->num_rows;


// If result matched $myusername and $mypassword, table row must be 1 row
if($count==0){
	echo '
		<div class="col-md-3 col-sm-6 masonry-grid-item">
			<div class="listing-item white-bg bordered mb-20">
				<div style="padding:50px;">
					<font color="red"><i class="fa fa-exclamation-triangle"></i> Nu exista rezultate. Probabil este o problema la conexiunea cu baza de date ... <br>'.$count.' : rezultate gasite</font>
				</div>
			</div>
		</div>';
}else{
	while($row = $result->fetch_assoc()) {

		$poza_principala = explode(";", $row["poza_produs"]);
		$poza_principala = $poza_principala[0];

		$pret =  explode(",",$row["pret_produs"]);
		$pret_prim = $pret[0];
		$zecimale = $pret[1];

		echo '	
			<div class="col-md-3 col-sm-6 masonry-grid-item" style="width:220px;">
				<div class="listing-item white-bg bordered mb-20">
						<div class="overlay-container" style="padding:20px;">
							<img  width="150" height="150" src="imagini_produs/'.$poza_principala.'" alt="">
							<a class="overlay-link popup-img-single" href="imagini_produs/'.$poza_principala.'"><i class="fa fa-search-plus"></i></a>
						</div>
						<div class="body">
							<p class="small" style="min-height: 114px;"><a href="/shop-product?id='.$row["cod_produs"].'&product_name='.$row["nume_produs"].'">'.$row["nume_produs"].'</a></p>';
							
							if($row["stoc_produs"] == 0){
								echo '<p class="small">
									<font color="red"><i class="fa fa-times-circle"> </i> <b> Nu este in stoc</b></font>
									</p>
									</div>
								</div>
							</div>';
							}else
							if($row["stoc_produs"] <= 10 && $row["stoc_produs"] > 0){
								echo '<p class="small">
									<font color="orange"><i class="fa fa-exclamation-triangle"></i> <b>Stoc Limitat ('.$row["stoc_produs"].' prod.)</b></font>
									</p>
									<div class="elements-list clearfix">
										<span class="price"><!--<del>3.395,98 RON</del>--> '.$pret_prim.'<sup>'.$zecimale.'</sup> RON</span>
											<!--<a href="/cos-cumparaturi?id='.$row["cod_produs"].'&product_name='.$row["nume_produs"].'" class="pull-right margin-clear btn btn-sm btn-default-transparent btn-animated">Adauga in cos<i class="fa fa-shopping-cart"></i></a>-->
											<button onclick="adauga_produs('.$row["cod_produs"].');" class="pull-right margin-clear btn btn-sm btn-default-transparent btn-animated">Adauga in cos<i class="fa fa-shopping-cart"></i></button>
										</div>
									</div>
								</div>
							</div>';
							}else{
								echo '<p class="small">
										<font color="green"><i class="fa fa-check"> </i><b> Stoc magazin suficient </b></font>
									</p>
								<div class="elements-list clearfix">
										<span class="price"><!--<del>3.395,98 RON</del>--> '.$pret_prim.'<sup>'.$zecimale.'</sup> RON</span>
											<!--<a href="/cos-cumparaturi?id='.$row["cod_produs"].'&product_name='.$row["nume_produs"].'" class="pull-right margin-clear btn btn-sm btn-default-transparent btn-animated">Adauga in cos<i class="fa fa-shopping-cart"></i></a>-->
											<button onclick="adauga_produs('.$row["cod_produs"].');" class="pull-right margin-clear btn btn-sm btn-default-transparent btn-animated">Adauga in cos<i class="fa fa-shopping-cart"></i></button>
										</div>
									</div>
								</div>
							</div>';}					
	}
}
mysqli_close($conn);
?>