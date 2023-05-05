<?php

require_once __DIR__."/../Bd/Database.php";

class TipoUsuario{
  private $codTipoUsuario = ''; 
  private $nome = '';
  
  public function __construct($nome = ''){
    $this->setNome($nome);
  }
  
  public function setNome($nome){
    if(!empty($nome)){
      if(strlen($nome) > 20) return false;
      else $this->nome = $nome;
    } else return false;
  }
  
  public function getNome(){ return $this->nome; }
  public function getCodTipoUsuario(){ return $this->codTipoUsuario; }
  
  public function insert(){
    # Inicia a conexão com o Banco de Dados
    $bd = new Database('TipoUsuario');
    
    # Faz o insert e retorna a PK do Banco de Dados
    $this->codTipoUsuario = $bd->insert([
                'nome' => $this->nome
    ]);

    return true;
  }
  # Faz um select no banco de dados
  public static function get($fields = '*', $where = NULL, 
                             $order = NULL, $limit = NULL){
    return (new Database('TipoUsuario'))->select($fields, $where, $order, $limit)
                          ->fetchAll(PDO::FETCH_CLASS, self::class);
  }
  public static function delete($id){ 
    $bd = new Database('TipoUsuario');
    $bd->delete('codTipoUsuario=' . $id);
  }
  static function update($id, $values){
	    $bd = new Database('TipoUsuario');
	    $bd->update('codTipoUsuario=' . $id, $values);
	  }
}