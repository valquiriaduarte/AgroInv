<?php

require __DIR__."/../Apps/Entities/Turma.php";
require __DIR__."/../Apps/Utils/Environment.php";
Environment::load('/');



$class = new Turma(2000, 'TI-305', 30, 'Informática');
Turma::delete(18);
$class->insert();
Turma::update(19, [
                    'nome' => 'MA-304'
]);


echo '<pre>'; print_r($class); echo '</pre>';


$classes = Turma::get();
echo '<pre>'; print_r($classes); echo '</pre>';
