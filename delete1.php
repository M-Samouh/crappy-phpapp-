<?php
		try{
		$pdo = new PDO("mysql:host=localhost;dbname=projet","root","");
	}
	catch(Exception $e)
	{
		die('Erreur de Connexion' .$e->getMessage());
	}
	$id_transport = $_GET['id_transport'];
	$sql ='DELETE FROM transport where id_transport=:id_transport';
	$statement =$pdo->prepare($sql);

	if($statement->execute([':id_transport'=>$id_transport]))
	{
		header("location: Transport.php");
	}


?>