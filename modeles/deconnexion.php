<?php 
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

//redirection vers l'accueil
header('Location:../index.php') ;
http_response_code(200);
exit ;