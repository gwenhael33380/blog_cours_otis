<?php
session_start(); // obligatoire pour utiliser les sessions

// var_dump($_SERVER);
// on définit une constante de cette façon
// define('NOM_DE_LA_CONSTANTE_EN_MAJUSCULE', 'VALEUR_DE_LA_CONSTANTE');
define('HOME_URL', 'http://blog/'); // à chaque migration, cet élément sura surement à changer
define('PATH_PROJECT', __DIR__);

// function pour rediriger vers la homePage si $enable_access existe et n'est pas nul
function enabled_access(Array $enabled_access) {
	// if($_SERVER['REQUEST_URI'] != '/') : // je verifie que je ne suis pas dans la page home sinon boucle infinie
		if(
			!isset($_SESSION['id_user'])  // si je ne suis pas connecté
			|| // OR
			(
				isset($enable_access)
				&& // ET
				isset($_SESSION['id_user'])
				&&
				// si le rôle n'est pas dans le tableau
				!in_array($_SESSION['role_slug'], $enable_access)
			)
		) :
			header('Location: ' . HOME_URL);
		endif;
	// endif;
}


// pour éliminer la faille XSS
function sanitize_html($string) {
	// https://www.php.net/manual/fr/function.htmlspecialchars.php
	return htmlspecialchars(trim($string));
}
