<?php

namespace Model;

use Core\Database;

abstract class Model
{
  protected static $table;

  public static function all()
  {
    $result = Database::query("SELECT * FROM " . static::$table);
    return Database::fetch($result);
  }

  public static function find($id, $column = 'id')
  {
    $result = Database::query("SELECT * FROM " . static::$table . " WHERE $column = $id");
    return Database::fetch($result)[0];
  }

  public static function insert($values)
  {
    return Database::query("INSERT INTO " . static::$table . " VALUES (" . implode(',', $values) . ")");
  }

  public static function update($id, $values, $column = 'id')
  {
    $columns = [];
    foreach ($values as $key => $value) $columns[] = "$key = $value";
    $query = "UPDATE " . static::$table . " SET " . implode(', ', $columns) . " WHERE $column = $id";

    return Database::query($query);
  }

  public static function delete($id, $column = 'id')
  {
    return Database::query("DELETE FROM " . static::$table . " WHERE $column = $id");
  }

  public static function count()
  {
    $result = Database::query('SELECT COUNT(*) AS row_count FROM ' . static::$table);
    return Database::fetch($result)[0]['row_count'];
  }

  public static function get_table_name()
  {
    return static::$table;
  }
}
