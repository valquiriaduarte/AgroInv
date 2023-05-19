<?php

require_once __DIR__ . "/Request.php";

class Router{
  private $url;
  private $prefix;
  private $routes = [];
  private $request;
  function __construct($url){
    $this->url = $url;
    $this->request = new Request();
    $this->setPrefix();
  }
  # Define o prefixo das rotas
  private function setPrefix(){
    $this->prefix = parse_url($this->url)["path"] ?? "";
    
  }
  
  # Adiciona uma rota à lista de rotas.
  # Array [ Regex rota [ Método http [ Parâmetros (Controllers, Variáveis) ] ] ]
  private function addRoute($method, $route, $params = []){

    
    # Coloca a key "controller" no método get do controller dentro da rota
    foreach($params as $key => $value){
      if($value instanceof Closure){
        $params["controller"] = $value;
        unset($params[$key]);
      }
      
    }

    # Definição de variáveis que acompanharão a rota
    $params['variables'] = [];
    

    # Definição de variáveis dentro da URI que acompanharão a rota
    $patternVariables = '/{(.*?)}/';
    
    # Verifica na URI se tem uma variável 
    # Se tiver ela vai entrar dentro de $params['variables'] com seu respectivo valor
    if(preg_match_all($patternVariables, $route, $matches)){
      $route = preg_replace($patternVariables, '(.*?)', $route);
      $params['variables'] = $matches[1];
     
    }

    # Monta o regex da rota
    $routePattern = "/^" . str_replace("/", "\/", $route) . "$/";
    
    # Adiciona a lista de rotas
    $this->routes[$routePattern][$method] = $params;
  
  }
  # 4 métodos Http vão chamar o addRoute()
  function get($route, $params = []){
    return $this->addRoute("GET", $route, $params);
  }
  function post($route, $params = []){
    return $this->addRoute("POST", $route, $params);
  }
  function put($route, $params = []){
    return $this->addRoute("PUT", $route, $params);
  }
  function delete($route, $params = []){
    return $this->addRoute("DELETE", $route, $params);
  }
  # Pega a URI do request (ou seja, a URI atual)
  private function getUri(){
    $uri = $this->request->getUri();
    $uri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
    return end($uri);  
  }
  # Retorna uma rota se ela existir
  function getRoute(){
    $uri = $this->getUri();
    $httpMethod = $this->request->getHttpMethod();

    # Verifica todas as rotas 
    foreach($this->routes as $patternRoute => $methods){ 
      # Se a URI bater com o regex e se existir aquele método
      if(preg_match($patternRoute, $uri, $matches)){
//          echo $uri;
        
        if($methods[$httpMethod]){
          
          # Tira a posição 0 do $match (que vai ter a URI completa)
          unset($matches[0]);
          
          # Pega as variáveis presentes na URI e insere na rota
          $methods[$httpMethod]['variables'] = array_combine($methods[$httpMethod]['variables'], $matches);
          
          # Adiciona uma variável na rota contendo o request
          $methods[$httpMethod]['variables']['request'] = $this->request;
          
          # Retorna aquela rota daquele método
          return $methods[$httpMethod];
        }
        throw new Exception("O método requisitado não é permitido", 405);
      }
    }
    throw new Exception("URL não encontrada!", 404);
  }
  function run(){

    # Tenta conseguir uma rota, se ela não existir, gera uma exceção
    try{
      $route = $this->getRoute();
      if(!isset($route['controller'])){
        throw new Exception("A URL não pode ser processada", 500);
      }
      
      # Pega os parâmetros passados no controller e transforma em variáveis da rota
      $args = [];
      $reflection = new ReflectionFunction($route['controller']);
      foreach($reflection->getParameters() as $parameter){
        $name = $parameter->getName();
        $args[$name] = $route['variables'][$name] ?? "";
      }
      
      # Retorna a execução dessa função para o documento que chamar ela
      return call_user_func_array($route['controller'], $args);
    } catch(Exception $e){
      return new Response($e->getCode(), $e->getMessage());
    }
  }
}