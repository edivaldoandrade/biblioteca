<?php


namespace Source\Models\Material;


use CoffeeCode\DataLayer\DataLayer;

class Livro extends DataLayer
{

    public function __construct()
    {
        parent::__construct("livros", ["id_material", "id_genero"], "id", false);
    }

    public function material()
    {
        return (new Material())->findById($this->id_material);
    }

    public function genero()
    {
        return (new GeneroLivro())->findById($this->id_genero);
    }

}