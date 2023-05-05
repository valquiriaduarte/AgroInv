<?php

function validaString($str): int{
  $erro = 0;
  $erro = (preg_match('~[0-9\.,!@#$%¨&*()_=+{}<>:/?:;|]+~', $str)) ? 1 : 0;
  return $erro;
  /* 
    erro 1: possuem caracteres especiais ou números
  */
}

function validaEspecial($str): int{
  $erro = 0;
  $erro = (preg_match('~[\.,!@#$%¨&*()_=+{}<>:/?:;|]+~', $str)) ? 1 : 0;
  return $erro;
}

/*
function validaNumerico($num): int{
  is_numeric($string);
}
*/

function validaMinuscula($str): int{}
function validaMaiuscula($str): int{}
function validatePassword($senha, $maiusculas = true, $minusculas = true, $algarismos = true, $especiais = true){
  $maiusculas = !$maiusculas;
  $minusculas = !$minusculas;
  $algarismos = !$algarismos;
  $especiais = !$especiais;
  if(preg_match('/\d/', $senha)) $algarismos = true;
  if(preg_match('/[A-Z]/', $senha)) $maiusculas = true;
  if(preg_match('/[a-z]/', $senha)) $minusculas = true;
  if(preg_match('/(([!-\/])|([:-@])|([\[-`])|([{-~])|([´]))/', $senha)) $especiais = true;
  if(strlen($senha) < 8 or strlen($senha) > 14) return false;
  else if(!$maiusculas or !$minusculas or !$especiais or !$algarismos) return false;
  else return true;
}

function validatePhoneNumber($telefone){
  return preg_match("/^(\+\d{1,3})?[ ]?(([(]\d{1,2}[)])|(\d{1,2}))?[ ]?[9]{1}\d{4}[ -]?\d{4}$/", $telefone);
}

function get($key){
  return htmlentities(stripslashes($_GET[$key]));
}
function validateDate($date){
  if(preg_match('/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/', $date)) return true;
  else return false;
}
function validateTime($time){
  if(preg_match('/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/', $time)) return true;
  else return false;
}

# Valida o tamanho de uma string, pode ser passado só o limite, ou o início e o fim
function validateLength($str, ...$limit){
  switch(count($limit)){
    case 1:
      return strlen($str) <= $limit[0] ? true : false;
    break;
    case 2: 
      return strlen($str) >= $limit[0] and strlen($str) <= $limit[1] ? true : false;
    break;
  }
}