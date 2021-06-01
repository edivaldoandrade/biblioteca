<?php


namespace Source\Models\Material;


use CoffeeCode\DataLayer\DataLayer;

class FrequenciaPublicacaoRevista extends DataLayer
{

    public function __construct()
    {
        parent::__construct("frequencias_publicacoes_revistas", ["frequencia"], "id", false);
    }

}