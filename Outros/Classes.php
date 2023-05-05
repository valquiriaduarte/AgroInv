<?php

/* Observações

- As funções ->insert() e ->querry() são para, respectivamente, inserir e selecionar aquele objeto no Banco de Dados 
- Professor e Administradores viram tipoUsuario na classe Usuario
- Categoria vira uma função que retorna o array para validar os atributo categoria do material
*/

/* Observações II

  - E se a gente separar as classes em arquivos diferentes? Aí dá pra cada um fazer uma e usar esse arquivos pra "controle de versões".
  
*/
class Aula{
	private $horario;
	private $laboratorio;
	private $turma;
	private $quantAlunos;
	private $dataAula;
    private $materialUtilizado; # Array(material, quantidade) 
	public function __constuct(){}
	public function getHorario(){}
    public function setHorario(){}
	public function getLaboratorio(){}
    public function setLaboratorio(){}
	public function getTurma(){}
    public function setTurma(){}
	public function getQuantAlunos(){}
    public function setQuantAlunos(){}
	public function getDataAula(){}
    public function setDataAula(){}
    public function adicionarMaterial()
    public function excluirMaterial()
    public function insert(){}
    public function querry(){}
}
class Material{
	private $nome;
	private $quantidade;
	private $categoria;
	public function __constuct(){}
	public function getNome(){}
    public function setNome(){}
	public function getQuantidade(){}
    public function setQuantidade(){}
	public function getCategoria(){}
    public function setCategoria(){}
    public function insert(){}
    public function querry(){}
}
class Alimento extends Material{
	private $unidade;
	public function __constuct(){}
	public function getUnidade(){}
    public function setUnidade(){}
    public function insert(){}
    public function querry(){}
}
