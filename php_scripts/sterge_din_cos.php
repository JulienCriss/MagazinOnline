<?php


session_start();


$id = $_GET['id_prod'];
for ($i=0; $i < count($_SESSION["cos"]) ; $i++) { 
	if ($id == $_SESSION["cos"][$i]) {
		unset($_SESSION["cos"][$i]);
	}
}

$_SESSION["cos"] = array_values($_SESSION["cos"]);


?>