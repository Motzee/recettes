<?php
require_once("gere-session.php") ;

if($statut != "user" && $statut != "admin") {
    exit(1) ;
}

if(!isset($pseudo) || !isset($statut) || $statut == "admin") {
    echo "il semble impossible de supprimer cet utilisateur, veuillez contacter l'administrateur" ;
} else {
    $membres = file_get_contents('../admin/membres.json') ;
    $membres = json_decode($membres);

    unset($membres->{$pseudo}) ;

    $membres = json_encode($membres);

    $fichier = fopen("../admin/membres.json", "w") ;
    fwrite($fichier, $membres) ;
    fclose($fichier) ;

    header('Location:deconnexion.php') ;
    http_response_code(200);
    exit ;
}

?>