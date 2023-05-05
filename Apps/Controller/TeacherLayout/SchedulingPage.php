<?php

require_once __DIR__ . "/../../Utils/View.php";
require_once __DIR__ . "/../../Entities/Usuario.php";
require_once __DIR__ . "/../../Entities/Laboratorio.php";
require_once __DIR__ . "/../../Entities/Material.php";

class SchedulingPage{
  public static function getTeacherOptions(){
    $lines = '';
    $teachers = Usuario::get('*', 'tipoUsuario = 1');

    foreach($teachers as $teacher){
      $lines .= '<option value="' . $teacher->getCodUsuario() . '">' 
                  . $teacher->getNome() 
                . '</option>';
    }
            
    return $lines;
  }
  public static function getLabOptions(){
    $lines = '';
    $labs = Laboratorio::get();

    foreach($labs as $lab){
      $lines .= '<option value="' . $lab->getCodLaboratorio() . '">' 
                  . $lab->getSigla() 
                . '</option>';
    }
            
    return $lines;
  }
  
  public static function getMaterialOptions(){
    $lines = '';
    $mats = Material::get();

    foreach($mats as $mat){
      $lines .= '<option value="' . $mat->getCodMaterial() . '">' . $mat->getNome() . '</option>';
    }
            
    return $lines;
  }
  
  public static function get(){
    return View::render('SchedulingPage', [
                        "navbar" => View::render("Navbar"),
                        "footer" => View::render("Footer"),
                        'teacher-options' => self::getTeacherOptions(),
                        'lab-options' => self::getLabOptions(),
                        'mat-options' => self::getMaterialOptions()
    ]);
  }
}