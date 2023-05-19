<?php

require_once __DIR__ . "/../../Utils/View.php";

class HomePage extends NoLoggedLayout{
  static function get(){

    $title = 'Página Inicial';
    
    return parent::getPage(
      View::render("HomePage"),
      $title,
      'Home');
  }
}