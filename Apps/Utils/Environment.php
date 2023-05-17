<?php

class Environment{
  public static function load($dir = ''){

    # Defina a pasta do arquivo
    $file = __DIR__ . '\..\..\\' . $dir . '.environment';

    # Coloca as linhas em um array
    $lines = file($file);
    
    # Coloca cada linha como uma variável de ambiente
    foreach($lines as $line){
      putenv(trim($line));
    }
  }
}