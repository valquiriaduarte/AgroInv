<?php
require_once __DIR__ . "/../../Utils/View.php";

class AddItemPage{
  public static function get(){
    return parent::getPage(View::render('AddItem', [
    ]), 'Adicionar Item', 'Gerenciar Item');
  }
}