<!Doctype html>
<html>

<head>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <script type="text/javascript" charset="utf-8" src="js/jquery-1.7.2.min.js"></script>
</head>
<body>
  <div class="left-holder"></div>
  <div class="right-holder"></div>

  <div class="mid-holder">
    <div class="search-content">
        <a href="/" class="logo-large"><img src="img/logo-large.png"/></a>
        <form action="search.php" method="GET">  
            <input id="id_search_field" name="search_field" /> 
            <button type="submit"></button>
        </form>
    </div>
  </div>
  <div>
    <script type="text/javascript" charset="utf-8">
        var images =<?php echo json_encode($res['images']); ?>
    </script>

    <script type="text/javascript" charset="utf-8" src="js/rewikize-styler.js"></script>
  </div>
</body>
</html>
