<?php

require_once __DIR__ . "/Apps/Http/Router.php";
require_once __DIR__ . '/Bootstrap/Apps.php';

# Inicia o router
$router = new Router(URL);

// # Importa as rotas
include __DIR__ . "/Routes/Pages.php";

# Envia a resposta do router (imprime HTML na tela)
$router->run()->sendResponse();