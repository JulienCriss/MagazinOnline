<?php
	
	$host="localhost";                  // Host name 
    $username="u717313805_admin";                   // Mysql username 
    $password="romania@3";              // Mysql password 
    $db_name="u717313805_zone";             // Database name 
    $tbl_name="PRODUSE";                // Table name 
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $conn = new mysqli($host, $username, $password);           // Connect to server and select databse.

    if ($conn->connect_error) {                                // Check connection
        die("Connection failed: " . $conn->connect_error);
    }

    mysqli_select_db($conn,$db_name);                          // SELECT the database

    $categorie_produs = mysqli_real_escape_string($conn,$_GET['catProdus']);

    // Make a Query
	$sql="SELECT * FROM $tbl_name WHERE `categorie_produs`='$categorie_produs'";

	$result=$conn->query($sql);

	// Mysql_num_row is counting table row
	$count=$result->num_rows;
	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==0){
		echo '<div align="center"><font color="red" size="6" ><i class="fa fa-exclamation-triangle"></i> Nu exista rezultate pentru categoria '.$categorie_produs.'.</font></div>';
	}else
	{
		echo '<table border="1" style="border-color:#000; color:#fff">
                <colgroup>
                    <col width="200" ></col>
                    <col width="200" ></col>
                    <col width="200" ></col>
                    <col width="200" ></col>
                    <col width="200" ></col>
                </colgroup>';
		while($row = $result->fetch_assoc()) {

			if($row["stoc_produs"] > 0){
				echo '<tr align="center" style="background-color:#5cb85c">
                            <td>
                                <div style="padding-top:10px; padding-bottom:10px;">'.$row["cod_produs"].'</div>
                            </td>

                            <td>
                                <div style="padding-top:10px; padding-bottom:10px;">'.$row["categorie_produs"].'</div>
                            </td>
                            <td>
                               <div style="padding-top:10px; padding-bottom:10px;">'.$row["nume_produs"].'</div>
                            </td>
                            <td>
                                <div style="padding-top:10px; padding-bottom:10px;">'.$row["stoc_produs"].'</div>
                            </td>
                            <td>
                                <div style="padding-top:10px; padding-bottom:10px;">'.$row["pret_produs"].' <sup>99</sup> RON</div>
                            </td>
                        </tr>';

			}else
			{
				echo '<tr align="center" style="background-color:#d9534f">
                            <td>
                                <div style="padding-top:10px; padding-bottom:10px;">'.$row["cod_produs"].'</div>
                            </td>

                            <td>
                                <div style="padding-top:10px; padding-bottom:10px;">'.$row["categorie_produs"].'</div>
                            </td>
                            <td>
                               <div style="padding-top:10px; padding-bottom:10px;">'.$row["nume_produs"].'</div>
                            </td>
                            <td>
                                <div style="padding-top:10px; padding-bottom:10px;">'.$row["stoc_produs"].'</div>
                            </td>
                            <td>
                                <div style="padding-top:10px; padding-bottom:10px;">'.$row["pret_produs"].' <sup>99</sup> RON</div>
                            </td>
                        </tr>';

			}

		}

		echo '</table>';
	}
	mysqli_close($conn);
?>