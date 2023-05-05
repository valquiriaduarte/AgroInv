<?php

require_once __DIR__ . '/../Utils/Validate.php';
require_once __DIR__ . '/../Bd/Database.php';
require_once __DIR__ . '/Curso.php';

//     constraint curso_fk_turma foreign key(curso) references Curso(codCurso)
// );

class Turma{
  private $codTurma = '';
  private $ano = '';
  private $nome = '';
  private $quantidadeAlunos = '';
  private $curso = '';
  
  public function __construct($ano = '', 
                              $nome = '', 
                              $quantidadeAlunos = '',
                              $curso = ''){    
    $this->setAno($ano);
    $this->setNome($nome);
    $this->setQuantidadeAlunos($quantidadeAlunos);
    $this->setCurso($curso);
  }
  
  public function setAno($ano){
    if(!empty($ano) and is_numeric($ano)){
      $this->ano = $ano;
      return true;
    } else return false;
  }
  public function setNome($nome){
    if(!empty($nome) and validateLength($nome, 5, 10)){
      $this->nome = $nome;
      return true;
    } else return false;
  }
  public function setQuantidadeAlunos($quantidadeAlunos){
    if(!empty($quantidadeAlunos) and is_numeric($quantidadeAlunos)){
      $this->quantidadeAlunos = $quantidadeAlunos;
      return true;
    } else return false;
  }
  public function setCurso($course){
    if(!empty($course)){
      $courses = Curso::get();
      foreach($courses as $c){
        if($course == $c->getCodCurso()){
          $this->curso = $c;
          return true;
        }
      }
      
      return false;
    } else return false;
  }
  public function getAno(){ return $this -> ano; }
  public function getNome(){ return $this -> nome; }
  public function getQuantidadeAlunos(){ return $this -> quantidadeAlunos; }
  public function getCurso(){ return $this -> curso; }
  public function getCodTurma(){ return $this->codTurma; }
  
  public function insert(){
    # Inicia a conexão com o Banco de Dados
		$bd = new Database('Turma');
    
    # Faz o insert e retorna a PK do Banco de Dados
    $this->codTurma = $bd->insert([
                'nome' => $this->nome,
                'ano' => $this->ano,
                'quantidadeAlunos' => $this->quantidadeAlunos,
                'curso' => $this->curso->getCodCurso()
    ]);

    return true;
}
  public static function get($fields = '*', $where = NULL, $order = NULL, $limit = NULL){
		$classes = (new Database('Turma'))->select($fields, $where, $order, $limit)
                                    ->fetchAll(PDO::FETCH_CLASS, self::class);
    # curso = PK então PK -> objeto Curso
    return array_map(function($class){
      $class->setCurso($class->getCurso());
      return $class;
    }, $classes);
	}
  public static function delete($id){ 
    $bd = new Database('Turma');
    $bd->delete('codTurma=' . $id);
  }
  static function update($id, $values){
	    $bd = new Database('Turma');
	    $bd->update('codTurma=' . $id, $values);
	  }
}

