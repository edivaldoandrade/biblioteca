<?php


namespace Source\Models\Material;


use CoffeeCode\DataLayer\DataLayer;
use Source\Models\Emprestimo;
use Source\Models\Pedido;

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

    //Alínea b)
    public function contagemMaterialSolicitado(): int
    {
        return (new Pedido())->find("id_material = :idm", "idm={$this->id}")->count();
    }

    public function montanteEmprestimo()
    {
        $sum = 0;

        $listaPedidos = (new Pedido())->find("id_material = :idm", "idm={$this->id}")->fetch(true);
        if (!$listaPedidos) {
            return $sum;
        }

        foreach ($listaPedidos as $pedido) {
            if((new Emprestimo())->find("id_pedido = :idp", "idp={$pedido->data()->id}")->count()){
                $sum += 1;
            }
        }

        return $sum;
    }


}