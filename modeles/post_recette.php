<?php

/*on check si le formulaire est bien rempli, et on sécurise les variables*/
$nomFichier = "test.php" ;
$titreRecette = $_POST['titreRecette'] ;
$auteurRecette = $_POST['auteurRecette'] ;
$categRecette = $_POST['categRecette'] ;
$photoRecette = "test" ;
$ingredientsRecette = $_POST['ingredientsRecette'] ;
$consignesRecette = $_POST['consignesRecette'] ;
$astuceRecette = $_POST['astuceRecette'] ;

//On prépare le contenu du fichier
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
</section>" ;

//on détermine dans quel dossier la recette va se ranger
$sousdossier = "" ;
switch ($categRecette) {
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
    default : echo "une erreur de catégorie est survenue" ;
}

$chemin = "../recettes/".$sousdossier."/".$nomFichier ;

//Création du fichier dans le bon emplacement
$fichier = fopen($chemin, 'w+') ;
$contenu = "je suis un test" ;
fwrite($fichier, $contenuFichier) ;
fclose($fichier) ;

header('Location:../index.php');

exit ;
?>