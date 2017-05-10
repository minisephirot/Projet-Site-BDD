<?php 
session_start();
include "fonction.php";


$pseudo = $_POST['username'];
$mdp = $_POST['password'];


$req = existeUtilisateur($pseudo,$mdp);
echo $req;

if ($req == 1){
  echo "<br/>vous êtes co";
  $_SESSION['pseudo'] = $pseudo;
  header("Location: index.php");
}else{
  header("Location: login.php");
}

?>