<?php

session_start();

//si la personne est identifiée
if(isset($_SESSION['pseudo']) && isset($_SESSION['statut'])) {
    $pseudo = $_SESSION['pseudo'] ;
    $statut = $_SESSION['statut'] ;
} else {
    $pseudo = null ;
    $statut = "visiteur" ;
}