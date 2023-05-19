<?php

class Environment{
  public static function load($dir = ''){

    $os = PHP_OS;
    $path_patern = $os == 'Linux'? '/../../' :'\..\..\\';
    # Defina a pasta do arquivo
    $file = __DIR__ . $path_patern . $dir . '.environment';

    # Coloca as linhas em um array
    $lines = file($file);
    # Coloca cada linha como uma variável de ambiente
    foreach($lines as $line){
      putenv(trim($line));
    }
  }
}