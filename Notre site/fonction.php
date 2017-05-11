<?php

$db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))";
$user = "etud008";
$passwd = "jonathan";
$conn;


function connect(){
  global $conn,$user,$passwd,$db;
  //$conn = oci_connect($user, $passwd, $db);
  If ($conn=oci_connect($user, $passwd, $db) ){}
  if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  }
}

function execute($query){
  global $conn;
  connect();
  $stid = oci_parse($conn, $query);
  oci_execute($stid);
  oci_commit();
  oci_close($conn);
  return $stid;
}


function queryToTable($query){
  global $conn;
  connect();
  $stid = oci_parse($conn, $query);
  oci_execute($stid);

   echo "<table border='1'>\n";
   while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
    }
    echo "</tr>\n";
    }
    echo "</table>\n";
    
    oci_close($conn);
}


function addArtiste($nomArtiste, $nom, $prenom){
  global $conn;
  $query= "insert into artiste values ('".$nomArtiste."','".$nom."','".$prenom."')";
  execute($query);
}


function existeArtiste($nomArtiste){
  global $conn;
  connect();
  $query = "select nomArtiste from artiste where nomArtiste = $nomArtiste";
  $stid=oci_parse($conn,$query);
  oci_execute($stid);
  $result = array();
  return oci_fetch_all($stid, $result);
}

function existeMedia($titre){
  global $conn;
  connect();
  $query = "select titre from media where nomArtiste = $titre";
  $stid=oci_parse($conn,$query);
  oci_execute($stid);
  $result = array();
  oci_close($conn);
  return oci_fetch_all($stid, $result);
}


function existeUtilisateur($pseudo,$mdp){
  global $conn;
  connect();
  $query="select pseudo from utilisateur where pseudo = '$pseudo' and mot_de_passe='$mdp'";
  $stid=oci_parse($conn,$query);
  oci_execute($stid);
  $result = array();
  oci_close($conn);
  return oci_fetch_all($stid, $result);
}


function ajouterLivre($nomArtiste,$titre,$genre,$date,$langue,$edit){
  global $conn;
  connect();
  $sql = "INSERT INTO MEDIA VALUES ('$nomArtiste','$titre','$date','$langue','$edit')";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  
  $sql = "INSERT INTO LIVRE VALUES ('$nomArtiste','$titre','$genre')";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  
  oci_commit();
  echo oci_num_rows($stid);
  oci_close($conn);
  return oci_num_rows($stid);
}

function ajouterMusique($nomArtiste,$titre,$duree,$genre,$type,$date,$langue,$edit){
  global $conn;
  connect();
  $sql = "INSERT INTO MEDIA VALUES ('$nomArtiste','$titre','$date','$langue','$edit')";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  
  $sql = "INSERT INTO TITRE_MUSICAL VALUES ('$nomArtiste','$titre',$duree,'$genre','$type')";
  echo $sql;
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  
  oci_commit();
  oci_close($conn);
  echo oci_num_rows($stid);
  return oci_num_rows($stid);
}


function ajouterFilm($nomArtiste,$titre,$genre,$date,$langue,$edit){
  global $conn;
  connect();
  $sql = "INSERT INTO MEDIA VALUES ('$nomArtiste','$titre','$date','$langue','$edit')";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  
  $sql = "INSERT INTO FILM VALUES ('$nomArtiste','$titre','$genre')";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  
  oci_commit();
  oci_close($conn);
  echo oci_num_rows($stid);
  return oci_num_rows($stid);
}


?>
