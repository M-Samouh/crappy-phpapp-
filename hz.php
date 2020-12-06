<html>
<head>
	<title></title>
</head>
<body>

	<form method="get" action="hz.php">
		<label> prix HT : </label>
    	<input type="text" name="HT" value="<?php if (isset($_GET["HT"])) 
    												echo $_GET["HT"] ;?> "> 
		<label>  prix TVA </label>
		<input type="text" name="TTVA" value="<?php if (isset($_GET["TTVA"]))
													 echo $_GET["TTVA"] ;?>">

		<?php
		if (isset($_GET["HT"]) && isset($_GET["TTVA"]))
		{
			$TVA = (double)($_GET["HT"]) * ($_GET["TTVA"])/100;
			$TTC = (double)($_GET["HT"])+ $TVA ;

			echo " TTC   <input name='TTC' value = ".$TTC."><br></br> ";
			echo " TVA <input name='TVA' value = ".$TVA."><br></br> ";
		} 

		?>
		<input type="submit" name="" value="calculer">
		<input type="reset" name="" value="annuler">
	</form>
</body>
</html>

	