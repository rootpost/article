<?php
require "INewsDB.class.php";
class NewsDB implements INewsDB
{
  const DB_NAME = "../news.db";
  const ERR_PROPERTY = "Wrong property name";
  private $_db;
  function __construct()
  {
    $this->_db = new SQLite3(self::DB_NAME);
    if(!filesize(self::DB_NAME))
    {
      try
      {
        $sql = "CREATE TABLE article(
                  id INTEGER PRIMARY KEY AUTOINCREMENT,
                  title TEXT,
                  category INTEGER,
                  description TEXT,
                  source TEXT,
                  datetime INTEGER,
                  tagname INTEGER)";
        if(!$this->_db->exec($sql))
          throw new Exception("Ошибка создания таблицы article");
        
        $sql = "CREATE TABLE category(
                  id INTEGER PRIMARY KEY AUTOINCREMENT,
                  name TEXT)";
        if(!$this->_db->exec($sql))
          throw new Exception("Ошибка создания таблицы category");
        
        $sql = "INSERT INTO category(id, name)
                  SELECT 1 as id, 'Политика' as name
                  UNION SELECT 2 as id, 'Спорт' as name
                  UNION SELECT 3 as id, 'Культура' as name
                  UNION SELECT 4 as id, 'Наука' as name";
        if(!$this->_db->exec($sql))
          throw new Exception("Ошибка наполнения таблицы category");
      }
      catch(Exception $e)
      {
        die($e->getMessage());
      }
    }
  }
  function _destruct()
  {
    unset($this->_db);
  }
  function __get($name)
  {
    if($name == "db")
      return $this->_db;
    throw new Exception(self::ERR_PROPERTY);
  }
  function __set($name, $value)
  {
    throw new Exception(self::ERR_PROPERTY);
  }
/*============================================*/
  function saveNews($title, $category, $description, $source, $tagname)
  {
    $dt = time();
    $sql = "INSERT INTO article(title, category, description, source, datetime, tagname)
            VALUES('$title', $category, '$description', '$source', $dt, $tagname)";
    return $this->_db->exec($sql);
  }
/*============================================*/  
  function db2Arr($data)
  {
    $arr = [];
    while($row = $data->fetchArray(SQLITE3_ASSOC))
      $arr[] = $row;
    return $arr;
  }
/*============================================*/  
  function getNews()
  {
    $sql = "SELECT article.id as id, title, 
                  category.name as category, description, 
                  source, datetime, tagname 
            FROM article, category 
            WHERE category.id = article.category 
            ORDER BY article.id DESC";
    $items = $this->_db->query($sql);
    if(!$items)
      return false;
    return $this->db2Arr($items);
  }
/*============================================*/  
  function deleteNews($id)
  {
    $sql = "DELETE FROM article WHERE id=$id";
    return $this->_db->exec($sql);
  }
/*============================================*/  
  function escape($data)
  {
    return $this->_db->escapeString(trim(strip_tags($data)));
  }
  
}
?>