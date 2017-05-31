<?php

/*on check si le formulaire est bien rempli*/
$nomFichier = "test.php" ;
$titreRecette = "Test de recette" ;

/*Si oui, on va :*/

$chemin = "../recettes/".$nomFichier ;
fopen($chemin, 'w+') ; //créer un fichier

echo "C'est censé être créé" ;
?>