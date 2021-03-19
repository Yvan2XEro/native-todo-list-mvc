<?php

session_start();

require "./../vendor/autoload.php";

use App\Utils\Dev\VarDumper;
use App\Kernel\Router\Router;
use App\Utils\Navigation\SessionData;

$router = new Router($_SERVER['REQUEST_URI']);

$router->get("/", "todo#allTodos");
$router->get("/login", "security#login");
$router->post("/login", "security#login");
$router->get("/logout", "security#logout");
$router->get("/todos", "todo#allTodos");
$router->post("/todos", "todo#add");
$router->get("/todos/:id", "todo#showTodo");
$router->get("/todos/:id/statut", "todo#setStatut");
$router->get("/todos/:id/delete", "todo#delete");
$router->post("/todos/:id", "todo#updateTodo");

$router->routing();