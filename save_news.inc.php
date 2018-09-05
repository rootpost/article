<?php
  $title = $news->escape($_POST["title"]);
  $category = abs((int)$_POST["category"]);
  $description = $news->escape($_POST["description"]);
  $source = $news->escape($_POST["source"]);
  $tagname = abs((int)$_POST["tagname"]);
  
  if(empty($title) or empty($description))
  {
    $errMsg = "Заполните главные поля формы!";
  }
  else
  {
    if(!$news->saveNews($title, $category, $description, $source, $tagname))
    {
      $errMsg = "Произошла ошибка при добавлении статьи";
    }
    else
    {
      header("Location: news.php");
      exit;
    }
  }

    




?>
