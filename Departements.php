<?php
  try{
    $pdo = new PDO("mysql:host=localhost;dbname=projet","root","");
  }
  catch(Exception $e)
  {
    die('Erreur de Connexion' .$e->getMessage());
  }
  $Nom_Departement=isset($_GET['Nom_departement'])?$_GET['Nom_departement']:"";
  $size = isset($_GET['size'])?$_GET['size']:6;
  $page = isset($_GET['page'])?$_GET['page']:1;
  $page=1;
  $offset= ($page-1)*$size;

  if($Nom_Departement=="")
  { 
    $requete = "select * from departement order by Num_departement limit 10 ";

   // $requeteCount = "SELECT count(*) countF from departement   WHERE Nom_departement Like '%$Nom_Departement%'";
  }
  else
  {
    if(isset($_GET['choix']))
    {
      $choix = $_GET['choix'];
      if($choix == "ID Dep")
      {
        $requete = "select * from departement where Num_departement = '$Nom_Departement'";
      }
      if($choix == "Nom Dep")
      {
        $requete = "select * from departement where Nom_departement like '%$Nom_Departement%'";
      }
      
    }

    //$requeteCount = "SELECT count(*) countF from departement WHERE Nom_departement Like '%$Nom_Departement%'";
  }

   $NomDepartement =isset($_POST['NomDepartement'])?$_POST['NomDepartement']:"Not Given";
  if($NomDepartement != "Not Given")
  {
      $requete1="INSERT INTO `departement`(`Nom_departement`) VALUES ('$NomDepartement')";
      $pdo->query($requete1); 
  }

  $resultatf =$pdo->query($requete);

  /*$resultatCount=$pdo->query($requeteCount);
  $tabCount=$resultatCount->fetch();
  $nbFiliere =$tabCount ['countF'];
  $reste=$nbFiliere %  $size ;

  if($reste ===0)
  {$nbrPage = $nbFiliere/$size;}
  else
      $nbrPage=floor($nbFiliere/$size)+1;*/
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
<h1 align="center" style="color: white;" ><i><b><u>Liste Des Deparetements</u></b></i></h1>
 <div class="container" style="width: 900px;">
         <div class="card border-success " >
              <div class="card-header card-info" >Liste des Departements
                <form method="GET" action="" style="float: right;">

            <div class="form-row align-items-center">
                  <div class="col-sm-4" style="width: 150px;">
                              <select class="form-control" name="choix">
                                <option> ID Dep</option>
                                <option> Nom Dep </option>
                              </select>
                         </div>
                  <div class="col-sm-4" style="width: 150px;">
                        <label class="sr-only"  >Nom Departement </label>
                            <input type="text" name="Nom_departement" class="form-control"  placeholder="Departement id" value="<?php echo $Nom_Departement ?>" >
                  </div>
                  <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary" style="width: 150px;"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </div>
                  
                  </div>
          </form>
              </div>
              <div class="card-body text-success">
                <table class="table table-hover ">

                      <thead class="thead thead-dark">
                          <tr>
                              <th> Numéro du Département </th>
                              <th> Nom du Département</th>
                              <th>Actions</th>
                          </tr>
                      </thead>

                      <tbody>
                        <form method="POST">
                          <?php while ($departement=$resultatf->fetch()) {?>
                            <tr>
                            
                                  <td> <?php echo $departement['Num_departement'] ; ?></td>
                                  <td> <?php echo $departement['Nom_departement'] ; ?></td>
                                  <td> <a href="#" class="btn btn-info">Edit</a><a onclick="return confirm('This Mission Will be Deleted From Your Table'); " href="delete2.php?Num_departement=<?=$departement['Num_departement'] ?>" class="btn btn-danger" style="margin-left: 6px;">Delete</a></td>

                            </tr> 
                          <?php } ?>
                        </form>
                      </tbody>
                </table>
              <div class="card-footer bg-transparent border-success">
                <div>
                  <ul class="nav nav-pills">
                  <?php for($i=1;$i<=3 ;$i++) { ?>
                  <li><a href="Departements.php">
                    
                      
                    </a>
                  </li>
                  <?php } ?>
                  </ul> 
                </div>
                <button type ="button" data-toggle="modal" style="width: 170px;float: right;" data-target="#exampleModal" class="btn btn-primary"><span class="glyphicon glyphicon-plus">Add Departement</button>
                  </div>
                                        <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header" style="background: grey;">
                                  <h5 class="modal-title" id="exampleModalLabel" style="color: white;">ADD DEPARTEMENT FORM</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" color="while">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                              </div>
                              <div class="modal-body">
                                  <form role="form" method="POST"> 
                                      <div class="form-group">
                                          <label >Nom du Departement</label>
                                          <input class="form-control" placeholder="Enter Here"  name="NomDepartement" required="required">
                                      </div> 
    
                           
                              </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="ajouter">ADD DEPARTEMENT</button>
                              </div>

                               </form>
                          </div>
                        </div>
                  </div>
         
              </div>
         </div>
</div>
</body>
</html>