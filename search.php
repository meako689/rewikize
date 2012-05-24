<!Doctype html>
<?php
require_once('goWiki.class.php');

if (isset($_GET['search_field'])){
  $query = $_GET['search_field'];
  $info = new goWiki();
  $res = $info->getArticles($query);
}else{
  $query = '';
}
?>
<html>

<head>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/style.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<script type="text/javascript" charset="utf-8" src="js/jquery-1.7.2.min.js">
</script>

<title>Re:wikize</title>
</head>
<body>


<div class="mid-holder">
<?php if($query !=='' ):?>
<div class="header">
   <a href="/" class="logo"></a>
    <form action="" method="GET">  
      <input id="id_search_field" name="search_field" /> 
      <button type="submit"></button>
    </form>
</div>
  <div class="article-content">
    <h1>
      <?php echo $query ?>
    </h1>
    <?php if (!empty($res['1'])):?>
      <form action="view.php" method="GET">
        <?php foreach($res['1'] as $articles):?>
        <input type="radio" name="search_field" value="<?php echo $articles?>"><?php echo $articles ?></input></br>
        <?php endforeach; ?>
        <button type="submit" value="Показати">Показати</button>
      </form>
    <?php else:?>
       <p>Нічого не знайдено.</p>
    <?php endif;?>
  </div>
<?php else:?>
    <div class="search-content">
        <a href="/" class="logo-large"><img src="img/logo-large.png"/></a>
        <form action="" method="GET">  
            <input id="id_search_field" name="search_field" /> 
            <button type="submit"></button>
        </form>
    </div>
<?php endif;?>


<div class="footer-container">
    <div id="footer-text">
        © 2012 ТЕМ-51. Плотніков, Коведа, Микитин, Гринда;
    </div>
</div>

</div>
<script type="text/javascript" charset="utf-8" src="js/deco.js"></script>
</body>
