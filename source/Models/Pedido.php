<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;
use Source\Models\Material\Material;

class Pedido extends DataLayer
{

    public function __construct()
    {
        parent::__construct("pedidos", ["id_cartao_associado", "id_material", "estado"]);
    }

    public function associado()
    {
        return (new CartaoAssociado())->findById($this->id_cartao_associado);
    }

    public function material()
    {
        return (new Material())->findById($this->id_material);
    }

    public function contagemEmprestimos(): int
    {
        return (new Emprestimo())->find("id_pedido = :idp", "idp={$this->id}")->count();
    }

}