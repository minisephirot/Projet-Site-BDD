<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Like & Share</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">
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
				<a class="navbar-brand" href="index.php">Like & Share Website</a>
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
							<li><a href="scrobble.php">Scrobbler</a></li>
							<li><a href="mestats.php">Voir ses stats</a></li>
							<li><a href="listeuser.php">Voir les Utilisateurs</a></li>
						</ul>
					</li>
					<?php 
					if (empty($_SESSION['pseudo'])){
					echo '<li><a href="login.php">Connexion</a></li>';
					}else{
					echo '<li><a href="deconnexion.php">Deconnexion</a></li>';
					}
					?>
				</ul>
			</div>
		</div>
		</nav>
					  <div class="corps">
<?php 
    if (!empty($_SESSION['pseudo'])){
	echo " <h2>Bonjour ".$_SESSION['pseudo'].", voici vos scrobble :</h2>";
                $db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))";
		$user = "etud008";
		$passwd = "jonathan";
		  // Check connection
		  if($link = oci_connect("$user", "$passwd",$db)){
			$stid = oci_parse($link, "SELECT * FROM SCROBBLING WHERE PSEUDO = '".$_SESSION['pseudo']."'");
			oci_execute($stid);
			echo "<table border='1'> <th>Nom d'artiste</th>   <th>Titre</th> <th>Pseudo</th> <th>Date</th>	\n";
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
		  // define variables and set to empty values
		    $nomArtisteErr = $titreErr = "";
		    $nomArtiste = $titre = "";
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
			$titreErr = "titre is required";
		      } else {
			$titre = test_input($_POST["titre"]);
			// check if e-mail address is well-formed
			if (!preg_match("/^[a-zA-Z ]*$/",$titre)) {
			  $titreErr = "Only letters and white space allowed";
			}
		      }
		    }
		        
		    echo '<h2>Insertion de Scrobble</h2>
		    <p><span class="error">* required field.</span></p>';
		    echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">';
		    echo 'Nom artiste: <input type="text" name="nomArtiste" value="'.$nomArtiste.'">';
		    echo '<span class="error">*'.$nomArtisteErr.'</span>';
		    echo '<br><br>';
		    echo 'Titre: <input type="text" name="titre" value="'.$titre.'">';
		    echo '<span class="error">*'.$titreErr.'</span>';
		    echo '<br><br>';
		    echo '<input type="submit" name="submit" value="Submit">  
		    </form>';
		    echo "<br>";
		    echo "<br>";
		    
		    if(isset($_POST['submit'])){
		      echo "test";
			// Check connection
			if($link = oci_connect($user,$passwd,$db)){
			      $sql = "INSERT INTO SCROBBLING (NOM_ARTISTE,TITRE,PSEUDO) VALUES ('$nomArtiste','$titre','".$_SESSION['pseudo']."')";
			      echo $sql;
			      $stid = oci_parse($link, $sql);
			      if(oci_execute($stid)){
				      echo "Data inséré dans la base, veuillez rafraichir pour voir la BDD actualisée.";
				      oci_commit($link);
			      }else{
				echo '<p class="error">Une erreur est survenue (nom auteur pas dans la liste ou média déja existant) </p>' ;
			      }
			      oci_close($link);
			      header('Location: scrobble.php');
			      exit;
			}else{
			  $e = oci_error();   // Pour les erreurs oci_connect, aucun paramètre n'est passé
			  echo htmlentities($e['message']);
			  die();
			}
			oci_close($link);
			echo "</br> Connexion terminée et fermée </br>";
		    } 
					
		}else{
		  echo "Vous devez être connecté pour pouvoir scrobbler.";
		  header( "refresh:5;url=login.php" );
		}
		
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
				  		</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
