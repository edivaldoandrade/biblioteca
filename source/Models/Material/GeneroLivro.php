<?php


namespace Source\Models\Material;


use CoffeeCode\DataLayer\DataLayer;

class GeneroLivro extends DataLayer
{

    public function __construct()
    {
        parent::__construct("generos_livros", ["nome"], "id", false);
    }

}