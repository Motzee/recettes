<?php
$categs = ["entrees", "plats", "boissons", "desserts", "gateaux", "glaces", "friandises", "non-comestibles"] ;

if(!isset($_POST['categRecette']) || !isset($_POST['nomRecette'])) {
    echo "une erreur est survenue : le serveur ne sait pas quoi ou bien où supprimer. D'où venez-vous ? Qui êtes-vous ?" ;
} else {
    //penser à neutraliser les balises avec un filtre
    $categorie = in_array($_POST['categRecette'], $categs) ? $_POST['categRecette'] : exit ;
    $nomFichier = $_POST['nomRecette'] ;

    $chemin = "../vues/recipes/".$categorie."/".$nomFichier.".json" ;

    //suppression du fichier (s'il existe effectivement)
    @unlink($chemin) ;

    //edition du menu de navigation pour retirer la référence


    header('Location:../index.php');
    http_response_code(200);

    exit ;
}



?>