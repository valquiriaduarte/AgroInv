<?php

class Database{
  private $table;
  private $pathDb;
  private $connection; # instância de PDO
  public function __construct($table){
    # Instancia a tabela qual vai ser usada naquela conexão com o Banco de Dados e inicia a conexão
    $this->table = $table;
    $this->pathDb = getenv('DBPATH');
    $this->setConnection();
  }
  # Cria uma conexão com o banco de dados pelo PDO, vai ficar no atributo Connection
  private function setConnection(){
    try{
      // echo __DIR__ . ' -> sqlite:../' . getenv('DBPATH'); 
      $this->connection = new PDO('sqlite:' . $this->pathDb);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOExceptions $e){
      die('ERROR: ' . $e->getMessage());
    }
  }
  # Executa um comando
  public function execute($query, $params = []){
    try{
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;
    } catch(PDOExceptions $e){
      die('ERROR: ' . $e->getMessage());
    }
  }
  # Insere algum valor no banco de dados
  public function insert($data = []){

    # Monta a query
    $fields = array_keys($data);
    $binds = array_pad([], count($fields), '?');
    $query = 'insert into ' . $this->table . '(' . implode(',', $fields) . ') values ('. implode(',', $binds) . ')';

    // echo '<pre>'; var_dump($query); echo '</pre>';
    

    # Executa a query de insert de acordo com os valores passados
    $this->execute($query, array_values($data));
    

    # Retorna o id (PK) do valor inserido
    return $this->connection->lastInsertId();
  }
  # Faz um select no banco de dados
  public function select($fields = "*", $where = NULL, $order = NULL, $limit = NULL){

    # Dados da query
    $where = strlen($where) ? ' where ' . $where: '';
    $order = strlen($order) ? ' order by ' . $order : '';
    $limit = strlen($limit) ? ' limit ' . $limit : '';
    
    # Monta a query
    $query = 'select ' . $fields . ' from ' . $this->table . $where . $order . $limit;
    
    // echo '<pre>'; var_dump($query); echo '</pre>';
    
    return $this->execute($query);
  }
  
  # Exclui um dado da tabela pelo $id
  public function delete($where){

    # Monta a query
    $query = 'delete from ' . $this->table . ' where ' . $where;
    
    // echo '<pre>'; var_dump($query); echo '</pre>';
    
    return $this->execute($query);
  }
  
  # Utiliza o objeto para alterar algum registro
  public function update($where, $values){
    $fields = array_keys($values);
    
    # Monta a query
    $query = 'update ' . $this->table . 
      ' set ' . implode('=?,', $fields) . '=? where ' . $where;

    // echo '<pre>'; var_dump($query); echo '</pre>';
    
    $this->execute($query, array_values($values));
    return true;
  }
}