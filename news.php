<?php
require "NewsDB.class.php";
$news = new NewsDB();
$errMsg = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
  require "save_news.inc.php";
if(isset($_GET["del"]))
  require "delete_news.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Новостная лента</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
  <h2>Просмотр и добавление статей</h2>
  <?php
    if($errMsg)
      echo "<h3 style='color:red;'>$errMsg</h3>";
  ?>
  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    Заголовок статьи:<br />
    <input type="text" name="title" size="40" /><br />
    Категория статьи:<br />
    <select name="category">
      <option value="1">Политика</option>
      <option value="2">Культура</option>
      <option value="3">Спорт</option>
      <option value="4">Наука</option>
    </select>
    <br />
    Текст статьи:<br />
    <textarea name="description" cols="58" rows="8"></textarea><br />
    Источник:<br />
    <input type="text" name="source" size="40" /><br />
    Теги:<br />
    <input type="text" name="tagname" size="40" /><br /><br />
    <input type="submit" value="Добавить" /><br />
    
  </form>
  <?php
    require "get_news.inc.php";
  ?>
</body>
</html>