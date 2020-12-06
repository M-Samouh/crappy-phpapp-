<?php

  try{
    $pdo = new PDO("mysql:host=localhost;dbname=projet","root","");
  }
  catch(Exception $e)
  {
    die('Erreur de Connexion' .$e->getMessage());
  }
  $size=20;
  $id_transport=isset($_POST['id_transport'])?$_POST['id_transport']:"";

  if($id_transport=="")
  {
    $requete = "select * from transport where id_transport>3 ORDER BY id_transport DESC limit $size  ";

  }
  else
  {
    if(isset($_POST['choix']))
    {
      $choix = $_POST['choix'];
      if($choix=="Matricule")
      {
         $requete = "select * from transport where matricule ='$id_transport' ORDER BY id_transport DESC limit $size "; 
      }
      else
         $requete = "select * from transport where id_transport ='$id_transport' ORDER BY id_transport DESC limit $size ";

    }
    else
      $requete = "select * from transport where id_transport ='$id_transport' ORDER BY id_transport DESC limit $size ";
  }

  //************************************
  $matricule = isset($_POST['Matricule'])?$_POST['Matricule']:"Not Given";
  if($matricule != "Not Given")
  {
      $requete1="insert into transport(matricule,type_vehicule) values ('$matricule','Voiture de Service')";
      $pdo->query($requete1);
  }

    

     
  $resultatf =$pdo->query($requete);
  
  $pdo = null ;
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width = device-width, initial-scale=1">
	<link rel="stylesheet" href="asset/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="asset/js/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
</head>
<body background="background.jpg">
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
        <a class="nav-link" href="missions.php">Missions <span class="sr-only">(current)</span></a>
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
<h1 align="center" style="color: white;" ><i><b><u>Liste Des Véhicules</u></b></i></h1>
<div class="container">
         <div class="card border-success " >
              <div class="card-header card-info" >Liste des Vehicules disponibles 
                <form method="post" action="" style="float: right;">

            <div class="form-row align-items-center">
                  <div class="col-sm-4" style="width: 150px;">
                        <select class="form-control" name="choix">
                          <option> ID Transport </option>
                          <option> Matricule </option>
                        </select>
                  </div>
                  <div class="col-sm-4" style="width: 150px;">
                        <label class="sr-only" for="inlineFormInputGroupUsername" >Id-transport </label>
                            <input type="text" name="id_transport" class="form-control" id="inlineFormInputGroupUsername" placeholder="Enter Here" value="<?php echo $id_transport ?>" >
                  </div>
                  <div class="col-sm-4">
                        <button type="submit" class="btn btn-secondary" style="width: 150px;"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </div>
                  
                  </div>
          </form>
              </div>
              <div class="card-body text-success">
                <table id="table" class="table table-hover">
                      <thead class="thead thead-dark">
                          <tr>
                              <th> ID transport </th>
                              <th> Matricule de la vehicule</th>
                              <th> type de vehicule</th>
                              <th> Actions </th>
                          </tr>
                      </thead>
                      <tbody>
                      
                          <?php while ($transport=$resultatf->fetch()) {?>
                            <tr>
                                <form method="post"> 
                                 <td> <?php echo $transport['id_transport'] ; ?></td>
                                  <td> <?php echo $transport['matricule'] ; ?></td>
                                  <td> <?php echo $transport['type_vehicule'] ; ?></td>
                                  <td> <a href="#" class="btn btn-info">Edit</a><a onclick="return confirm('This Row Will be Deleted From Your Table'); " href="delete1.php?id_transport=<?= $transport['id_transport'] ?>" class="btn btn-danger" style="margin-left: 6px;">Delete</a></td>
                                </form>
                            </tr> 
                          <?php } ?>
                          
                      </tbody>
                </table>



              <div class="card-footer bg-transparent border-success">
                <button type ="button" data-toggle="modal" style="width: 150px;float: right;" data-target="#exampleModal" class="btn btn-secondary"><span class="glyphicon glyphicon-plus">Add Transport</button>
                  </div>
                                        <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header" style="background: grey;">
                                  <h5 class="modal-title" id="exampleModalLabel" style="color: white;">ADD TRANSPORT FORM</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" color="while">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                              </div>
                              <form role="form" method="post"  action="transport.php">  
                              <div class="modal-body">
                                    
                                        <div class="form-group">
                                            <label >Matricule</label>
                                            <input type="text" class="form-control" placeholder="Enter Here"  name="Matricule" required="required"> 
                                        </div>  
              
                                 
                              </div>
                            <div class="modal-footer">
                            
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"  name="ajouter">ADD TRANSPORT </button>
                             
                              </div>
                               </form>
                          </div>
                        </div>
                  </div>
         
              </div>
         </div>
</div>
<?php
   /* if(isset($_POST['ajouter']))
    {
      if($_POST['Matricule'] && !empty($_POST['Matricule']) )
      {
        $matricule=$_POST['Matricule'];
        $requete3 = $pdo->prepare('INSERT INTO transport( matricule, type_vehicule) VALUES (`$matricule`,`voiture de servce`)');
        $requete3->execute(array($matricule));
      }
    }*/
?>
</body>
</html>
