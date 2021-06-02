<?php


namespace Source\Models\Material;


use CoffeeCode\DataLayer\DataLayer;

class Material extends DataLayer
{
    public function __construct()
    {
        parent::__construct("materiais", ["titulo", "autor", "ano_publicacao", "ano_chegada", "editorial", "quantidade", "preco"]);
    }

    public function add(string $titulo, string $autor, int $ano_publicacao, int $ano_chegada, string $editorial, int $quantidade, float $preco): Material
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano_publicacao = $ano_publicacao;
        $this->ano_chegada = $ano_chegada;
        $this->editorial = $editorial;
        $this->quantidade = $quantidade;
        $this->preco = $preco;

        return $this;
    }

    public function tipoMaterial()
    {

        if ($ata = (new Ata())->find("id_material = :idm", "idm={$this->id}")->fetch()) {
            return $ata;
        }

        if ($livro = (new Livro())->find("id_material = :idm", "idm={$this->id}")->fetch()) {
            return $livro;
        }

        if ($revista = (new Revista())->find("id_material = :idm", "idm={$this->id}")->fetch()) {
            return $revista;
        }
    }


}