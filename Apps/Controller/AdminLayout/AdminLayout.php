<?php

require_once __DIR__ . '/../../Utils/View.php';
require_once __DIR__ . '/../PageComponents/Navbar.php';

class AdminLayout{
  public static function getPage($content, $title, $tab){

    $args = [
      'navbar' => Navbar::get([
        'Estoque' => [
          'Itens' => '/admin/gerenciar-itens',
          'Adicionar item' => '/admin/adicionar-item'
        ],
        'Gerenciar usuarios' => [
          'Usuarios' => '/admin/usuarios',
          'Adicionar usuário' => '/admin/adicionar-usuario'
        ],
        'Gerenciar aulas' => [
          'Aulas' => '/admin/aulas',
          'Calendário' => '/admin/calendario'
        ],
        'Estatísticas' => '/admin/estatistica'
      ], $tab, 'Logged'),
      'title' => $title,
      'content' => $content,
      'footer' => View::render('Footer')
    ];
    
    return View::render('MainLayout', $args);
  }
}