<?php


namespace Source\Models\Material;


use CoffeeCode\DataLayer\DataLayer;

class Ata extends DataLayer
{

    public function __construct()
    {
        parent::__construct("atas", ["id_material", "nome_congresso"], "id", false);
    }

    public function material()
    {
        return (new Material())->findById($this->id_material);
    }

}