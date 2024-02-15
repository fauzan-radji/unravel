<?php

namespace Core;

class Database
{
  private static $host = '';
  private static $user = '';
  private static $pass = '';
  private static $name = '';
  private static $connection = null;

  public static function init()
  {
    self::$host = env('DB_HOST');
    self::$user = env('DB_USER');
    self::$pass = env('DB_PASS');
    self::$name = env('DB_NAME');

    try {
      self::$connection = mysqli_connect(self::$host, self::$user, self::$pass, self::$name);
    } catch (\Exception $e) {
      self::$connection = null;
    }
  }

  public static function query($query)
  {
    return mysqli_query(self::$connection, $query);
  }

  public static function fetch($mysqli_result)
  {
    $data = [];
    while ($datum = mysqli_fetch_assoc($mysqli_result)) {
      $data[] = $datum;
    }

    return $data;
  }

  public static function num_rows($result)
  {
    return mysqli_num_rows($result);
  }
}
