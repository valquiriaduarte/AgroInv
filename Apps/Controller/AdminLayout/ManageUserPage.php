<?php

require_once __DIR__ . "/../../Utils/View.php";
require_once __DIR__ . "/../../Entities/Usuario.php";
require_once __DIR__ . "/../../Entities/TipoUsuario.php";
require_once __DIR__ . "/../../Bd/Database.php";

class ManageUserPage extends AdminLayout{
  public static function getUsers(){
    
    # Pega os usuários
    $users = Usuario::get("*", 'deletado = false');
    
    # Monta as linhas da tabela baseadas nos usuarios
    $lines = '';
    foreach($users as $user){
      $lines .= View::render('ShowUserForm', [
        'name' => $user->getNome(),
        'email' => $user->getEmail(), 
        'phone-number' => $user->getTelefone(), 
        'user-type' => $user->getTipoUsuario()->getNome(), 
        'user-edit-uri' => '/usuario/' . $user->getNomeURI(), 
        'user-pk' => $user->getCodUsuario()
      ]);
    }
    
    return $lines;
  }
  
  public static function deleteUser($request){
    Usuario::hideUser($request->getPostVars()['delete']);
  }
  
  public static function get($request = ''){

    # Se tiver uma requisição para deletar
    if(isset($request->getPostVars()['delete'])) self::deleteUser($request);
    
    # Inicia as variáveis para a view
    $vars = [
      'navbar' => View::render("Navbar"),
      'footer' => View::render("Footer"),
      'users' => self::getUsers()
    ];

    return parent::getPage(View::render('ManageUserPage', $vars), 'Usuarios', 'Gerenciar usuarios');
  }
}