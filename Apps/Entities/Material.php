<?php

require_once __DIR__ . '/../Bd/Database.php';
require_once __DIR__ . '/Categoria.php';

class Material{
  private $codMaterial = '';
  private $nome = '';
  private $quantidade = '';
  private $categoria = '';

  public function __construct($nome = '',
                              $quantidade = '',
                              $categoria = ''){
    $this -> setNome($nome);
    $this -> setQuantidade($quantidade);
    $this -> setCategoria($categoria);
  }

  public function setNome($nome){
    if(!empty($nome)){
      $nomes = self::get('nome');
      foreach($nomes as $n){
        if($n->getNome() == $nome){
          $this -> nome = $nome;
          return true;
        }
      }
      return false;
    } else return false;
  }
  public function setQuantidade($quantidade){
    if(!empty($quantidade) and is_numeric($quantidade)){
      $this -> quantidade = $quantidade;
      return true;
    } else return false;
  }
  public function setCategoria($categoria){
    if(!empty($categoria) and is_numeric($categoria)){
      $categorias = Categoria::get();
      foreach($categorias as $c){
        if($c->getCodCategoria() == $categoria){
          $this -> categoria = $c;
          return true;
        }
      }
      return false;
    } else return false;
  }
  
  public function getCategoria(){ return $this -> categoria; }
  public function getQuantidade(){ return $this -> quantidade; }
  public function getNome(){ return $this -> nome; }
  public function getCodMaterial(){ return $this -> codMaterial; }

  public static function get($fields = "*", 
                             $where = NULL, 
                             $order = NULL, 
                             $limit = NULL){
    $materiais = (new Database("Material")) 
      -> select($fields, $where, $order, $limit) 
      -> fetchAll(PDO::FETCH_CLASS, self::class);
    return array_map(function($material){
      $material->setCategoria($material->getCategoria());
      return $material;
    }, $materiais);
  }
  static function update($id, $values){
	    $bd = new Database('Material');
	    $bd->update('codMaterial=' . $id, $values);
  }
  public static function delete($id){ 
    $bd = new Database('Material');
    $bd->delete('codMaterial=' . $id);
  }
  public function insert(){
			$bd = new Database('Material');
	    $this->codMaterial = $bd->insert([
	                'nome' => $this->nome,
	                'quantidade' => $this->quantidade,
	                'categoria' => $this->categoria->getCodCategoria()
	    ]);
	    return true;
		}
} 