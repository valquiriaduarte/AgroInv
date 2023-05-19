<?php

$path = __DIR__ . "/../Apps/Controller";
$dirs = array_diff(scandir($path), ["..", "."]);
foreach($dirs as $dir){
  foreach(array_diff(scandir("$path/$dir"), ["..", "."]) as $controller) 
    include_once "$path/$dir/$controller";
  // else if(file_exists("$path/$dir")) include_once "$path/$dir";
}

require_once __DIR__ . "/../Apps/Http/Response.php";


/* -------------- NO LOGGED ----------------*/
$router->get("/", [
             function(){
               return new Response(200, HomePage::get());
             }
]);
$router->get("/calendario", [
             function(){
               return new Response(200, CalendarPage::get());
             }
]);
$router->get("/login", [
             function(){
               return new Response(200, LoginPage::get());
             }
]);
$router->post("/login", [
  function($request){
   return new Response(200, LoginPage::get($request));
  }
]);
$router->get("/aulas", [
  function($request){
   return new Response(200, ClassPage::get());
  }
]);

$router->get("/agendamento", [
             function(){
               return new Response(200, SchedulingPage::get());
             }
]);
$router->post("/agendamento", [
             function(){
               return new Response(200, SchedulingPage::get());
             }
]);

$router->post("/calendario", [
             function($request){
               return new Response(200, CalendarPage::get($request));
             }
]);

# Usuários


$router->get("/cadastrar-usuario", [
  function(){
   return new Response(200, RegisterUserPage::get());
  }
]);
$router->post("/cadastrar-usuario", [
  function($request){
   return new Response(200, RegisterUserPage::insert($request));
  }
]);
$router->get("/usuarios", [
  function($request){
   return new Response(200, ManageUserPage::get($request));
  }
]);
$router->post("/usuarios", [
  function($request){
   return new Response(200, ManageUserPage::get($request));
  }
]);
$router->get('/usuario/{name}', [
             function($request, $name){
               return new Response(200, UserPage::get($request, $name));
             }
]);
$router->post('/usuario/{name}', [
             function($request, $name){
               return new Response(200, UserPage::insert($request, $name));
             }
]);

# Itens
$router->get('/adicionar-item', [
             function(){
               return new Response(200, AddItemPage::get());
             }
]);

$router -> get("/professores-administradores", [
   function(){
     return new Response(200, TeachersAdms::get());
   }            
]);