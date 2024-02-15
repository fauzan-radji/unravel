<?php

require_once 'routes.php';

function parsePath($path)
{
  return '/' . trim($path, '/');
}

function getController($path)
{
  foreach (ROUTES as $route => [$controller, $method]) {
    $regex = '#^' . preg_replace('/\{\w+\}/', '([\w\s]+)', $route) . '$#i';
    if (!preg_match($regex, $path, $matches)) continue;

    $regex = str_replace('([\w\s]+)', '\{(\w+)\}', $regex);
    preg_match($regex, $route, $keys);

    array_shift($matches);
    array_shift($keys);

    return [
      'controller' => $controller,
      'method' => $method,
      'params' => array_combine($keys, $matches)
    ];
  }

  return null;
}
