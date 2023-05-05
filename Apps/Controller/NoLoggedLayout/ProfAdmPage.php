<?php 

require_once __DIR__ . "/../../Utils/View.php";

class ProfAdmPage extends NoLoggedLayout{
  static function getPagina(){

    return parent::getPage(View::render("ProfAdmPage"), 'Professores', $title);
  }
}
