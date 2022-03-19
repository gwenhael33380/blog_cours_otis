<?php
require __DIR__ . '/header.php';
require_once PATH_PROJECT . '/connect.php';
enabled_access(array('administrator', 'editor'));
$id_article = intval($_GET['id']); // si le $_GET n'est pas numerique, il ne pourra pas le transformer en integer

if($id_article) {
	$req = $db->prepare("
		SELECT id, title, content
		FROM articles
		WHERE id = :id
	");

	$req->bindValue(':id', $id_article, PDO::PARAM_INT);
	$req->execute();

	$article = $req->fetch(PDO::FETCH_OBJ);
}

?>

<h1 class="title">Formulaire de mise à jour d'un article</h1>

<div class="file_form">
	<form action="<?php echo HOME_URL . 'requests/update_article_post.php'; ?>" method="POST">
		<div>
			<label for="title">Titre</label>
			<input type="text" id="title" name="title" value="<?php echo sanitize_html($article->title); ?>">
		</div>
		<div>
			<label for="text">Contenu de l'article</label>
			<textarea id="text" name="text" rows="10"><?php echo sanitize_html($article->content); ?></textarea>
		</div>
		<input type="hidden" name="id_article" value="<?php echo $article->id; ?>">
		<button type="submit">Valider</button>
	</form>
</div>

<?php
require __DIR__ . '/footer.php';
