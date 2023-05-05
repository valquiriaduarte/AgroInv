<?php
  require_once __DIR__ . "/../../Utils/View.php";
  require_once __DIR__ . "/../../Entities/Usuario.php";

  class TeachersAdms extends NoLoggedLayout{
    
    public static function getProf(){
      $profs = Usuario::get("*", "tipoUsuario = 1");
      $item = "";

      foreach($profs as $prof){
        $item .= "<li><img href='/Resources/_img/no-logged-img.svg'><div>" . $prof -> getNome() . "<br>" . $prof -> getEmail() . "<br>" . $prof -> getTelefone() . "</div></li>";
      }

      return $item;
    }
    
    public static function getAdm(){
      $adms = Usuario::get("*", "tipoUsuario = 2");
      $item = "";

      foreach($adms as $adm){
        $item .= "<li><div class='img-prf'></div><div>" . $adm -> getNome() . "<br>" . $adm -> getEmail() . "<br>" . $adm -> getTelefone() . "</div></li>";
      }

      return $item;
    }
    
    public static function get(){
      return parent::getPage(View::render("TeachersAdms", [
        "professores" => self::getProf(),
        "administradores" => self::getAdm(),
      ]), 'Professores e Administradores', 'Professores');
    }
  }