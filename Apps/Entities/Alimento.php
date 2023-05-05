<?php

require_once __DIR__ . '/../Bd/Database.php';
require_once __DIR__ . '/Material.php';

class Alimento{
  private $codAlimento = '';
  private $material = '';
  private $unidade = '';
  private $dataLote = '';
  private $dataValidade = '';

  public function __construct($material = '',
                              $unidade = '',
                              $dataLote = '',
                              $dataValidade = ''){
    $this->setMaterial($material);
    $this->setUnidade($unidade);
    $this->setDataLote($dataLote);
    $this->setDataValidade($dataValidade);
  }
  
  public function setMaterial($material){
    if(!empty($material) and is_numeric($material)){
      $materiais = Material::get();
      foreach($materiais as $m){
        if($m->getCodMaterial() == $material){
          $this->material = $m;
          return true;
        }
      }
      return false;
    } else return false;
  }
  public function setUnidade($unidade){
    if(!empty($unidade) and validateLength($unidade, 10)){
      $this->unidade = $unidade;
      return true;
    } else return false;
  }
  public function setDataLote($dataLote){
    if(!empty($dataLote) and validateDate($dataLote)){
      $this->dataLote = $dataLote;
      return true;
    } else return false;
  }
  public function setDataValidade($dataValidade){
    if(!empty($dataValidade) and validateDate($dataValidade)){
      $this->dataValidade = $dataValidade;
      return true;
    } else return false;
  }

  public function getCodAlimento(){ return $this->codAlimento; }
  public function getMaterial(){ return $this->material; }
  public function getUnidade(){ return $this->unidade; }
  public function getDataLote(){ return $this->dataLote; }
  public function getDataValidade(){ return $this->dataValidade; }

  public static function get($where = NULL, $order = NULL,
															 $limit = NULL, $fields = '*'){
    $alimentos = (new Database('Alimento'))
      ->select($fields, $where, $order, $limit)
      ->fetchAll(PDO::FETCH_CLASS, self::class);
    return array_map(function($alimento){
      $alimento->setMaterial($alimento->getMaterial());
      return $alimento;
    }, $alimentos);
  }
  public static function delete($id){ 
    $bd = new Database('Alimento');
    $bd->delete('codAlimento=' . $id);
  }
  static function update($id, $values){
    $bd = new Database('Alimento');
    $bd->update('codAlimento=' . $id, $values);
  }
  public function insert(){
    $bd = new Database('Alimento');
    $this->codAlimento = $bd->insert([
                'material' => $this->material->getCodMaterial(),
                'unidade' => $this->unidade,
                'dataLote' => $this->dataLote,
                'dataValidade' => $this->dataValidade
    ]);
    return true;
  }
}