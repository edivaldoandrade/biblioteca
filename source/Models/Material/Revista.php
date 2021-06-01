<?php


namespace Source\Models\Material;


use CoffeeCode\DataLayer\DataLayer;

class Revista extends DataLayer
{

    public function __construct()
    {
        parent::__construct("revistas", ["id_material", "id_frequencia_publicacao"], "id", false);
    }

    public function material()
    {
        return (new Material())->findById($this->id_material);
    }

    public function frequenciaPublicacao()
    {
        return (new FrequenciaPublicacaoRevista())->findById($this->id_frequencia_publicacao);
    }

}