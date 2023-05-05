<?php 

require_once __DIR__ . "/../Apps/Entities/Curso.php";
require_once __DIR__ . '/../Apps/Utils/Environment.php';
Environment::load();

$course = new Curso('Administração', 'ADM');
Curso::delete(5);
$course->insert();
Curso::update(5, [
              'sigla' => 'AD'
]);

// echo '<pre>'; var_dump($course); echo '</pre>';

$courses = Curso::get();

echo '<pre>'; var_dump($courses); echo '</pre>';


