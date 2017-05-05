<?php

include "fonction.php";

$global ="SELECT titre,nb_scrob_total FROM V_SCROB_MEDIA
ORDER BY nb_scrob_total ASC";

$semaine = "SELECT titre,nb_scrob_semaine FROM V_SCROB_MEDIA_SEMAINE
ORDER BY nb_scrob_semaine ASC";

// peut être afficher un par défaut, et mettre 2 bouton un top semaine et l'autre top global qui change l'affichage
queryToTable($global);
queryToTable($semaine);


?>