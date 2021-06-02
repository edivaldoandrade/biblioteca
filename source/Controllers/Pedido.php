<?php


namespace Source\Controllers;


use Source\Models\CartaoAssociado;
use Source\Models\Emprestimo;
use Source\Models\Material\Material;

class Pedido extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function registrar($dados): void
    {
        $callback["type"] = "error";

        $material = (new Material())->findById(filter_var($dados["id"], FILTER_VALIDATE_INT));

        if (!$material) {
            $callback["message"] = "Ocorreu um erro desconhecido!";
            echo json_encode($callback);

            return;
        }

        if ($material->montanteEmprestimo() >= $material->quantidade) {
            $callback["type"] = "info";
            $callback["message"] = "Lamentamos, este material no momento encontra-se indisponível.";
            echo json_encode($callback);

            return;
        }

        if (
            empty($_SESSION["usuario"]) ||
            !$associado = (new CartaoAssociado())->find("id_usuario = :idu", "idu={$_SESSION["usuario"]}")->fetch()) {
            $callback["type"] = "info";
            $callback["message"] = 'Deverá <a href="' . site() . '/entrar">entrar</a> para solicitar o material.';
            echo json_encode($callback);

            return;
        }


        $pedido = new \Source\Models\Pedido();

        $pedido->id_cartao_associado = $associado->id;
        $pedido->id_material = $material->id;
        $pedido->estado = "Em processamento";

        if (!$pedido->save()) {
            $callback["message"] = $pedido->fail()->getMessage();
            echo json_encode($callback);
            return;
        }

        $callback["type"] = "success";
        $callback["message"] = "Material solicitado com sucesso";
        echo json_encode($callback);
    }

    public function actualizar($dados): void
    {
        $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);

        if (empty($dados["id"]) || !key_exists("estado", $dados)) {
            $callback["type"] = "info";
            $callback["message"] = "Preencha todos os campos obrigatórios!";
            echo json_encode($callback);

            return;
        }

        $callback["type"] = "error";

        $pedido = (new \Source\Models\Pedido())->findById($dados["id"]);
        if (!$pedido) {
            $callback["message"] = "Ocorreu um erro desconhecido.";
            echo json_encode($callback);
            return;
        }

        $pedido->estado = $dados["estado"];

        if (!$pedido->save()) {
            $callback["message"] = $pedido->fail()->getMessage();
            echo json_encode($callback);
            return;
        }

        if ($pedido->estado === "Entregue" &&
            !$emprestimo = (new Emprestimo())->find("id_pedido = :idp", "idp={$pedido->id}")->count()) {

            $emprestimo = new Emprestimo();
            $emprestimo->id_pedido = $pedido->id;
            $emprestimo->save();
        }

        $callback["type"] = "success";
        $callback["message"] = "Pedido actualizado com sucesso";
        echo json_encode($callback);
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

        $pedido = (new \Source\Models\Pedido())->findById($id);
        if (!$pedido) {
            $callback["type"] = "error";
            $callback["message"] = "Ocorreu um erro inesperado...";
            echo json_encode($callback);

            return;
        }

        $pedido->destroy();

        $callback["type"] = "success";
        $callback["message"] = "Pedido eliminado com sucesso";
        echo json_encode($callback);
    }


}