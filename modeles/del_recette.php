<?php
require_once("gere-session.php") ;

if($statut != "user" && $statut != "admin") {
    exit(1) ;
}

$categs = ["entrees", "plats", "boissons", "desserts", "gateaux", "glaces", "friandises", "non-comestibles"] ;

if(!isset($_POST['categRecette']) || !isset($_POST['nomRecette'])) {
    echo "une erreur est survenue : le serveur ne sait pas quoi ou bien où supprimer. D'où venez-vous ? Qui êtes-vous ?" ;
} else {
    //penser à neutraliser les balises avec un filtre
    $categorie = in_array($_POST['categRecette'], $categs) ? $_POST['categRecette'] : exit ;
    $nomFichier = $_POST['nomRecette'] ;

    $chemin = "../vues/recipes/".$categorie."/".$nomFichier.".json" ;

    $laRecette = file_get_contents($chemin) ;
    $laRecette = json_decode($laRecette) ;

    $auteurRecette = $laRecette -> {'auteur'} ;

    if($statut != "admin" && $pseudo != $auteurRecette) {
        echo "Il faut être propriétaire de la recette ou admin pour la supprimer" ;
        exit(1) ;
    }

    //suppression du fichier (s'il existe effectivement)
    @unlink($chemin) ;

    //edition du menu de navigation pour retirer la référence
    $menu = file_get_contents('../vues/recipes/menu.json') ;
    $menu = json_decode($menu);

    unset($menu->{$categorie}->{$nomFichier}) ;

    $menu = json_encode($menu);

    $fichier = fopen("../vues/recipes/menu.json", "w") ;
    fwrite($fichier, $menu) ;
    fclose($fichier) ;

//redirection
    header('Location:../index.php');
    http_response_code(200);

    exit ;
}

?>