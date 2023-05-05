<?php

require_once __DIR__ . "/../Apps/Utils/View.php";
require_once __DIR__ . '/../Apps/Utils/Environment.php';

# Define as variáveis de ambiente
Environment::load();
define('URL', getenv('URL'));

# Define as variáveis da view
View::init([
           'home-url' => URL,
           'calendario-url' => URL . "/calendario",
           'login-url' => URL . "/login",
           'agendamento-url' => URL . "/agendamento",
           'adicionar-item-url' => '/adicionar-item',
           'teacher-adms-url' => '/professores-administradores'
]);
