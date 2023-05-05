<?php

require_once __DIR__ . '/../Utils/Validate.php';
require_once __DIR__ . '/../Bd/Database.php';
require_once __DIR__ . '/Laboratorio.php';
require_once __DIR__ . '/Turma.php';
require_once __DIR__ . '/Usuario.php';

class Aula{
  private $codAula;
  private $titulo = ''; 
  private $horario = ''; // Time
  private $laboratorio = '';
  private $turma = ''; //fk
  private $professor = ''; //fk
  private $quantAlunos = '';
  private $dataAula = ''; //date

  public function __construct($titulo = '',
                             $horario = '', 
                             $laboratorio = '',
                             $turma = '',
                             $professor = '',
                             $quantAlunos = '',
                             $dataAula = ''){
    $this->setTitulo($titulo);
    $this->setHorario($horario);
    $this->setLaboratorio($laboratorio);
    $this->setTurma($turma);
    $this->setProfessor($professor);
    $this->setQuantAlunos($quantAlunos);
    $this->setDataAula($dataAula);
  }

  public function setTitulo($titulo){
    if(!empty($titulo) and validateLength($titulo, 100)){
      $this->titulo = $titulo;
      return true;
    } else return false;
  }
  public function setHorario($horario){
    if(!empty($horario) and validateTime($horario)){
      $this->horario = $horario;
      return true;
    } else return false;
  }
  public function setLaboratorio($laboratorio){
    if($laboratorio !== '' and is_numeric($laboratorio)){
      $laboratorios = Laboratorio::get();
      foreach($laboratorios as $l){
        if($l->getCodLaboratorio() == $laboratorio){
          $this->laboratorio = $l;
          return true;
        }
      }
      return false;
    } else return false;
  }
  public function setTurma($turma){
    if($turma !== '' and is_numeric($turma)){
      $turmas = Turma::get();
      foreach($turmas as $t){
        if($t->getCodTurma() == $turma){
          $this->turma = $t;
          return true;
        }
      }
      return false;
    } else return false;
    
  }
  public function setQuantAlunos($quantAlunos){
    if(!empty($quantAlunos) and is_numeric($quantAlunos)){
      $this->quantAlunos = $quantAlunos;
      return true;
    } else return false;
  }
  public function setProfessor($professor){
    if($professor !== '' and is_numeric($professor)){
      $professores = Usuario::get('*', 'tipoUsuario = 1');
      foreach($professores as $p){
        if($p->getCodUsuario() == $professor){
          $this->professor = $p;
          return true;
        }
      }
      return false;
    } else return false;
  }
  public function setDataAula($dataAula){
    if(!empty($dataAula) and validateDate($dataAula)){
      $this->dataAula = $dataAula;
      return true;
    } else return false;
  }
  public function setMateriaisAula($materiaisAula){
  }
  
  public function getTitulo() { return $this -> titulo; } 
  public function getQuantAlunos() { return $this -> quantAlunos; } 
  public function getLaboratorio() { return $this -> laboratorio; }
  public function getDataAula() { return $this -> dataAula; }
  public function getProfessor() { return $this -> professor; }
  public function getHorario() { return $this -> hora; }
  public function getTurma() { return $this -> turma; }
  
  
  public static function get($where = NULL, $order = NULL,
                             $limit = NULL, $fields = '*'){
    $aulas = (new Database('Aula'))->select($fields, $where, $order, $limit)
														->fetchAll(PDO::FETCH_CLASS, self::class);    
    return array_map(function($aula){
        $aula->setLaboratorio($aula->getLaboratorio());
        $aula->setProfessor($aula->getProfessor());
        $aula->setTurma($aula->getTurma());
        return $aula;
      }, $aulas);
  }
  public static function delete($id){ 
    $bd = new Database('Aula');
    $bd->delete('codAula=' . $id);
  }
  public static function update($id, $values){
    $bd = new Database('Aula');
    $bd->update('codAula=' . $id, $values);    
  }
  public function insert(){

	    # Inicia a conexão com o Banco de Dados
			$bd = new Database('Aula');
	    
	    # Faz o insert e retorna a PK do Banco de Dados
	    $this->codAula = $bd->insert([
	                'horario' => $this->horario,
	                'laboratorio' => $this->laboratorio->getCodLaboratorio(),
	                'turma' => $this->turma->getCodTurma(),
	                'professor' => $this->professor->getCodUsuario(),
	                'quantAlunos' => $this->quantAlunos,
	                'dataAula' => $this->dataAula
	    ]);
	
	    return true;
  }
}