<?php 
  
require_once __DIR__ . "/../../Utils/View.php";
require_once __DIR__ . "/../../Utils/Validate.php";
require_once __DIR__ . "/../../Entities/Usuario.php";

class LoginPage extends AccountLayout{
  # Verifica se o login é válido
  static function verifyLogin($request){
    if($request != ""){
      $email = $request->getPostVars()['email'];
      $senha = $request->getPostVars()['senha'];
      if(!$senha or !$email) return '<p class="error">Email e/ou senha faltando!</p>';
      else{
        $usuarios = Usuario::get();
        foreach($usuarios as $usuario){
          if(($usuario->getSenha() == $senha) and ($usuario->getEmail() == $email)) return '';
        }
        return '<p class="error">Usuário não encontrado</p>';
      }
    }
    return $error;
  }
  static function get($request = ''){

    # Set de veriáveis para a view
    $vars = [
      "error-message" => "",
    ];
    $page = 'LoginPage';
    $title = 'Login';

    if($request != ''){
      # Definindo os tipos de request
      if($request->getHttpMethod() == "POST"){ # Caso o método do request seja POST
  
        # Verifica se o email e senha está no login
        $error = self::verifyLogin($request);
  
        # Se tiver mensagem de erro, o usuário não foi logado corretamente
        # Então mostra a tela de login com uma mensagem de erro;
        if($error != "") $vars["error-message"] = $error;
  
        # Se o usuario estiver logado vai iniciar uma sessão
        else return "<p>Logado</p>";
      }
    }
      
    return parent::getPage(View::render($page, $vars), $title);
  }
}