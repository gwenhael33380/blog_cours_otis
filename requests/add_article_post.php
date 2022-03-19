<?php 
require dirname(__DIR__) . '/functions.php';
require_once PATH_PROJECT . '/connect.php';

if(in_array('', $_POST)) :
	$msg_error = 'Merci de remplir le titre et le contenu de l\'article';
	header('Location:' . HOME_URL . 'views/add_article.php?msg=' . $msg_error);
else :
	$title = trim($_POST['title']);
	$text = trim($_POST['text']);

	$req = $db->prepare("
		INSERT INTO articles(id_user, title, content, created_at)
		VALUES (:id_user, :title, :content, NOW())
	");

	// https://www.php.net/manual/fr/function.intval.php
	$req->bindValue(':id_user', intval($_SESSION['id_user']), PDO::PARAM_INT); // integer
	$req->bindValue(':title', $title, PDO::PARAM_STR); // string
	$req->bindValue(':content', $text, PDO::PARAM_STR); // string

	// $result va stocker le résultat de ma requete INSERT INTO
	// si TRUE l'insertion s'est bien déroulé
	// si FALSE une erreur s'est produite
	$result = $req->execute();

	if($result) {
		header('Location:' . HOME_URL . '?msg=<div class="green">Article ajouté</div>');
	}
	else {
		header('Location:' . HOME_URL . 'views/add_article.php?msg=<div class="red">Erreur, merci de renouveler votre article</div>&title=' . $title . '&content=' . $text);
	}

endif;

