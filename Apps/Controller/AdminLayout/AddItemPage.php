<?php
require_once __DIR__ . "/../../Utils/View.php";
require_once __DIR__ . "./AdminLayout.php";

class AddItemPage extends AdminLayout{
  public static function get(){
    return parent::getPage(View::render('AddItem', [
    ]), 'Adicionar Item', 'Gerenciar Item');
  }
}