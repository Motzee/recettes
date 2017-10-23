<?php
//on vérifie que le formulaire est bien rempli
if(isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['authentifie'])) {
    if(!file_exists("../admin/")) {
        echo "Problème : absence d'un dossier admin disposant des permissions d'écriture, veuillez faire le nécessaire" ;
    }
    
    if(!file_exists("../admin/hash")) {
        //création du sel
        $sel = hash('sha512', rand(0, 999999999999)) ;
        $hash = file_put_contents('../admin/hash', $sel);
        chmod('../admin/hash', 0600); 
        fclose($hash) ;
    }
    
    if(!file_exists("../admin/membres.json")) {
        //création de la liste des membres
        $listemembres = fopen('../admin/membres.json', 'w+') ;
        chmod('../admin/membres.json', 0600); 
        fclose($listemembres) ;
    }
    
    $pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING) ;
    $mdp = $_POST['mdp'].file_get_contents('../admin/hash') ;
    $mdpcuisine = hash('sha256', $mdp);
    

    //si la personne veut s'inscrire
    if($_POST['authentifie'] == "signin") {
        //on récupère le fichier json
        $membres = file_get_contents('../admin/membres.json') ;
        $membres = json_decode($membres);

        //on checke si le pseudo n'est pas déjà pris
        if(isset($membres->{$pseudo})) {
            echo "Désolé, ce pseudo est déjà pris" ;
        } else {
            //sinon on y ajoute le nouveau membre
            $profil = array (
                "hash" => $mdpcuisine,
                "statut" => "user",
                "recettes" => ""
            );

            $membres->{$pseudo} = $profil ;

            $membres = json_encode($membres);

            //enregistrement dans le fichier JSON de la nouvelle liste de membres
            file_put_contents('../admin/membres.json', $membres);
            
            //on identifie direct la personne
            session_start();
            $_SESSION['pseudo'] = $_POST['pseudo'] ;
            $_SESSION['statut'] = "user" ;
        
            //redirection vers l'accueil
            header('Location:../login.php') ;
            http_response_code(200);
            exit ;
        exit ;
        }
        

    } elseif($_POST['authentifie'] == "login") {
        //on check l'existance de la personne et la validite du mdp
        $membres = file_get_contents('../admin/membres.json') ;
        $membres = json_decode($membres);

        if(!isset($membres->{$pseudo}) || $mdpcuisine != $membres->{$pseudo}->{'hash'} ) {
            echo "Il y a une erreur dans le pseudo et/ou le mot de passe" ;
        } else {
            session_start();
            $_SESSION['pseudo'] = $_POST['pseudo'] ;

            $_SESSION['statut'] = $membres->{$pseudo}->{'statut'} ;
        
            //redirection vers l'accueil
            header('Location:../login.php') ;
            http_response_code(200);
            exit ;
        }
    } else {
        echo "Une erreur est survenue : impossible de définir la procédure tentée" ;
    }
} else {
    echo "Une erreur est survenue lors de l'envoi du formulaire de connexion" ;
}
?>