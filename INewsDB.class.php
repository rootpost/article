<?php
interface INewsDB
{
  function saveNews($title, $category, $description, $source, $tagname);
  
  function getNews();
  
  function deleteNews($id);
}



?>