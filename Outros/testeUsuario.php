<?php

require __DIR__."/../Apps/Entities/Usuario.php";
require __DIR__."/../Apps/Utils/Environment.php";
Environment::load('/');

$user = new Usuario("Mateus Regasi Gomes Martins", "mateusregasigm@gmail.com", "Mat&usdasdasd1", "12345678910", "99999-9999", 1);
// Usuario::delete(5);
// $user->insert();
// Usuario::update(5, [
//                 'nome' => 'Mateus Regasi'
// ]);

echo '<pre>'; print_r($user); echo '</pre>';

$usuarios = Usuario::get();

echo '<pre>'; print_r($usuarios); echo '</pre>';
