<?php

ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(site());


/* Global */
$router->namespace("Source\Controllers");

$router->group(null);
$router->group("order");
$router->post("/register/{id}", "Pedido:registrar", "pedido.registrar");
$router->post("/update/", "Pedido:actualizar", "pedido.actualizar");
$router->post("/delete/{id}", "Pedido:remover", "pedido.remover");


/*
 * WEB
 */
$router->namespace("Source\Controllers\App");

$router->group(null);

$router->get("/", "App:home", "app.home");

/* materiais */
$router->group(null);
$router->group("catalogo");
$router->get("/", "App:catalogo", "app.catalogo");

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
$router->get("/alineas", "Admin:alineas", "admin.alineas");
$router->get("/alineaC/{id}", "Admin:alineaC", "admin.alineaC");

$router->get("/usuarios", "Admin:usuarios", "admin.usuarios");

/* Materiais */
$router->get("/materiais", "Admin:materiais", "admin.materiais");
$router->get("/materiais/atas", "Admin:atas", "admin.atas");
$router->get("/materiais/livros", "Admin:livros", "admin.livros");
$router->get("/materiais/revistas", "Admin:revistas", "admin.revistas");
$router->get("/materiais/editar/{id}", "Admin:actualizarMaterial", "admin.actualizarMaterial");

$router->post("/materials/register", "Material:registrar", "material.registrar");
$router->post("/materials/update", "Material:actualizar", "material.actualizar");
$router->post("/materials/delete/{id}", "Material:remover", "material.remover");

/* Pedidos */
$router->get("/pedidos", "Admin:pedidos", "admin.pedidos");
$router->get("/pedidos/editar/{id}", "Admin:actualizarPedido", "admin.actualizarPedido");

/* Emprestimos */
$router->get("/emprestimos", "Admin:emprestimos", "admin.emprestimos");

$router->post("/loan/delete/{id}", "Emprestimo:remover", "emprestimo.remover");

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