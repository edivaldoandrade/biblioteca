<?php


namespace Source\Controllers\Admin;


use Source\Controllers\Controller;
use Source\Models\Material\Ata;
use Source\Models\Material\Livro;
use Source\Models\Material\Revista;

class Material extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function registrar($dados): void
    {
        $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
        if (empty($dados["titulo"]) || empty($dados["autor"]) || empty($dados["ano_publicacao"]) || empty($dados["ano_chegada"]) || empty($dados["editoral"]) || empty($dados["quantidade"]) || !key_exists("tipo", $dados) || !key_exists("categoria", $dados)) {
            $callback["type"] = "info";
            $callback["message"] = "Preencha todos os campos obrigatórios!";
            echo json_encode($callback);

            return;
        }

        $callback["type"] = "error";

        $preço = ($dados["ano_publicacao"] + 1) / $dados["ano_chegada"];
        if ($dados["tipo"] === "ata") {

            $tipoMaterial = new Ata();
            $tipoMaterial->nome_congresso = $dados["categoria"];

        } elseif ($dados["tipo"] === "livro") {

            if ($dados["categoria"] === "criancas") {
                $preço *= 1.05;
                $idCat = 1;
            }

            if ($dados["categoria"] === "ficcao") {
                $preço *= 0.6;
                $idCat = 2;
            }

            if ($dados["categoria"] === "historia") {
                $preço *= 1.2;
                $idCat = 3;
            }

            $tipoMaterial = new Livro();
            $tipoMaterial->id_genero = $idCat;

        } elseif ($dados["tipo"] === "revista") {

            if ($dados["categoria"] === "trimestral") {
                $preço *= 1.4;
                $idCat = 1;
            }

            if ($dados["categoria"] === "semestral") {
                $preço *= 1.33;
                $idCat = 2;
            }

            if ($dados["categoria"] === "anual") {
                $preço *= 1.15;
                $idCat = 3;
            }

            $tipoMaterial = new Revista();
            $tipoMaterial->id_frequencia_publicacao = $idCat;

        }

        $material = (new \Source\Models\Material\Material())->add(
            $dados["titulo"],
            $dados["autor"],
            $dados["ano_publicacao"],
            $dados["ano_chegada"],
            $dados["editoral"],
            $dados["quantidade"],
            $preço
        );;

        if (!$material->save()) {
            $callback["message"] = $material->fail()->getMessage();
            echo json_encode($callback);
            return;
        }

        $tipoMaterial->id_material = $material->id;
        $tipoMaterial->save();

        $callback["type"] = "success";
        $callback["message"] = "Material registrado com sucesso";
        echo json_encode($callback);
    }

    public function actualizar($dados): void
    {
        $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);

        if (empty($dados["titulo"]) || empty($dados["autor"]) || empty($dados["ano_publicacao"]) || empty($dados["ano_chegada"]) || empty($dados["editoral"]) || empty($dados["quantidade"])) {
            $callback["type"] = "info";
            $callback["message"] = "Preencha todos os campos obrigatórios!";
            echo json_encode($callback);

            return;
        }

        $callback["type"] = "error";

        $material = (new \Source\Models\Material\Material())->findById($dados["id"]);
        if (!$material) {
            $callback["message"] = "Material não encontrado...";
            echo json_encode($callback);
            return;
        }

        $material->titulo = $dados["titulo"];
        $material->autor = $dados["autor"];
        $material->ano_publicacao = $dados["ano_publicacao"];
        $material->ano_chegada = $dados["ano_chegada"];
        $material->editorial = $dados["editoral"];
        $material->quantidade = $dados["quantidade"];
        //$material->preço = $preço;

        if (!$material->save()) {
            $callback["message"] = $material->fail()->getMessage();
            echo json_encode($callback);
            return;
        }

        $callback["type"] = "success";
        $callback["message"] = "Material actualizado com sucesso";
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

        $material = (new \Source\Models\Material\Material())->findById($id);
        if (!$material) {
            $callback["type"] = "error";
            $callback["message"] = "Ocorreu um erro inesperado...";
            echo json_encode($callback);
            return;
        }

        $titulo = $material->titulo;

        $material->destroy();

        $callback["type"] = "success";
        $callback["message"] = $titulo . " eliminado com sucesso";
        echo json_encode($callback);
    }
}