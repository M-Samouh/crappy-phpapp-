<?php 
	$pdo = new PDO("mysql:host=localhost;dbname=projet","root","");
	$results["message"] = [];
	if(!empty($_POST))
	{
		if(!empty($POST['username']) && !empty($POST['password']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = $db->prepare("SELECT * FROM users WHERE username = :username");
			$sql->execute([':username'=>$username]);
			$row = $sql->fetch(PDO::fetch_obj);
			if($row)
			{
				if(password_verify($password,$row->password))
				{
					$results["error"]= false ;
					$results["user_id"]= $row->user_id ;
					$results["username"]= $row ->username ;
					header("location :home.html");
				}
				else
				{
					$results["error"]= true;
					$results["message"]= "mot de passe ou password incorrect";
				}
			}
			else
			{
				$results["error"]= true ;
				$results["message"]= "mot de passe ou password incorrect" ;
			}
		}
		else
			{
				$results["error"]= true ;
				$results["message"]= "Veuillez remplir tous les champs" ;
			}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="projet-style.css">
	<link href="asset/css/bootstrap.min.css" rel="stylesheet">
</head>
<body background="session.jpg">
	<div class="fadeindown">
	<div class="loginbox">
		<img src="avatar.png" class="avatar">
			<h2> Login Here</h2>
			<form method="POST" action="">
				<p>Username</p>
				<input type="text"	 name="username" placeholder="Enter Username" required="required">
				<p>Password</p>
				<input type="password"	 name="password" placeholder="Enter Password" required="required">
				<a href="home.html" class="btn btn-danger" style="width: 290px;background-color: red;" > Login</a>
				<a href="#" >Lost Your Password? </a><br>
				<a href="#" >Don't have an Account? </a><br>
			</form>
	</div>
	</div>
	<script type="text/javascript" src="asset/js/jquery.min.js"> </script>
	<script type="text/javascript" src="asset/js/bootstrap.min.js"> </script>
	


</body>
</html>