<div class="container-fluid text-justify bg-white text-dark text-center pt-4">
<h2><?= $post->title ?></h2>
<?= 
$post->body
?>

<time datetime="<?= $post->created?>" class="article-date"><?= $post->created->setTimezone('America/Argentina/Buenos_Aires')->format('d/m/Y H:m')?></time>
</div>