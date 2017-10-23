<?php
include_once("gere-session.php") ;

if($statut != "user" && $statut != "admin") {
    exit(1) ;
}

$categExist = ["entrees", "plats", "boissons", "desserts", "gateaux", "glaces", "friandises", "non-comestibles"] ;

//si on a demandé une édition
if(isset($_POST['edition-recette']) && isset($_POST['edition-categ'])) {
    $edit = true ;
    $categO = filter_var($_POST['edition-categ'], FILTER_SANITIZE_STRING) ;

    in_array($categO, $categExist) ? $categOrigine = $categO : exit(1) ;

    $numRecette = filter_var($_POST['edition-recette'], FILTER_SANITIZE_STRING) ;

    supprimeDuMenuNav($categOrigine, $numRecette) ;

} else {
    $edit = false ;
}


/*on check si le formulaire est bien rempli, et on sécurise les variables*/
if(!isset($_POST['titreRecette']) || !isset($_POST['categRecette']) || !isset($_POST['ingredientsRecette']) || !isset($_POST['consignesRecette'])) {
    exit(1) ;
} else {

$titreRecette = filter_var($_POST['titreRecette'], FILTER_SANITIZE_STRING) ; //manque limitation à 255
$auteurRecette = isset($_POST['auteurRecette']) ? filter_var($_POST['auteurRecette'], FILTER_SANITIZE_STRING) : null ; //manque limitation à 30

$photoRecette = isset($_POST['photoRecette']) ? filter_var($_POST['photoRecette'], FILTER_SANITIZE_STRING) : null ; //manque limitation à 50 et test de validité de l'extension
$ingredientsRecette = filter_var($_POST['ingredientsRecette'], FILTER_SANITIZE_STRING) ;
$consignesRecette = filter_var($_POST['consignesRecette'], FILTER_SANITIZE_STRING) ;
$astuceRecette = isset($_POST['astuceRecette']) ? filter_var($_POST['astuceRecette'], FILTER_SANITIZE_STRING) : null ;


if(in_array($_POST['categRecette'], $categExist)) {
    $sousdossier = $_POST['categRecette'] ;
}

//préparation d'un objet php
$recetteEnPhp = array(
    'titre' => $titreRecette ,
    'auteur' => $auteurRecette ,
    'photo' => $photoRecette ,
    'ingredients' => $ingredientsRecette ,
    'etapes' => $consignesRecette ,
    'astuce' => $astuceRecette
);

//conversion en json
$recetteEnJSon = json_encode($recetteEnPhp) ;


if($edit != true) {
    //Si nouvelle recette : on génère un nom de fichier grâce à un id et mise à jour du compteur
    $compteurRecettes = fopen('../vues/recipes/nb-recettes.txt', 'r+');
    $nbRecettes = fgets($compteurRecettes) ;
    $nbRecettes += 1 ;
    $nomFichier = "recipe".$nbRecettes ;
    fseek($compteurRecettes, 0) ;
    fputs($compteurRecettes, $nbRecettes) ;
    fclose($compteurRecettes) ;

    if(!is_dir("../vues/recipes/".$sousdossier)) {
        mkdir("../vues/recipes/".$sousdossier) ;
    }
    
    $chemin = "../vues/recipes/".$sousdossier."/".$nomFichier.".json" ;

} elseif($edit == true && $categOrigine == $sousdossier) {
    //si on modifie mais que la catégorie ne change pas : on reprend le chemin et le nom d'origine pour réécrire dessus
    $nomFichier = $numRecette ;
    $sousdossier = $categOrigine ;

    $chemin = "../vues/recipes/".$categOrigine."/".$numRecette.".json" ;

} else {
    //on supprime l'ancienne recette d'un côté (il faudrait vérifier qu'elle existe)
    $chemin = "../vues/recipes/".$categOrigine."/".$numRecette.".json" ;

    @unlink($chemin) ;

    //préparation du nouveau chemin
    $nomFichier = $numRecette ;

    $chemin = "../vues/recipes/".$sousdossier."/".$nomFichier.".json" ;
}

//Création du fichier dans le bon emplacement
$fichier = fopen($chemin, 'w+') ;
fwrite($fichier, $recetteEnJSon) ;
fclose($fichier) ;

//mise à jour du menu de navigation
ajouteAuMenuNav($sousdossier, $nomFichier, $titreRecette) ;

$redirige = "Location:../recette.php?categ=".$sousdossier."&recette=".$nomFichier ;

header($redirige);
http_response_code(200);

exit ;

}

/**Edition du menu de navigation pour retirer la référence*/
function supprimeDuMenuNav($categorie, $nomFichier) {
    //récupération du menu actuel
    $menu = file_get_contents('../vues/recipes/menu.json') ;
    $menu = json_decode($menu);

    //suppression de la référence
    unset($menu->{$categorie}->{$nomFichier}) ;

    //réécriture du menu ainsi rectifié
    $menu = json_encode($menu);
    $fichier = fopen("../vues/recipes/menu.json", "w") ;
    fwrite($fichier, $menu) ;
    fclose($fichier) ;
}

/**Edition du menu de navigation pour ajouter la référence*/
function ajouteAuMenuNav($categorie, $nomFichier, $titreRecette) {
    //récupération du menu actuel
    $menu = file_get_contents('../vues/recipes/menu.json') ;
    $menu = json_decode($menu);

    //ajout de la référence
    $menu->$categorie->$nomFichier = "$titreRecette" ;

//réécriture du menu ainsi rectifié
    $menu = json_encode($menu);
    $fichier = fopen("../vues/recipes/menu.json", "w") ;
    fwrite($fichier, $menu) ;
    fclose($fichier) ;
}
?>