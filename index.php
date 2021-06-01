<?php

ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(site());


/*
 * WEB
 */
$router->namespace("Source\Controllers\App");

$router->group(null);

$router->get("/", "App:home", "app.home");
//$router->get("/exemplo", "App:exemplo", "app.exemplo");

/* materiais */
$router->group(null);
$router->group("catalogo");
$router->get("/", "App:catalogo", "app.catalogo");
//$router->get("/{categoria}", "App:categoriaMaterial", "app.categoriaMaterial");

//$router->get("/procurar/{search}", "App:procurarMaterial", "app.procurarMaterial");

/* autenticação */
$router->group(null);
$router->get("/entrar", "App:entrar", "app.entrar");
$router->get("/registrar", "App:registrar", "app.registrar");
$router->get("/sair", "App:sair", "app.sair");

$router->post("/login", "Autenticacao:entrar", "autenticacao.entrar");
$router->post("/register", "Autenticacao:registrar", "autenticacao.registrar");

/*
 * ERRORS
 */
$router->group("ooops");
$router->get("/{errcode}", "App:erro", "app.erro");


/*
 *******************************************************************************************
 *******************************************************************************************
 */


/*
 * ADMIN
 */
$router->namespace("Source\Controllers\Admin");

$router->group(null);

$router->group("admin");
$router->get("/", "Admin:home", "admin.home");

$router->get("/usuarios", "Admin:usuarios", "admin.usuarios");

/* Materiais */
$router->get("/materiais", "Admin:materiais", "admin.materiais");
$router->get("/materiais/{id}", "Admin:verMaterial", "admin.verMaterial");
$router->get("/materiais/atas", "Admin:atas", "admin.atas");
$router->get("/materiais/livros", "Admin:livros", "admin.livros");
$router->get("/materiais/revistas", "Admin:revistas", "admin.revistas");

$router->post("/materials/register", "Material:registrar", "material.registrar");
$router->post("/materials/update", "Material:actualizar", "material.actualizar");
$router->post("/materials/delete/{id}", "Material:deletar", "material.deletar");

/* Pedidos */
$router->get("/pedidos", "Admin:pedidos", "admin.pedidos");
$router->get("/pedidos/{id}", "Admin:verPedido", "admin.verPedido");
$router->get("/pedidos/editar/{id}", "Admin:actualizarPedido", "admin.actualizarPedido");

$router->post("/order/update", "AdminPedido:update", "adminPedido.update");
$router->post("/order/delete/{id}", "AdminPedido:delete", "adminPedido.delete");

/* Emprestimos */
$router->get("/emprestimos", "Admin:emprestimos", "admin.emprestimos");

/* Erro ao aceder */
$router->get("/erro", "Admin:erro", "admin.erro");


/*
 *******************************************************************************************
 *******************************************************************************************
 */


/*
 * ROUTE PROCESS
 */
$router->dispatch();


/*
 * ERRORS PROCESS
 */
if ($router->error()) {
    $router->redirect("app.erro", ["errcode" => $router->error()]);
}

ob_end_flush();