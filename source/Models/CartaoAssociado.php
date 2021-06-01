<?php


namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class CartaoAssociado extends DataLayer
{

    public function __construct()
    {
        parent::__construct("cartoes_associados", ["id_usuario", "nome", "bi", "endereco"], "id", false);
    }

    public function add(Usuario $usuario, string $nome, string $bi, string $endereco): CartaoAssociado
    {
        $this->id_usuario = $usuario->id;
        $this->nome = $nome;
        $this->bi = $bi;
        $this->endereco = $endereco;

        return $this;
    }

    public function usuario()
    {
        return (new Usuario())->findById($this->id_usuario);
    }

}