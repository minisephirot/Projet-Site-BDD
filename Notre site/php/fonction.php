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
  echo " fils de pute";
  return $stid;
}


function queryToTable($query){
  global $conn;
  //$res = execute($query);
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

  $query= "insert into artiste values (".$nomArtiste.",".$nom.",".$prenom.")";
  execute($query);
}







?>