<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Emprestimo extends DataLayer
{

    public function __construct()
    {
        parent::__construct("emprestimos", ["id_pedido"], "id", false);
    }

    public function pedido()
    {
        return (new Pedido())->findById($this->id_pedido);
    }

}