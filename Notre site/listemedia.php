<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Like & Share</title>
 
    <!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
.error {color: #FF0000;}
</style>
  </head>
  <body>
	  	  <nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">Like & Share Website</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="listemedia.php">Voir les Media</a></li>
							<li><a href="listeartiste.php">Voir les Artistes</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="scrobble.html">Scrobbler</a></li>
							<li><a href="mestats.html">Voir ses stats</a></li>
							<li><a href="listeuser.php">Voir les Utilisateurs</a></li>
						</ul>
					</li>
					<li><a href="login.html">Connexion</a></li>
				</ul>
			</div>
		</div>
		</nav>
		
	  <div class="corps">
		<?php

		$db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))";
		$user = "etud008";
		$passwd = "jonathan";
		  
		  // Check connection
		  if($link = oci_connect("$user", "$passwd",$db)){

			$stid = oci_parse($link, 'SELECT * FROM MEDIA');
			oci_execute($stid);

			echo "<table border='1'>\n";
			while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
			{
			  echo "<tr>\n";
			  foreach ($row as $item) {
			    echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
			  }
			  echo "</tr>\n";
			}
			echo "</table>\n";
		  
		  }else{
		    $e = oci_error();   // Pour les erreurs oci_connect, aucun paramètre n'est passé
		    echo htmlentities($e['message']);
		    die();
		  }

		  oci_close($link);
		 ?>
		
<?php 
// define variables and set to empty values
$nomArtisteErr = $titreErr = $editErr = $langueErr = $dateErr = "";
$nomArtiste = $titre = $edit = $langue = $date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["nomArtiste"])) {
    $nomArtisteErr = "Name is required";
  } else {
    $nomArtiste = test_input($_POST["nomArtiste"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$nomArtiste)) {
      $nomArtisteErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["titre"])) {
    $titreErr = "Titre is required";
  } else {
    $titre = test_input($_POST["titre"]);
    // check if e-mail address is well-formed
    if (!preg_match("/^[a-zA-Z ]*$/",$titre)) {
      $titreErr = "Only letters and white space allowed";
    }
  }
    
  if (empty($_POST["date"])) {
    $dateErr = "Date is required";
  } else {
    $date = test_input($_POST["date"]);
    // check if e-mail address is well-formed
    if (!preg_match('/^[0-9]{4}$/',$date)) {
      $dateErr = "Date must be 4 digits long (year)";
    }
  }

  if (empty($_POST["langue"])) {
    $langueErr = "Language is required";
  } else {
    $langue = test_input($_POST["langue"]);
    // check if e-mail address is well-formed
    if (!preg_match('~\b(fr|angl|autre)\b~i',$langue)) {
      $langueErr = "langue must be on of -fr/angl/autre-";
    }
  }
  
  if (empty($_POST["editeur"])) {
    $editErr = "Editor is required";
  } else {
    $edit = test_input($_POST["editeur"]);
    // check if e-mail address is well-formed
    if (!preg_match("/^[a-zA-Z ]*$/",$edit)) {
      $editErr = "Only letters and white space allowed";
    }
  }
  
 }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Insertion de media</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Nom de l'artiste: <input type="text" name="nomArtiste" value="<?php echo $nomArtiste;?>">
  <span class="error">* <?php echo $nomArtisteErr;?></span>
  <br><br>
  Titre: <input type="text" name="titre" value="<?php echo $titre;?>">
  <span class="error">* <?php echo $titreErr;?></span>
  <br><br>
  Date: <input type="text" name="date" value="<?php echo $date;?>">
  <span class="error"><?php echo $dateErr;?></span>
  <br><br>
  Langue: <input type="text" name="langue" value="<?php echo $langue;?>">
  <span class="error"><?php echo $langueErr;?></span>
  <br><br>
  Editeur: <input type="text" name="editeur" value="<?php echo $edit;?>">
  <span class="error">* <?php echo $editErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
/*echo "<h2>Your Input:</h2>";
  echo $nomArtiste;
  echo "<br>";
  echo $titre;
  echo "<br>";
  echo $date;
  echo "<br>";
  echo $langue;
  echo "<br>";
  echo $edit; */
  
echo "<br>";echo "<br>";

if(isset($_POST['submit']))
{
  $db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))";
  $user = "etud008";
  $passwd = "jonathan";
    
    // Check connection
    if($link = oci_connect("$user", "$passwd",$db)){

          $sql = "INSERT INTO MEDIA VALUES ('$nomArtiste','$titre','$date','$langue','$edit')";
	  $stid = oci_parse($link, $sql);
	  if(oci_execute($stid)){
	  	  echo "Records inserted successfully.";
		  oci_commit($link);
	  }else{
	    echo '<p class="error">Une erreur est survenue (nom auteur pas dans la liste ou média déja existant) </p>' ;
	  }
	  header('Location: listemedia.php');
	  exit;
    
    }else{
      $e = oci_error();   // Pour les erreurs oci_connect, aucun paramètre n'est passé
      echo htmlentities($e['message']);
      die();
    }
    oci_close($link);
    echo "</br> Connexion terminée et fermée </br>";
} 
?>
  		</div>
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
