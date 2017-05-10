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
							<li><a href="listeuser.html">Voir les Utilisateurs</a></li>
						</ul>
					</li>
					<li><a href="login.php">Connexion</a></li>
				</ul>
			</div>
		</div>
		</nav>
		<div class="jumbotron">
	<div class="container">
		<h1>Partagez, Partout.</h1>
		<p>Vous en avez marre d'être le seul à reconnaitre votre immense talent pour choisir sa bonne musique ? Scrobblez là !</p>
		<br>
		<p><a class="btn btn-primary btn-lg" href="login.php" role="button">Connexion</a> <a class="btn btn-primary btn-lg" href="login.php" role="button">S'inscrire</a></p>
	</div>
	</div>
	<div class="container">
		<div class="row">
			<section class="call-to-action">
			<div class="col-md-4">
				<span class="glyphicon glyphicon-cloud glyphicon-large" aria-hidden="true"></span>
				<h3>Vos gouts, où que vous soyez.</h3>
				<p>Ici, vous ne risquez pas de ne pas savoir quelle titre à celle-là ou celle-ci. Vous trouverez tout, et en ligne.</p>
			</div>
			<div class="col-md-4">
				<span class="glyphicon glyphicon-floppy-disk glyphicon-large" aria-hidden="true"></span>
				<h3>Retrouvez votre musique.</h3>
				<p>Tant que vous avez Internet!</p>
			</div>
		</section>
		</div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
