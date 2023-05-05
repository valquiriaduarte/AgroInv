<?php

require_once __DIR__ . '/../../Utils/View.php';
require_once __DIR__ . '/../PageComponents/Navbar.php';

class NoLoggedLayout{
  public static function getPage($content, $title, $tab = ''){

    $args = [
      'navbar' => Navbar::get([
        'Home' => '/',
        'Verificar Aulas' => [
          'Lista de aulas' => '/aulas',
          'Calendário' => '/calendario'
        ],
        'Professores' => '/professores-administradores'
      ], $tab, 'NoLogged'),
      'title' => $title,
      'content' => $content,
      'footer' => View::render('Footer')
    ];
    
    return View::render('MainLayout', $args);
  }
}