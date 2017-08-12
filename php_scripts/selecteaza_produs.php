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

// Prevent mysql injection
$id_produs = mysqli_real_escape_string($conn,$_GET['id']);
$nume_produs = mysqli_real_escape_string($conn,$_GET['product_name']);

$id_produs = stripslashes($id_produs);
$nume_produs = stripslashes($nume_produs);


// Make a Query
$sql="SELECT * FROM $tbl_name WHERE `cod_produs`=$id_produs";

//take result
$result=mysqli_query($conn,$sql);



while($row = $result->fetch_assoc()) {

	$poze = explode(";", $row["poza_produs"]);
	$nr_poze = count($poze);

	$pret =  explode(",",$row["pret_produs"]);
	$pret_prim = $pret[0];
	$zecimale = $pret[1];

	echo '<!-- main-container start  PRIMA SECTIUNE-->
				<!-- ================ -->
				<section class="main-container">

					<div class="container">
						<div class="row">

							<!-- main start -->
							<!-- ================ -->
							<div class="main col-md-12">

								<!-- page-title start -->
								<!-- ================ -->
								<h3>'.$row["nume_produs"].'</h3>
								<div><small>Cod produs IT-zone: '.$row["cod_produs"].'</small></div>
								<div class="separator-2"></div>
								<!-- page-title end -->

								<div class="row">
									<div class="col-md-4">
										<!-- pills start -->
										<!-- ================ -->
										<!-- Nav tabs -->
										<ul class="nav nav-pills" role="tablist">
											<li class="active"><a href="#pill-1" role="tab" data-toggle="tab" title="images"><i class="fa fa-camera pr-5"></i> Photo</a></li>
										</ul>
										
										<!-- Tab panes -->

											<div class="tab-content clear-style">
												<div class="tab-pane active" id="pill-1">
													<div class="owl-carousel content-slider-with-large-controls owl-theme" style="display: block; opacity: 1;">
														<div class="owl-wrapper-outer">
															<div class="owl-wrapper" style="width: 3580px; left: 0px; display: block;">';

															echo '
														<div class="owl-item" style="width: 358px;">
															<div class="overlay-container overlay-visible">
																<img src="imagini_produs/'.$poze[0].'">
																<a href="imagini_produs/'.$poze[0].'" class="popup-img overlay-link" title="image title"><i class="icon-plus-1"></i></a>
															</div>
														</div>';

			
										echo '
													</div>
												</div>

												<div align="center">
													<div>';

													for ($x = 0; $x < $nr_poze-1; $x++) {
														
								
															echo '
														<i class="fa fa-circle" onclick="show_image_product(\''.$poze[$x].'\');" style="cursor:pointer"> </i> ';
														
													}
									echo '
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- pills end -->
									</div>
									<div class="col-md-8 pv-30">
										
										<div class="light-gray-bg p-20 bordered clearfix">
											<div style="padding:20px;"><i class="fa fa-shield"></i> Garantie inclusa: 24 luni</div>
											<span class="product price"><i class="icon-tag pr-10"></i>'.$pret_prim.'<sup>'.$zecimale.'</sup> RON</span>
											<div class="product elements-list pull-right clearfix">
												<button onclick="adauga_produs('.$row["cod_produs"].');" class="pull-right margin-clear btn btn-sm btn-default-transparent btn-animated">Adauga in cos<i class="fa fa-shopping-cart"></i></button>
											</div>';

											if($row["stoc_produs"] == 0){
												echo '<div style="padding:20px;"><font color="red"><i class="fa fa-times-circle"> </i>  Nu este in stoc</font> | Transport Gratuit | Vandut de IT-Zone</div>';
											}else
											if($row["stoc_produs"] <= 10 && $row["stoc_produs"] > 0){
												echo '<div style="padding:20px;"><font color="orange"><i class="fa fa-exclamation-triangle"></i> Stoc Limitat ('.$row["stoc_produs"].' prod.)</font> | Transport Gratuit | Vandut de IT-Zone</div>';
											}else{
												echo '<div style="padding:20px;"><font color="green"><i class="fa fa-check"> </i> Stoc magazin suficient </font> | Transport Gratuit | Vandut de IT-Zone</div>';
											}

										echo '

										</div>
									</div>
								</div>
							</div>
							<!-- main end -->

						</div>
					</div>
				</section>
				<!-- main-container end -->';




echo '

				<!-- section start Al DOILEA SECTION-->
				<!-- ================ -->
				<section class="pv-30 light-gray-bg">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs style-4" role="tablist">
									<li class="active"><a href="#h2tab2" role="tab" data-toggle="tab"><i class="fa fa-files-o pr-5"></i>Specificatii</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content padding-top-clear padding-bottom-clear">
									<div class="tab-pane fade in active" id="h2tab2" style="background-color: #fff;padding: 30px;">
										<hr>
										<dl class="dl-horizontal" style="overflow-y: scroll;max-height: 500px;">'
											.$row['specificatii_produs'].
										'</dl>
										<hr>
									</div>
								
								</div>
							</div>

							<!-- sidebar start -->
							<!-- ================ -->
							<aside class="col-md-4 col-lg-3 col-lg-offset-1">
								<div class="sidebar">
									<div class="block clearfix">
										<h3 class="title"> <i class="fa fa-opencart"> </i> Puteti cumpara si ... </h3>
										<div class="separator-2"></div>';



										$sql_2="SELECT * FROM  $tbl_name ORDER BY RAND() LIMIT 0 , 5";
										$result_2=mysqli_query($conn,$sql_2);

										while($row_2 = $result_2->fetch_assoc()) {

											$poza_principala_2 = explode(";", $row_2["poza_produs"]);
											$poza_principala_2 = $poza_principala_2[0];

											$pret_2 =  explode(",",$row_2["pret_produs"]);
											$pret_prim_2 = $pret_2[0];
											$zecimale_2 = $pret_2[1];


											echo'<div class="media margin-clear">
													<div class="media-left">
														<div class="overlay-container_2">
															<img src="imagini_produs/'.$poza_principala_2.'" alt="">
														</div>
													</div>
													<div class="media-body">
														<h6 class="media-heading"><a href="/shop-product?id='.$row_2["cod_produs"].'&product_name='.$row_2["nume_produs"].'">'.$row_2["nume_produs"].'</a></h6>
														
														<p class="price">'.$pret_prim_2.'<sup>'.$zecimale_2.'</sup> RON</p>
													</div>
													<hr>
												</div>';
										}
						echo '				
									</div>
								</div>
							</aside>
							<!-- sidebar end -->

						</div>
					</div>
				</section>
				<!-- section end -->';
				}
mysqli_close($conn);
?>