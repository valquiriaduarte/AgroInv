<?php

require_once __DIR__.'/../Utils/Validate.php';
require_once __DIR__."/../Bd/Database.php";

class Laboratorio{
  private $codLaboratorio;
  private $sigla = '';
  public function __construct($sigla = ''){
    $this->setSigla($sigla);
  }
  
  public function setSigla($sigla){
    if(!empty($sigla) and validateLength($sigla, 10)){
      $this->sigla = $sigla;
      return true;
    } else return false;
  }
  
  public function getSigla(){ return $this->sigla; }
  public function getCodLaboratorio(){ return $this->codLaboratorio; }
  
  public function insert(){
    $bd = new Database('Laboratorio');
    
    $this->codLaboratorio = $bd->insert([
                'sigla' => $this->sigla,
    ]);
  
    return true;
  }
  public static function get($where = NULL, $order = NULL,
                             $limit = NULL, $fields = '*'){
    return (new Database('Laboratorio'))->select($fields, $where, $order, $limit)
                          ->fetchAll(PDO::FETCH_CLASS, self::class);
  }
  public static function delete($id){ 
    $bd = new Database('Laboratorio');
    $bd->delete('codLaboratorio=' . $id);
  }
  static function update($id, $values){
    $bd = new Database('Laboratorio');
    $bd->update('codLaboratorio=' . $id, $values);
  }
}