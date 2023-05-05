<?php

require_once __DIR__.'/../Utils/Validate.php';
require_once __DIR__.'/../Bd/Database.php';

class Curso{
  private $codCurso;
  private $nome;
  private $sigla;
  public function __construct($nome = '', 
                              $sigla = ''){
    $this->setNome($nome);
    $this->setSigla($sigla);
  }
  public function setNome($nome){
    if(!empty($nome)){
      if(validateLength($nome, 20)){
        $this->nome = $nome;
        return true;
      } else return false;
    } else return false;
  }
  public function setSigla($sigla){
    if(!empty($sigla)){
      if(validateLength($sigla, 2, 3)){
        $this->sigla = $sigla;
        return true;
      } else return false;
    } else return false;
  }
  
  public function getSigla(){ return $this -> sigla; }
  public function getNome(){ return $this->nome; }
  public function getCodCurso(){ return $this->codCurso; }
  
  public function insert(){
		$bd = new Database('Curso');
    
    $this->codCurso = $bd->insert([
                'nome' => $this->nome,
                'sigla' => $this->sigla,
    ]);

    return true;
}
  public static function get($fields = '*', $where = NULL, 
                             $order = NULL, $limit = NULL){
		return (new Database('Curso'))->select($fields, $where, $order, $limit)
                                    ->fetchAll(PDO::FETCH_CLASS, self::class); 
	}
  public static function delete($id){ 
    $bd = new Database('Curso');
    $bd->delete('codCurso=' . $id);
  }
  static function update($id, $values){
    $bd = new Database('Curso');
    $bd->update('codCurso=' . $id, $values);
  }
}
