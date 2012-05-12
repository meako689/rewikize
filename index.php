<!Doctype html>
<?php
require_once('goWiki.class.php');

$info = new goWiki();
$res = $info->getResults('книга');
?>
<html>
<body>

<div>
<?php echo $res['text'] ?>
</div>

<div>
<?php foreach ($res['images'] as $image):?>

<img src="<?= $image ?>" />

<?php endforeach?>
</div>

<body>
</html>