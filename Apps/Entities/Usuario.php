<?php

require_once __DIR__."/../Utils/Validate.php";
require_once __DIR__."/../Utils/Padronize.php";
require_once __DIR__."/../Bd/Database.php";
require_once __DIR__."/TipoUsuario.php";

class Usuario{
  private $codUsuario = '';
  private $nome = '';
	private $email = '';
	private $senha = '';
	private $matricula = '';
	private $telefone = '';
	private $deletado = '';
  private $tipoUsuario = '';
	public function __construct($nome = "", $email = "", $senha = "", $matricula = "", $telefone = "", $tipoUsuario = ""){
		$this->setNome($nome);
		$this->setEmail($email);
		$this->setSenha($senha);
		$this->setMatricula($matricula);
		$this->setTelefone($telefone);
		$this->setTipoUsuario($tipoUsuario);
	}
  public function setNome($nome){
    if(!empty($nome) and validateLength($nome, 100)){
      $this->nome = $nome;
      return true;
    } else return false;
	}
  public function setEmail($email){
    if(!empty($email) and filter_var($email, FILTER_VALIDATE_EMAIL)){
      $this->email = $email;
      return true;
    } else return false;
  }
  public function setSenha($senha){
    $this->senha = password_hash($senha,PASSWORD_DEFAULT);
    return true;
    // if(!empty($senha) and validatePassword($senha)){
    //   $this->senha = $senha;
    //   return true;
    // } else return false;
  }
  public function setMatricula($matricula){
    if(!empty($matricula)){
      // Tem que fazer a validação
      $this->matricula = $matricula;
      return true;
    } else return false;
  }
  public function setTelefone($telefone){
    if(!empty($telefone) and validatePhoneNumber($telefone)){
      $telefone = padronizePhoneNumber($telefone);
      $this->telefone = $telefone;
      return true;
    } else return false;
	}
  public function setTipoUsuario($type){
    if(!empty($type)){
      $types = TipoUsuario::get();
      foreach($types as $t){
        if($type == $t->getCodTipoUsuario()){
          $this->tipoUsuario = $t;
          return true;
        }
      }
      return false;
    } else return false;
	}
  
  public function getSenha(){ return $this->senha; }
	public function getMatricula(){ return $this->matricula; }
	public function getEmail(){ return $this->email; }
	public function getTelefone(){ return $this->telefone; }
	public function getTipoUsuario(){ return $this->tipoUsuario; }
	public function getDeletado(){ return $this->deletado; }
	public function getNome(){ return $this->nome; }
  public function getNomeURI(){ return urldecode(str_replace(' ', '', $this->nome)); }
  public function getCodUsuario(){ return $this->codUsuario; }
  
  public function insert(){
    # Inicia a conexão com o Banco de Dados
		$bd = new Database('Usuario');
    
    # Faz o insert e retorna a PK do Banco de Dados
    $this->codUsuario = $bd->insert([
                'nome' => $this->nome,
                'email' => $this->email,
                'senha' => $this->senha,
                'matricula' => $this->matricula,
                'telefone' => $this->telefone,
                'tipoUsuario' => $this->tipoUsuario->getCodTipoUsuario()
    ]);

    return true;
	}
  static function update($id, $values){
	    $bd = new Database('Usuario');
	    $bd->update('codUsuario=' . $id, $values);
	  }
  # Faz um select no banco de dados
  public static function get($fields = '*',
                             $where = NULL, 
                             $order = NULL, 
                             $limit = NULL){

    // Lista de usuários
		$users = (new Database('Usuario'))
      ->select($fields, $where, $order, $limit)
      ->fetchAll(PDO::FETCH_CLASS, self::class);

    // Os tipoUsuario retornam a PK
    // Então precisa transformar ele em objeto TipoUsuario
    return array_map(function($user){
      $user->setTipoUsuario($user->getTipoUsuario());
      return $user;
    }, $users);
	}
  public static function delete($id){ 
    $bd = new Database('Usuario');
    $bd->delete('codUsuario=' . $id);
  }
  public static function hideUser($id){
	  $bd = new Database('Usuario');
    $bd->update('codUsuario=' . $id, [
      'deletado' => 'true'
    ]);
  }
}