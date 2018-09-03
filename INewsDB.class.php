<?php
interface INewsDB
{
  function saveNews($title, $category, $description, $source);
  
  function getNews();
  
  function deleteNews($id);
}



?>