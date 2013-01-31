<?php

//Database mambo-jambo
//DANGER: using mysqli for improved security, require this package on server.

//Remove this, so it is not web accessible
$DB_NAME = 'leilao';
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$query = "select * from quadros";

$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo stripslashes($row['id_quadro'].'<br/>');	
		echo stripslashes($row['info'].'<br/>');	
		echo stripslashes($row['preco_actual'].'<br/>');	
		echo stripslashes('<img src="'.$row['img_url'].'" width="100px"/><br/>');
		echo 'licitações: <br/>';
		$query2 = "select * from licitacao where id_quadro = $row[id_quadro]";
		$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
		if($result2->num_rows > 0) {
			while($row2 = $result2->fetch_assoc()) {
				echo "----<br/>";
				echo stripslashes("Nome:" . $row2['nome'].'<br/>');	
				echo stripslashes("Valor:" . $row2['valor'].'<br/>');	
				echo "----<br/>";
			}
		}
		else {
			echo 'NO RESULTS';	
		}
		echo "########<br/>";
	}
}
else {
	echo 'NO RESULTS';	
}

// CLOSE CONNECTION
mysqli_close($mysqli);



?>