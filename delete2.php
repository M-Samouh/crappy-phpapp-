<?php
		try{
		$pdo = new PDO("mysql:host=localhost;dbname=projet","root","");
	}
	catch(Exception $e)
	{
		die('Erreur de Connexion' .$e->getMessage());
	}
	$Num_departement= $_GET['Num_departement'];
	$sql ='DELETE FROM departement where Num_departement=:Num_departement';
	$statement =$pdo->prepare($sql);

	if($statement->execute([':Num_departement'=>$Num_departement]))
	{
		header("location: Departements.php");
	}


?>