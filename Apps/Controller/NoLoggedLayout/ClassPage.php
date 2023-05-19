<?php

require_once __DIR__ . "/../../Utils/View.php";
require_once __DIR__ . "/../../Entities/Aula.php";

class ClassPage extends NoLoggedLayout{
  
  static function getLessons(){

    $today = date("Y\-m\-d", strtotime("now -3 hours"));
    $lessons = Aula::get('dataAula = 07/02/2023');
    $lines = '';

    foreach($lessons as $lesson){

      
      $lines .= '<tr><td>'
      . 'Nome' . '</td><td>'
      . $lesson->getLaboratorio()->getSigla() . '</td><td>'
      . $lesson->getTurma()->getNome() . '</td><td>'
      . $lesson->getProfessor()->getNome() . '</td><td>'
      . $lesson->getHorario() . '</td><td>'
      . $lesson->getDataAula() .'</td></tr>';
    }

    return $lines;
  }
  
  static function get(){

    $title = 'Aulas';
    $args = [
      'lessons' => self::getLessons()
    ];
    
    return parent::getPage(
      View::render("ClassPage", $args), 
      $title, 
      'Lista de aulas');
  }
}