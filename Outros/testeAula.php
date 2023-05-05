<?php

require_once __DIR__ . "/../Apps/Entities/Aula.php";
require_once __DIR__ . '/../Apps/Utils/Environment.php';
Environment::load();

$class = new Aula('20:34', 1, 1, 1, 30, '13/08/2004');
Aula::delete(4);
$class->insert();
Aula::update(4, [
  'dataAula' => '14/08/2004'
]);

echo '<pre>'; var_dump($class); echo '</pre>';
// echo '<pre>'; var_dump(Aula::get()); echo '</pre>';

