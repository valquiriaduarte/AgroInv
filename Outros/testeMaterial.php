<?php

require_once __DIR__ . "/../Apps/Entities/Material.php";
require_once __DIR__ . '/../Apps/Utils/Environment.php';
Environment::load();

$material = new Material('Carne de Boi', 30, 4);
Material::delete(5);
$material->insert();
Material::update(5, [
              'nome' => 'Samnis',
              'categoria' => 2
]);

echo '<pre>'; var_dump($material); echo '</pre>';

$materials = Material::get();

echo '<pre>'; var_dump($materials); echo '</pre>';


