<?php

  echo "Connection... </br>";
  $db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))";
  $user = "etud008";
  $passwd = "jonathan";
    
    // Check connection
    if($link = oci_connect("$user", "$passwd",$db)){

          $sql = "INSERT INTO MEDIA VALUES ('Renaud','Raviolis','2015','fr','Lemeilleileurediteur')";
	  $stid = oci_parse($link, $sql);
	  oci_execute($stid);
	  echo "Records inserted successfully.";
	  oci_commit($link);
    
    }else{
      $e = oci_error();   // Pour les erreurs oci_connect, aucun paramètre n'est passé
      echo htmlentities($e['message']);
      die();
    }
    oci_close($link);
    echo "</br> Connexion terminée et fermée </br>";

?>