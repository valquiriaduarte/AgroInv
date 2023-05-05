<?php

require_once __DIR__ . "/../../Utils/View.php";
require_once __DIR__ . "/../../Entities/Usuario.php";
require_once __DIR__ . "/../../Bd/Database.php";

class UserPage{

  # Retorna o usuário requisitado ou nulo se ele não existir
  private static function getUserName($name){
    return urldecode($name);
  }
  public static function getUser($name){
    $userName = self::getUserName($name);
    $users = Usuario::get();
    
    foreach($users as $u){
      if($u->getNomeURI() == $userName) return $u;
    }
    return false;
  }

  # Esse método é para colocar os tipos de usuario no formulário de cadastro
  public static function getTypeUsers(){
    $types = TipoUsuario::get();
    $lines = '';    
      
    # Construindo as linhas
    foreach($types as $type){
      if($types[0] == $type) $lines .= '<option selected value="' . $type->getCodTipoUsuario() . '">' . $type->getNome() . '</option>';
      else $lines .= '<option value="' . $type->getCodTipoUsuario() . '">' . $type->getNome() . '</option>';
    }

    return $lines;
  }

  public static function insert($request, $name){
    echo '<pre>'; print_r($request); echo '</pre>';
  }
  
  public static function get($request, $name){

    # Usuário requisitado
    $user = self::getUser($name) ?? '';

    if(empty($user)){
      throw new Exception("Usuário não encontrado", 204);
      return '';
    }
    else{
      # Variáveis da View
      $vars = [
        'navbar' => View::render('Navbar'),
        'footer' => View::render('Footer'),
        'name' => $user->getNome(),
        'email' => $user->getEmail(),
        'password' => $user->getSenha(),
        'register' => $user->getMatricula(),
        'phone' => $user->getTelefone(),
        'typeUser' => self::getTypeUsers()
      ];
      
      return View::render("UserPage", $vars);
    }
  }
}