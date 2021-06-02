<?php


namespace Source\Controllers\Admin;


use Source\Controllers\Controller;

class Emprestimo extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function remover($dados): void
    {
        $id = filter_var($dados["id"], FILTER_VALIDATE_INT);

        if (!$id) {
            $callback["type"] = "error";
            $callback["message"] = "Ocorreu um erro inesperado..";
            echo json_encode($callback);

            return;
        }

        $emprestimo = (new \Source\Models\Emprestimo())->findById($id);
        if (!$emprestimo) {
            $callback["type"] = "error";
            $callback["message"] = "Ocorreu um erro inesperado...";
            echo json_encode($callback);

            return;
        }

        $emprestimo->destroy();

        $callback["type"] = "success";
        $callback["message"] = "Emprestimo eliminado com sucesso";
        echo json_encode($callback);
    }


}