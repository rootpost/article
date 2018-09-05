<?php

$id = abs((int)$_GET["del"]);
if($id)
{
  if(!$news->deleteNews($id))
  {
    $errMsg = "Произошла ошибка при удалении";
  }
  else
  {
    header("Location: news.php");
    exit;
  }
}


?>