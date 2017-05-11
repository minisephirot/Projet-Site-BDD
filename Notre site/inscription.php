<?php 
session_start();
include "fonction.php";

echo "renvoi reussi";
$pseudo = $_POST['usernamesignup'];
$email = $_POST['emailsignup'];
$mdp = $_POST['passwordsignup'];
$age = $_POST['age'];
$code = $_POST['code_postal'];

$db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))";
  $user = "etud008";
  $passwd = "jonathan";
    // Check connection
    if($link = oci_connect("$user", "$passwd",$db)){
          $sql = "INSERT INTO UTILISATEUR VALUES ('$pseudo','$mdp','$age','$code')";
	  $stid = oci_parse($link, $sql);
	  if(oci_execute($stid)){
	  	  echo "Data inséré dans la base, veuillez rafraichir pour voir la BDD actualisée.";
		  oci_commit($link);
	  }else{
	    echo '<p class="error">Une erreur est survenue (nom auteur pas dans la liste ou média déja existant) </p>' ;
	  }
	  oci_close($link);
	  header('Location: index.php');
	  exit;
    }else{
      $e = oci_error();   // Pour les erreurs oci_connect, aucun paramètre n'est passé
      echo htmlentities($e['message']);
      die();
    }
    oci_close($link);
    echo "</br> Connexion terminée et fermée </br>";


?>