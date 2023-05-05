<?php

class Request{
  private $httpMethod;
  private $uri;
  private $headers = [];
  private $queryParams = [];
  private $postVars = [];
  function __construct(){
    $this->queryParams = $_GET ?? [];
    $this->postVars = $_POST ?? [];
    $this->headers = getallheaders();
    $this->httpMethod = $_SERVER["REQUEST_METHOD"];
    $this->uri = $_SERVER["REQUEST_URI"];
  }
  function getHttpMethod(){
    return $this->httpMethod;
  }
  function getUri(){
    return $this->uri;
  }
  function getHeaders(){
    return $this->headers;
  }
  function getQueryParams(){
    return $this->httpMethod;
  }
  function getPostVars(){
    return $this->postVars;
  }
}