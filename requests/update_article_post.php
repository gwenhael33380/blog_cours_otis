<?php 
require dirname(__DIR__) . '/functions.php';
require_once PATH_PROJECT . '/connect.php';

$title = trim($_POST['title']);
$text = trim($_POST['text']);
// https://www.php.net/manual/fr/function.intval.php
$id = intval($_POST['id_article']);

if(in_array('', $_POST)) :
	$msg_error = 'Merci de remplir le titre et le contenu de l\'article';
	header('Location:' . HOME_URL . 'views/update_article.php?id=' . $id . '&msg=' . $msg_error);
else :

	$req = $db->prepare("
		UPDATE articles SET title = :title, content = :content
		WHERE id = :id -- condition pour ne mettre à jour que l'id de l'article, pas les autres
	");
	// var_dump($db->errorInfo());
	
	$req->bindValue(':title', $title, PDO::PARAM_STR); // string
	$req->bindValue(':content', $text, PDO::PARAM_STR); // string
	$req->bindValue(':id', $id, PDO::PARAM_INT); // integer

	// $result va stocker le résultat de ma requete UPDATE
	// si TRUE l'insertion s'est bien déroulé
	// si FALSE une erreur s'est produite
	$result = $req->execute();

	if($result) {
		header('Location:' . HOME_URL . '?msg=<div class="green">Article mis à jour</div>');
	}
	else {
		header('Location:' . HOME_URL . 'views/update_article.php?id=' . $id . '&msg=<div class="red">Erreur, merci de renouveler votre mise à jour</div>');
	}

endif;
