<?php
namespace Main\Helper;

class LastAssignManagerHelper
{
  static private $file = "private/resource/last_manager_assign.txt";
  static public function get()
  {
    return file_get_contents(static::$file);
  }

  static public function set($value)
  {
    return file_put_contents(static::$file, $value);
  }
}
