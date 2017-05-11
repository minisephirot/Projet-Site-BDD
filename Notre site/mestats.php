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
					<li><a href="login.php">Connexion</a></li>
				</ul>
			</div>
		</div>
		</nav>
			  <div class="corps">
		<?php
		    if (!empty($_SESSION['pseudo'])){
                    echo " <h2>Bonjour ".$_SESSION['pseudo'].", voici vos statistiques :</h2>";
                    
                $db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))";
		$user = "etud008";
		$passwd = "jonathan";
		  // Check connection
		  if($link = oci_connect("$user", "$passwd",$db)){

			//Artiste total
			$stid = oci_parse($link, "SELECT nom_artiste, nb_scrob_total FROM V_STAT_ARTISTE WHERE PSEUDO = '".$_SESSION['pseudo']."'  ORDER BY nb_scrob_total DESC");
			oci_execute($stid);

			echo "<table border='1'> <th>Nom d'artiste</th>   <th>Nombre de fois que l'artiste a été scrobblé (tout les temps)</th>	\n";
			while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
			{
			  echo "<tr>\n";
			  foreach ($row as $item) {
			    echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
			  }
			  echo "</tr>\n";
			}
			echo "</table>\n";
			
			//Artiste semaine
			$stid = oci_parse($link, "SELECT nom_artiste, nb_scrob_semaine FROM V_STAT_ARTISTE_SEMAINE WHERE PSEUDO = '".$_SESSION['pseudo']."'  ORDER BY nb_scrob_semaine DESC");
			oci_execute($stid);

			echo "<table border='1'> <th>Nom d'artiste</th>   <th>Nombre de fois que l'artiste a été scrobblé (semaine)</th>	\n";
			while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
			{
			  echo "<tr>\n";
			  foreach ($row as $item) {
			    echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
			  }
			  echo "</tr>\n";
			}
			echo "</table>\n";
			
			//Media total
			$stid = oci_parse($link, "SELECT titre, nb_scrob_total FROM V_STAT_MEDIA WHERE PSEUDO = '".$_SESSION['pseudo']."'  ORDER BY nb_scrob_total DESC");
			oci_execute($stid);

			echo "<table border='1'> <th>Nom du media</th>   <th>Nombre de fois que le Media a été scrobblé (tout les temps)</th>	\n";
			while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
			{
			  echo "<tr>\n";
			  foreach ($row as $item) {
			    echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
			  }
			  echo "</tr>\n";
			}
			echo "</table>\n";
			
			//Media semaine
			$stid = oci_parse($link, "SELECT titre, nb_scrob_semaine FROM V_STAT_MEDIA_SEMAINE WHERE PSEUDO = '".$_SESSION['pseudo']."'  ORDER BY nb_scrob_semaine DESC");
			oci_execute($stid);

			echo "<table border='1'> <th>Nom du media</th>   <th>Nombre de fois que le Media a été scrobblé (semaine)</th>	\n";
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
                    
                    
                    
                    }else{
                    echo "Vous devez être connecté pour consulter vos statistiques.";
                    header( "refresh:5;url=login.php" );
                    }
		?>
	  		</div>
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
