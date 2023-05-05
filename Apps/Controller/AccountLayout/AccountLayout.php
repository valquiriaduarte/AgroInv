<?php

require_once __DIR__ . '/../../Utils/View.php';
require_once __DIR__ . '/../PageComponents/Navbar.php';

class AccountLayout{
  public static function getPage($content, $title){

    $args = [
      'navbar' => Navbar::getStatic(),
      'title' => $title,
      'content' => $content,
      'footer' => View::render('Footer')
    ];
    
    return View::render('StaticLayout', $args);
  }
}