<?php

	try{
		$pdo = new PDO("mysql:host=localhost;dbname=projet","root","");
	}
	catch(Exception $e)
	{
		die('Erreur de Connexion' .$e->getMessage());
	}

	
	$nomagent=isset($_POST['Nom'])?$_POST['Nom']:"";
	if($nomagent =="")
	{
		$requete = "select agent.id,Nom,Prenom,email,categorie,affecter.Num_departement,calendar from agent,affecter where Nom like '%$nomagent%' and   agent.id=affecter.id   Group by agent.id";
	}
	else
	{
		if(isset($_POST['choix']))
		{
			$choix = $_POST['choix'];
			if($choix == "ID")
			{
				$requete = "select agent.id,Nom,Prenom,email,categorie,agent.Num_departement,calendar from agent,affecter where   agent.id=affecter.id and agent.id = '$nomagent' Group by agent.id";
			}
			if($choix == "Nom")
			{
				$requete = "select agent.id,Nom,Prenom,email,categorie,agent.Num_departement,calendar from agent,affecter	where   agent.id=affecter.id and Nom like '%$nomagent%' Group by agent.id ";
			}
			if($choix == "Departement")
			{
				$requete = "SELECT agent.id,Nom,Prenom,email,categorie,agent.Num_departement,calendar FROM agent,departement,affecter WHERE agent.Num_departement = departement.Num_departement AND agent.id=affecter.id AND departement.Nom_departement like '%$nomagent%' Group by agent.id ";
			}
		}
	}
	
	$idagent=isset($_POST['idagent'])?$_POST['idagent']:"";
	$dateaffecter=isset($_POST['dateaffecter'])?$_POST['dateaffecter']:"";
	$departementaffecter=isset($_POST['departementaffecter'])?$_POST['departementaffecter']:"";

	if ($idagent!="" && $dateaffecter!="" && $departementaffecter!="")
	{
		$requete2="UPDATE `affecter` SET `calendar`='$dateaffecter', `Num_departement` = '$departementaffecter' WHERE `affecter`.`id` = '$idagent'; ";
		$pdo->query($requete2);
	}

	$name =isset($_POST['name'])?$_POST['name']:"";
	$Prenom =isset($_POST['Prenom'])?$_POST['Prenom']:"";
	$email =isset($_POST['email'])?$_POST['email']:"";
	$classe =isset($_POST['classe'])?$_POST['classe']:"";
	$Num_departement =isset($_POST['Num_departement'])?$_POST['Num_departement']:"";

	if($email !="" && $name!="")
	{

		$requete3 = " INSERT INTO `agent`( `Nom`, `Prenom`, `email`, `categorie`, `Num_departement`) VALUES ('$name','$Prenom','$email','$classe','$Num_departement') ";

		$pdo->query($requete3);
	}

	$resultatf =$pdo->query($requete);
	$pdo = null;

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link  href="asset/fonts/glyphicons-halflings-regular.eot">
	<link  href="asset/fonts/glyphicons-halflings-regular.ttf">
	<link  href="asset/fonts/glyphicons-halflings-regular.woff">
	<link  href="asset/fonts/glyphicons-halflings-regular.svg">
	<link  href="asset/fonts/glyphicons-halflings-regular.woff2">
	<meta name="viewport" content="width = device-width, init2ial-scale=1">
	<link rel="stylesheet" href="asset/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="asset/js/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
</head>
<body background="background.jpg" >
	<!--------  Navigation ---------->
 	<nav style="height: 70px;" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a href="Home.html"><img src="images.jpg" style="height:70px; width: 80px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul style="margin-left: 70px;" class="navbar-nav mr-auto">
      <li  style="margin-left: 70px;" class="nav-item">
        <a class="nav-link" href="home.html ">Home</a>
      </li>
      <li style="margin-left: 70px;"  class="nav-item ">
        <a class="nav-link" href="Missions.php">Missions <span class="sr-only">(current)</span></a>
      </li>
      <li  style="margin-left: 70px;" class="nav-item">
        <a class="nav-link" href="Agents.php ">Agents</a>
      </li>
     <li style="margin-left: 70px;" class="nav-item">
        <a class="nav-link " href="Departements.php" tabindex="-1" aria-disabled="false">Departements</a>
      </li>
      <li style="margin-left: 70px;" class="nav-item">
        <a class="nav-link " href="Transport.php" tabindex="-1" aria-disabled="false">Transport</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
	<!-----------------navigation------------------>
<br>
<h1 align="center" style="color: white;" ><i><b><u>Liste Des Agents</u></b></i></h1>
<div class="container">
         <div class="card border-success " >
              <div class="card-header card-info">
              
              <form method="post" action="" style="float: right;">

	  				<div class="form-row align-items-center">
	  							<div class="col-sm-4" style="width: 150px;">
			                        <select class="form-control" name="choix">
			                          <option> ID </option>
			                          <option> Nom </option>
			                          <option> Departement </option>
			                        </select>
			                   </div>
	    						<div class="col-sm-4">
	      								<label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
	       								 		<input type="text" name="Nom" class="form-control" id="inlineFormInputGroupUsername" placeholder="Agent Name " value="<?php echo $nomagent ?>">
	    						</div>
		    					<div class="col-sm-4">
		     								<button type="submit" class="btn btn-primary" style="width: 150px;"><span class="glyphicon glyphicon-search"></span> Search</button>
		   					    </div>
	    						
	  							</div>
					</form>
              </div>
              <div class="card-body text-success">
                
	              <table class="table table-hover ">
			<thead class="thead-dark">
				<tr>
					<th> Id Agent</th>
					<th> Nom Agent </th>
					<th> Prenom </th>
					<th> email </th>
					<th> categorie </th>
					<th> Date Affectation</th>
					<th> Actions</th>
					<th></th>
				</tr>
			</thead>

		<tbody  >
			<?php while ($agents=$resultatf->fetch()) {?>
				<tr>
					<form method="post">
						<td> <?php echo $agents['id'] ; ?></td>
						<td> <?php echo $agents['Nom'] ; ?></td>
						<td> <?php echo $agents['Prenom'] ; ?></td>
						<td> <?php echo $agents['email'] ; ?></td>
						<td> <?php echo $agents['categorie']  ;?></td>
					    <td> <?php echo $agents['calendar']  ;?></td>

						<td> <a href="#" class="btn btn-info">Edit</a><a onclick="return confirm('This Mission Will be Deleted From Your Table'); " href="delete3.php?id=<?=$agents['id'] ?>" class="btn btn-danger" style="margin-left: 6px;">Delete</a></td>
					</form>
				</tr>	
			<?php } ?>
		</tbody>
	</table>
	<div class="card-footer">
								
										<button type ="button" class="btn btn-primary " data-toggle="modal" style="margin-left : 20px;width: 150px;float: right;" data-target="#exampleModal" class="btn btn-primary">ADD Agent</button>   

																	<!-- Modal -->
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			 						    <div class="modal-dialog" role="document">
			    								<div class="modal-content">
			    								    <div class="modal-header" style="background: grey;">
			        										<h5 class="modal-title" id="exampleModalLabel" style="color:white ;">ADD AGENT FORM</h5>
			        										<button type="button" class="close" data-dismiss="modal" aria-label="Close" color="while">
			          										<span aria-hidden="true">&times;</span>
			       										    </button>
			      									</div>
			      									<div class="modal-body">
			        				 			   		<form role="form" method="post" action="Agents.php">
			        				 			   			<div class="form-group">
																	<label >Nom d'agent</label>
																	<input class="form-control"  placeholder="Enter Last Name" 
																	name="name" required="required">
															</div>
															<div class="form-group">
																	<label >Prenom</label>
																	<input class="form-control" placeholder="Enter First Name "  name="Prenom" required="required">
															</div>
															<div class="form-group">
																	<label for="exampleInputEmail1">Email address</label>
																	<input class="form-control"  placeholder="Enter email" type="email" name="email" required="required">
															</div>
															<div class="form-group">
																	<label >Categorie</label><br> 
																	<select name="classe" class="mdb-select md-form colorful-select dropdown-primary" style="width: 465px; height: 40px;" required="required">
																		<option name="cadre" value="c"> Cadre</option>
																		<option name="Agent" value="a"> Agent</option>
																	</select>
															</div>
															<div class="form-group">
																	<label >Num Departement</label>
																	<input class="form-control" placeholder="Enter First Name "  name="Num_departement" required="required">
															</div>
														
      												</div>
     						 						<div class="modal-footer">
        												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        												<input type="submit" class="btn btn-primary" name="ajouter" value="ADD "></button>
     										    	</div>
    											</div>
    											</form>
  								   		</div>
									</div>
         
										<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" style="float: right;">
											Affecter Agent	</button>

											<!-- Modal -->
											<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
										aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
												
												<h4 class="modal-title" id="myModalLabel" style="float: right;">
												Affecter Agent Form
												</h4>
												<button type="button" class="close"
												data-dismiss="modal" aria-hidden="true">
												&times;
												</button>	
										</div>
										<div class="modal-body">
											<form method="post" action="Agents.php">

												<div class="form-group">
																	<label >id d'agent</label>
																	<input class="form-control"  placeholder="Enter Last Name" 
																	name="idagent" required="required">
												</div>
												<div class="form-group">
																	<label >Date d'affectation</label>
																	<input class="form-control"  placeholder="Enter Last Name" 
																	name="dateaffecter" required="required">
												</div>
												<div class="form-group">
																	<label >Departement D'affectation</label>
																	<input class="form-control"  placeholder="Enter Last Name" 
																	name="departementaffecter" required="required">
												</div>
										</div>
										<div class="modal-footer">
													<button type="button" class="btn btn-secondary"
													data-dismiss="modal">Close
													</button>
													<input type="submit" class="btn btn-primary" value="Submit">
													
													
												</form>
										</div>
										</div><!-- /.modal-content -->
										</div><!-- /.modal -->
	    	            			
</div>


	
</body>
</html>