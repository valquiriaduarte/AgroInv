<?php

require_once __DIR__ . '/../Bd/Database.php';
require_once __DIR__ . '/../Utils/Validate.php';

class Categoria{
  private $codCategoria = '';
  private $nome = '';
  
  public function __construct($nome = ''){
    $this->setNome($nome);
  }

  public function setNome($nome){
    if(!empty($nome) and validateLength($nome, 50)){
      $this->nome = $nome;
      return true;
    } else return false;
  }
  
  public function getNome(){ return $this->nome; }
  public function getCodCategoria(){ return $this->codCategoria; }

  public static function get($where = NULL, $order = NULL,
                             $limit = NULL, $fields = '*'){
    return (new Database('Categoria'))->select($fields, $where, $order, $limit)
                          ->fetchAll(PDO::FETCH_CLASS, self::class);
  }
  public static function delete($id){ 
    $bd = new Database('Categoria');
    $bd->delete('codCategoria=' . $id);
  }
  static function update($id, $values){
    $bd = new Database('Categoria');
    $bd->update('codCategoria=' . $id, $values);
  }
  public function insert(){
    $bd = new Database('Categoria');
    $this->codCategoria = $bd->insert([
                'nome' => $this->nome
    ]);
    return true;
  }
}

// create table Categoria(
//     nome varchar(50) unique not null
// );