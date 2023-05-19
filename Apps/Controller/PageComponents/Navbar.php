<?php

require_once __DIR__ . "/../../Utils/View.php";

class Navbar{
  public static function get($tabs = [], $active, $status = 'NoLogged'){

    $nav = '';

    # Monta as tabs de navegação
    foreach($tabs as $tab => $content){

      $countNav = 0;
      
      # Se for um menu dropdown
      if(is_array($content)){

        $countNav++;
        
        $nav .=  '<li id="nav-dropdown' . $countNav . '"><span>' . $tab  . '</span><ul';
        $nav .=  ($tab == $active) ? ' class="nav-active"' : '';
        $nav .=  '>';

        foreach($content as $name => $link){
          $nav .= '<li><a href="' . $link . '">' . $name . '</a></li>';
        } 

        $nav .= '</ul></li>';

      # Se for uma aba de menu normal
      } else{
        
        $nav .= '<li';
        $nav .= $tab == $active ? ' class="nav-active"' : '';
        $nav .= '><a href="' . $content . '">' . $tab . '</a></li>';
      }
    }

    # Define o icone dependendendo do status do usuario
    switch($status){
      
      case 'NoLogged':
        $icon = '<a href="' . View::getVars()['login-url'] . '"><p>Entrar</p><img src="./Resources/_img/join.png"></a>';
      break;
      
      case 'Logged':
        // $icon = '<a href="/usuario/' . 'nome' . '"><p>Sair</p><img src="./Resources/_img/leave.png"></a>';
        $icon .= '<a href="' . View::getVars()['logout-url'] . '"><p>Sair</p><img src="./Resources/_img/leave.png"></a>';
      break;
      
      exit;
    }

    return View::render('Navbar', [
      'tabs' => $nav,
      'icon' => $icon
    ]);
    
  }
  public static function getStatic(){
    return View::render('NavbarStatic');
  }
}

// <a href="{{login-url}}"><p>Entrar</p><img src="./Resources/_img/join.png"></a>