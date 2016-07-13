<?php
namespace Main\Service;

abstract class ItemsService
{
  public static function getNameById($id)
  {
    foreach(static::$items as $item) {
      if($item['id'] == $id) {
        return $item;
      }
    }
    return false;
  }

  public static function getIdByName($name)
  {
    foreach(static::$items as $item) {
      if(strtolower($item['name']) == strtolower($name)) {
        return $value;
      }
    }
    return false;
  }

  public static function getItems()
  {
    return static::$items;
  }
}
