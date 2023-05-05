<?php

require __DIR__."/../Apps/Entities/TipoUsuario.php";
require __DIR__."/../Apps/Utils/Environment.php";
Environment::load('/');



$type = new TipoUsuario('Admir');
TipoUsuario::delete(3);
$type->insert();
TipoUsuario::update(3, [
                    'nome' => 'Aiaiai'
]);


echo '<pre>'; print_r($type); echo '</pre>';


$types = TipoUsuario::get();
echo '<pre>'; print_r($types); echo '</pre>';
