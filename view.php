<!Doctype html>
<?php
require_once('goWiki.class.php');

if (isset($_GET['search_field'])){
  $query = $_GET['search_field'];
  $info = new goWiki();
  $res = $info->getResults($query, 'query');
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

<title>Re:wikize - <?php echo $query ?></title>

</head>
<body>

<div class="left-holder"></div>
<div class="right-holder"></div>

<div class="mid-holder">
<div class="header">
   <a href="/" class="logo"></a>
        <form action="search.php" method="GET">  
            <input id="id_search_field" name="search_field" /> 
            <button type="submit"></button>
        </form>
</div>
  <div class="article-content">
    <h1>
      <?php echo $query ?>
    </h1>
    <?php echo $res['text'] ?>



  </div>



<div class="footer-container">
    <div id="footer-text">
        © 2012 ТЕМ-51. Плотніков, Коведа, Микитин, Гринда;
    </div>
</div>

</div>
<script type="text/javascript" charset="utf-8">
    var images =<?php echo json_encode($res['images']); ?>;
    var videos =<?php echo json_encode($res['videos']); ?>;
</script>

<script type="text/javascript" charset="utf-8" src="js/rewikize-styler.js"></script>
<script type="text/javascript" charset="utf-8" src="js/deco.js"></script>

</body>
