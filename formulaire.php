<html>
	<head> 
		<title>Creation d'un formulaire</title>
        <style>
		</style>
        <?php
			/*function formulaire($nom,$action,$methode)
			{
				echo("<form name='$nom' action='$action'   method='$methode'>");
			}*/
			
				function creerZone($nom,$holder)
				{
					echo("<input type='text' name='$nom' placeholder=$holder>");
				}
				function caseOption()
				{
					$n=func_num_args();
					$i=0;
					for($i=0;$i<$n;$i++)
					{
						$nom=func_get_arg($i);
						echo $nom ;
						echo('<input type="radio" name="radio" valeur=func_get_arg($i)>');
					}
				}
				function submit($valeur1)
				{
					echo("<input type='submit' name='submit1' value=$valeur1>");
				}
				function annuler($valeur2)
				{
					echo "<input type='reset' name='annuler1' value=$valeur2>";
				}
			
		?>
	</head>
    <body>
       <form name="convertir" action="<?=$_SERVER['PHP_SELF']?>"  method="get">
    	  <?php
			echo ("Montant");
			echo ("<br>");
			echo ("<br>");
		    creerZone("zone","zone");
			echo ("<br>");
			echo ("<br>");
		    caseOption("choix1","choix2","choix3");
			echo ("<br>");
			echo ("<br>");
			submit("envoyer");
		   	annuler("annuler");
		    echo "<br></br>";
	 
		    if (isset($_GET['zone']) && isset($_GET['radio']) && isset($_GET['submit1']) ) 
		    {
		    	echo "<br>";
		    	echo "Nom :"; 
		     	creerZone("zone","VOTRO NOM");	
		     	echo ("<br>");
		    	echo "PreNom : ";
		    	creerZone("zone","VOTRO PRENOM");
		    	echo ("<br>");
		    	echo " Notes :" ;
		    	creerZone("zone","zone");
		    	echo ("<br>");
		    	echo"<h3>LANGUES</h3>";
		    	
		    	caseOption("anglais","francais","spanish");
		    }
		     ?> 
        </form>
	</body>
</html>