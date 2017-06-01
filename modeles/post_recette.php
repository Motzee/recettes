<?php

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

switch ($_POST['categRecette']) {
    case "Entrées" :
        $sousdossier = "entrees" ;
    break ;
    case "Plats" :
        $sousdossier = "plats" ;
    break ;
    case "Boissons" :
        $sousdossier = "boissons" ;
    break ;
    case "Desserts" :
        $sousdossier = "desserts" ;
    break ;
    case "Gâteaux" :
        $sousdossier = "gateaux" ;
    break ;
    case "Glaces" :
        $sousdossier = "glaces" ;
    break ;
    case "Friandises" :
        $sousdossier = "friandises" ;
    break ;
    case "Non-comestibles" :
        $sousdossier = "non-comestibles" ;
    break ;
    default : 
        echo "une erreur de catégorie est survenue" ;
        exit ;
}

//préparation du nom de fichier grâce à un id et mise à jour du compteur
$compteurRecettes = fopen('../vues/recipes/nb-recettes.txt', 'r+');
$nbRecettes = fgets($compteurRecettes) ;
$nbRecettes += 1 ;
$nomFichier = "recipe".$nbRecettes ;
fseek($compteurRecettes, 0) ;
fputs($compteurRecettes, $nbRecettes) ;
fclose($compteurRecettes) ;

//préparation des chemins
$chemin = "../vues/recipes/".$sousdossier."/".$nomFichier ;
$emplacementPhoto = "../ressources/photos/".$photoRecette ;


//préparation du contenu du fichier (ajouter un bouton de suppression et un bouton d'édition)
$contenuFichier = "<figure>
	<img id=\"illustration-article\" src=\"img/$photoRecette\" alt=\"\" title=\"photo de la recette réalisée\" />
</figure>

<h2>$titreRecette</h2>

<section>
	<aside>
    <h3>Ingrédients :</h3>
		<ul>
			$ingredientsRecette
		</ul>
        <p><em>recette proposée par : $auteurRecette</em></p>
	</aside>
	$consignesRecette
    <br/>
    Astuce : $astuceRecette
	<hr class=\"cleareur\"/>
</section>
<p class=\"align_droite\">
<a href=\"delete-recette.php?nom=$nomFichier&categ=$sousdossier\" title=\"\"><img src=\"ressources/img/suppr.png\" alt=\"\" title=\"\" class=\"icon\"/></a>
<a href=\"edit-recette.php?nom=$nomFichier&categ=$sousdossier\" title=\"\"><img src=\"ressources/img/edit.png\" alt=\"\" title=\"\" class=\"icon\"/></a>
</p>
" ;



//Création du fichier dans le bon emplacement
$fichier = fopen($chemin, 'w+') ;
fwrite($fichier, $contenuFichier) ;
fclose($fichier) ;

header('Location:../index.php');
http_response_code(200);

exit ;

}
?>