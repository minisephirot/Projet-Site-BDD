<?php


// Paramètres de connexion
$db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.depinfo.uhp-nancy.fr)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=depinfo)))";
$user = "etud008";
$passwd = "jonathan";

// connexion
If ($conn=oci_connect($user, $passwd, $db) ){
   echo "Connexion serveur Oracle OK \n";

   $stid = oci_parse($conn, 'SELECT * FROM employe');
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



   oci_close ($conn);
}else {
      echo "Pb connexion";
}; 





?>