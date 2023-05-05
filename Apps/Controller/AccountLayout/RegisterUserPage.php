<?php
require_once __DIR__ . '/../../Utils/View.php';
require_once __DIR__ . '/../../Entities/TipoUsuario.php';

class RegisterUserPage extends AccountLayout{

  public static function verifyUserInvalid($user){
    
    // Verifica se tem algum campo inválido
    if(empty($user->getNome()) 
      or    empty($user->getEmail()) 
      or    empty($user->getSenha()) 
      or    empty($user->getTipoUsuario())) 
      return true;
    else return false;
  }

  public static function verifyUserExists($user){
    $users = Usuario::get();
    foreach($users as $u){
      if($u->getNome() == $user->getNome() 
        or $u->getEmail() == $user->getEmail())
        return true;
    }
    return false;
  }

  # Registra o usuário ou retorna um erro
  public static function registerUser($request){

    # Criando o usuário
    $user = new Usuario();
    $user->setNome($request->getPostVars()['name']);
    $user->setEmail($request->getPostVars()['email']);
    $user->setSenha($request->getPostVars()['password']);
    $user->setTipoUsuario($request->getPostVars()['typeUser']);

    # Verifica se o usuário tem todos os campos válidos
    if(self::verifyUserInvalid($user)) 
      return '<p class="error">Algum campo está inválido!</p>';
    else{
      # Verifica se o usuário já existe
      if(self::verifyUserExists($user))
        return '<p class="error">O usuário já existe</p>';
      else{
        $user->insert();
        return false;
      }
    }
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

   # Controla o que cada dado inserido vai fazer
  public static function insert($request){
    $error = '';
  
    # Se o post for o cadastro de um usuário
    $registerError = self::registerUser($request);
    if($registerError != false) $error = '<p class="error">' . $registerError . '</p>';
    
    return self::get(['register-error' => $error]);
    }
  
  public static function get($vars = ['register-error' => '']){

    $vars = array_merge($vars, [
      'navbar' => View::render('NavbarStatic'),
      'footer' => View::render('Footer'),
      'type-user' => self::getTypeUsers()
    ]);
    $title = 'Cadastro';
    
    return parent::getPage(View::render('RegisterUserPage', $vars), $title);
  }
}
