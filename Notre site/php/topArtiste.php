<?php

include "fonction.php";

$global ="SELECT nom_artiste,nb_scrob_total FROM V_SCROB_ARTISTE
ORDER BY nb_scrob_total ASC";

$semaine = "SELECT nom_artiste,nb_scrob_semaine FROM V_SCROB_ARTISTE_SEMAINE
ORDER BY nb_scrob_semaine ASC";

// peut être afficher un par défaut, et mettre 2 bouton un top semaine et l'autre top global qui change l'affichage
queryToTable($global);
queryToTable($semaine);


?>