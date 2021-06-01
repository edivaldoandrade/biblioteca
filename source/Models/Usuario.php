<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;
use Exception;

class Usuario extends DataLayer
{
    public function __construct()
    {
        parent::__construct("usuarios", ["nome", "senha"]);
    }

    public function save(): bool
    {
        if (!$this->validarNome() || !$this->validarSenha() || !parent::save()) {
            return false;
        }

        return true;
    }

    protected function validarNome(): bool
    {
        $usuarioPorNome = null;
        if (!$this->id) {
            $usuarioPorNome = $this->find("nome = :nome", "nome={$this->nome}")->count();
        } else {
            $usuarioPorNome = $this->find("nome = :nome AND id != :id", "nome={$this->nome}&id={$this->id}")->count();
        }

        if ($usuarioPorNome) {
            $this->fail = new Exception("O nome informado já está a ser utilizado");
            return false;
        }

        return true;
    }

    protected function validarSenha(): bool
    {
        if (strlen($this->senha) < 6) {
            $this->fail = new Exception("Informe uma senha com pelo menos 6 caracteres");
            return false;
        }

        if (password_get_info($this->senha)["algo"]) {
            return true;
        }

        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);

        return true;
    }
}