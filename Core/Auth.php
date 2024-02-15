<?php

namespace Core;

use Model\User;

class Auth
{
  public static function login($username, $password)
  {
    $tableName = User::get_table_name();
    $result = Database::query("SELECT * FROM $tableName WHERE username = '$username'");
    $user = Database::fetch($result)[0];

    if (Database::num_rows($result) < 1) {
      return [
        'msg' => 'Username salah',
        'user' => null
      ];
    }

    if (!password_verify($password, $user['password'])) {
      return [
        'msg' => 'Password salah',
        'user' => null
      ];
    }

    return [
      'msg' => 'Login sukses',
      'user' => $user
    ];
  }

  public static function logout()
  {
    Session::unset();
  }

  public static function user()
  {
    if (!Session::has('id')) return null;
    $id = Session::get('id');
    return User::find($id);
  }

  public static function is($level)
  {
    return static::user() && static::user()['level'] === $level;
  }
}
