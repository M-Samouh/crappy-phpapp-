<?php
		try{
		$pdo = new PDO("mysql:host=localhost;dbname=projet","root","");
	}
	catch(Exception $e)
	{
		die('Erreur de Connexion' .$e->getMessage());
	}
	$id = $_GET['id'];
	$sql ='DELETE FROM agent where id=:id';
	$statement =$pdo->prepare($sql);

	if($statement->execute([':id'=>$id]))
	{
		header("location: Agents.php");
	}


?>