<!Doctype html>
<?php
require_once('goWiki.class.php');
$query = 'Львів';
$info = new goWiki();
$res = $info->getResults($query);
?>
<html>

<head>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/style.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<script type="text/javascript" charset="utf-8" src="js/jquery-1.7.2.min.js">
</script>
</head>
<body>

<div class="left-holder"></div>
<div class="right-holder"></div>

<div class="mid-holder">
    
<div class="header">
   <a href="/" class="logo"></a>
</div>
<div class="article-content">
<h1>
<?php echo $query ?>
</h1>
<?php echo $res['text'] ?>
</div>
</div>
<div>


<script type="text/javascript" charset="utf-8">
    var images =<?php echo json_encode($res['images']); ?>
</script>

<script type="text/javascript" charset="utf-8" src="js/rewikize-styler.js"></script>
</div>

