<?php

class View{
  private static $vars = [];
  static function init($vars = []){
    self::$vars = $vars;
  }
  public static function getVars(){ return self::$vars; }
  private static function getViewContent($view){
    $path = __DIR__ . "/../../Views";
    $dirs = array_diff(scandir($path), ["..", "."]);
    foreach($dirs as $index => $dir) if(!is_dir("$path/$dir")) unset($dirs[$index]);
    foreach($dirs as $dir){
        if(file_exists("$path/$dir/$view.html")) return file_get_contents("$path/$dir/$view.html");
    }
  }
  public static function render($view, $vars = []){
    $content = self::getViewContent($view);
    $vars = array_merge(self::$vars, $vars);
    $keys = array_map(function($chave){
      return "{{" . $chave . "}}";
    }, array_keys($vars));
    $content = str_replace($keys, array_values($vars), $content);
    return $content;
  }
}