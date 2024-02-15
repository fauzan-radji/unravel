<?php

namespace Controller;

use function Core\view;

class WelcomeController extends Controller
{
  public static function index()
  {

    return view('welcome');
  }
}
