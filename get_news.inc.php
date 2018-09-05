<?php
$items = $news->getNews();
if($items === false):
  $errMsg = "Произошла ошибка при выводе статей";
elseif(!count($items)):
  $errMsg = "Cтатей нет";
else:
  foreach($items as $item):
    $dt = date("d.m.Y H:i:s", $item["datetime"]);
    $desc = nl2br($item["description"]);
    echo <<<ITEM
    <div>
    <h3>{$item['title']}</h3>
    <p style='color:brown;'>$dt / {$item['category']}</p>
    <p>
      $desc
    </p>
    
    <a href='{$item['source']}'><span>{$item['source']}</span></a>
    <br>
    <p align='right'>
      <a href='news.php?del={$item['id']}'>Удалить</a>
    </p>
    </div>
ITEM;
  endforeach;
endif;
?>
