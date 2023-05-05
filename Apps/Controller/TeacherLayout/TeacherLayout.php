<?php

require_once __DIR__ . '/../../Utils/View.php';

class TeacherLayout{
  public static function getPage($content, $title){

    $args = [
      'navbar' => View::render('NavbarTeacher'),
      'title' => $title,
      'content' => $content,
      'footer' => View::render('Footer')
    ];
    
    return View::render('TeacherLayout', $args);
  }
}