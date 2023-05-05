<?php

require_once __DIR__ . "/../Apps/Entities/Laboratorio.php";
require_once __DIR__ . "/../Apps/Utils/Environment.php";
Environment::load('/');

$lab = new Laboratorio('Lab01');
Laboratorio::delete(4);
$lab->insert();
Laboratorio::update(4, [
  'sigla' => 'Lab02'
]);

echo '<pre>'; var_dump($lab); echo '</pre>';
echo '<pre>'; var_dump(Laboratorio::get()); echo '</pre>';
 