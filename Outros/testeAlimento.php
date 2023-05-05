<?php

require_once __DIR__ . "/../Apps/Entities/Alimento.php";
require_once __DIR__ . '/../Apps/Utils/Environment.php';
Environment::load();

$food = new Alimento(1, 'kg', '13/08/2004', '13/10/2004');
Alimento::delete(5);
$food->insert();
Alimento::update(5, [
              'material' => '2',
              'unidade' => 'L'
]);

echo '<pre>'; var_dump($food); echo '</pre>';

echo '<pre>'; var_dump(Alimento::get()); echo '</pre>';


