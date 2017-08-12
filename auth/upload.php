<?php

 if (isset($_FILES['my_file'])) {
    
    $name_all_images = "";

	$myFile = $_FILES['my_file'];

	$fileCount = count($myFile["name"]);

	for ($i = 0; $i < $fileCount; $i++) {
		?>
			<p>File #<?= $i+1 ?>:</p>
			<p>
                ----------------------------------------------------------------<br>
				Name: <?= $myFile["name"][$i] ?><br>
				Temporary file: <?= $myFile["tmp_name"][$i] ?><br>
				Type: <?= $myFile["type"][$i] ?><br>
				Size: <?= $myFile["size"][$i] ?><br>
				Error: <?= $myFile["error"][$i] ?><br>
                ----------------------------------------------------------------<br>
			</p>
		<?php
        

		$target_dir = "../imagini_produs/";
		$target_file = $target_dir . basename($myFile["name"][$i]);

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($myFile["tmp_name"][$i]);
			if($check !== false) {
				echo " <li>Fisierul este o imagine de tipul - " . $check["mime"] . ".</li>";
				$uploadOk = 1;
			} else {
				echo "<li><font color='red'>Fisierul nu este o imagine.</font></li>";
				$uploadOk = 0;
			}
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			echo "<li><font color='red'>Fisierul $target_file exista deja!.</font></li>";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "<li><font color='red'>Doar fisiere de tipul JPG, JPEG, PNG & GIF pot fi adaugate.</font></li>";
			$uploadOk = 0;
		}

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<li><font color='red'>Fisierul nu a fost uploaded.</font></li>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($myFile["tmp_name"][$i], $target_file)) {
                echo "<li>Fisierul ". basename($myFile["name"][$i]). " a fost uploaded.</li>";

                $name_all_images = $name_all_images . basename($myFile["name"][$i]) . ";";
            }
        }
	//end for   
	}

    //conecatrea la baza de date si adaugarea produslui

    $host="localhost";                // Host name 
    $username="u717313805_admin";                  // Mysql username 
    $password="romania@3";            // Mysql password 
    $db_name="u717313805_zone";          // Database name 
    $tbl_name="PRODUSE";                // Table name 
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

    if ($conn->connect_error) {                             // Check connection
        die("Connection failed: " . $conn->connect_error);
    }

    mysqli_select_db($conn,$db_name);                         // SELECT the database

    // Make a Query

    $categorie_produs = mysqli_real_escape_string($conn,$_POST['categorie_produs']);
    $nume_produs = mysqli_real_escape_string($conn,$_POST['nume_produs']);
    $stoc_produs = mysqli_real_escape_string($conn,$_POST['stoc_produs']);
    $pret_produs = mysqli_real_escape_string($conn,$_POST['pret_produs']);
    $specificatii_produs = mysqli_real_escape_string($conn,$_POST['specificatii_produs']);

    $picture_name = $name_all_images;

    $query = "INSERT INTO $tbl_name (`categorie_produs`, `nume_produs`, `stoc_produs`, `pret_produs`, `specificatii_produs`, `poza_produs`) VALUES('".$categorie_produs."','".$nume_produs."',".$stoc_produs.",'".$pret_produs."','".$specificatii_produs."','".$picture_name."')";

    $result = mysqli_query($conn,$query);
    if($result == 1){
       echo "<li><font color='green' size='5' >Produs adaugat cu succes.</font></li>";  
    }  

    mysqli_close($conn);

    echo '<br><a href="http://it-zone.hol.es/auth/adauga_produse.html">Go Back </a>';
}
?>