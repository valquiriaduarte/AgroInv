<?php

require_once __DIR__ . "/../Apps/Entities/Categoria.php";
require_once __DIR__ . '/../Apps/Utils/Environment.php';
Environment::load();

$category = new Categoria('Enlatados');
Categoria::delete(5);
$category->insert();
Categoria::update(5, [
              'nome' => 'Samnis'
]);

echo '<pre>'; var_dump($category); echo '</pre>';

$categorys = Categoria::get();

echo '<pre>'; var_dump($categorys); echo '</pre>';


