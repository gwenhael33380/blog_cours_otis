<?php
require __DIR__ . '/header.php';
// les roles qui ont accès à la page
// les autres seront redirigés vers la page HOME
enabled_access(array('administrator', 'editor'));

$title = isset($_GET['title']) ? $_GET['title'] : FALSE;
$content = isset($_GET['content']) ? $_GET['content'] : FALSE;
?>

<h1 class="title">Formulaire d'ajout d'un article</h1>

<div class="file_form">
	<form action="<?php echo HOME_URL . 'requests/add_article_post.php'; ?>" method="POST">
		<div>
			<label for="title">Titre</label>
			<input type="text" id="title" name="title" value="<?php if($title) echo $title; ?>">
		</div>
		<div>
			<label for="text">Contenu de l'article</label>
			<textarea id="text" name="text" rows="10"><?php if($content) echo $content; ?></textarea>
		</div>
		<button type="submit">Valider</button>
	</form>
</div>

<?php
require __DIR__ . '/footer.php';
