<?php

setlocale(LC_TIME, 'pt_AO', 'pt_AO.utf-8', 'pt_AO.utf-8', 'portuguese');

define("SITE", [
    "name" => "Biblioteca",
    "desc" => "Alugue aqui os melhores Livros, Revistas e mais...",
    "descAdmin" => "Dashboard - Biblioteca",
    "domain" => "biblioteca.co.ao",
    "locale" => "pt_AO",
    "root" => "http://localhost/biblioteca"
]);

/*
 * DATABASE CONNECT
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "biblioteca",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);