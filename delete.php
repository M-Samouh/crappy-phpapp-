<?php
		try{
		$pdo = new PDO("mysql:host=localhost;dbname=projet","root","");
	}
	catch(Exception $e)
	{
		die('Erreur de Connexion' .$e->getMessage());
	}
	$id_mission = $_GET['id_mission'];
	$sql ='DELETE FROM mission where id_mission=:id_mission';
	$statement =$pdo->prepare($sql);

	if($statement->execute([':id_mission'=>$id_mission]))
	{
		header("location: missions.php");
	}


?>