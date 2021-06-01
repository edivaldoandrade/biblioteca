<?php


namespace Source\Controllers\Admin;


use Source\Controllers\Controller;

class Material extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function registrar($dados): void
    {
        $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
        var_dump($dados);
        if (empty($dados["titulo"]) || empty($dados["autor"]) || empty($dados["ano_publicacao"]) || empty($dados["ano_chegada"]) || empty($dados["editorial"]) || empty($dados["quantidade"]) || !key_exists("categoria", $dados)) {
            $callback["type"] = "info";
            $callback["message"] = "Preencha todos os campos obrigatórios!";
            echo json_encode($callback);

            /*
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos!"
            ]);
            */

            return;
        }

        if ($dados["categoria"] === "ata") {
            $preço = ($dados["ano_publicacao"] + 1) / $dados["ano_chegada"];
            echo "é uma ata";
        } elseif ($dados["categoria"] === "livro") {
            echo "é um livro";
        } elseif ($dados["categoria"] === "revista") {
            echo "é uma revista";
        }
        return;

        $material = (new Material())->add(
            $dados["titulo"],
            $dados["autor"],
            $dados["ano_publicacao"],
            $dados["ano_chegada"],
            $dados["editorial"],
            $dados["quantidade"],
            $preço
        );;

        if (!$material->save()) {
            $callback["message"] = $material->fail()->getMessage();
            echo json_encode($callback);
            return;
        }

        $callback["type"] = "success";
        $callback["message"] = "Produto registrado com sucesso";
        echo json_encode($callback);
    }

    public function actualizar($dados): void
    {
        //tratamento da descrição
        $desc = $dados["description"];
        $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);

        if (empty($dados["name"]) || empty($dados["price"]) || empty($dados["stock"]) || empty($dados["category"]) || empty($dados["brand"])) {
            $callback["type"] = "info";
            $callback["message"] = "Preencha todos os campos obrigatórios!";
            echo json_encode($callback);
            return;
        }

        $callback["type"] = "error";

        $product = (new Product())->findById($dados["id"]);
        if (!$product) {
            $callback["message"] = "Produto não encontrado...";
            echo json_encode($callback);
            return;
        }

        $product->name = $dados["name"];
        $product->description = $desc;
        $product->price = $dados["price"];
        $product->sale = (!empty($dados["sale"]) ? $dados["sale"] : null);
        $product->stock = $dados["stock"];
        $product->category_id = $dados["category"];
        $product->brand = $dados["brand"];
        $product->dimension = $dados["dimension"];
        $product->weight = (!empty($dados["weight"]) ? $dados["weight"] : null);
        $product->status = (array_key_exists("status", $dados) ? $dados["status"] : "off");

        /*
         * UMA FUNÇÃO PARA UPLOAD IMAGENS no HELPERS
         */
        //Caso haja imagens por apagar ou substituir, remove-las da pasta ****************************************************
        $upload = new Image("views/store/assets/images/products/store", "{$product->store_id}"); //trocar para o nome da loja

        /*
         * Imagem principal
         */
        $file = $_FILES["img"];

        if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
            if ($file["error"] !== UPLOAD_ERR_NO_FILE) {
                $callback["message"] = "O arquivo \"{$file["name"]}\" não é válido.<br>Selecione uma imagem principal válida e inferior a " . ini_get("upload_max_filesize") . "B!";
                echo json_encode($callback);
                return;
            }
        } else {
            // Primeiro verificar a galeria, para verificar se existe algum erro e só depois gravar esse trecho
            $product->img = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 1200);
        }

        /*
         * Mais imagens
         */

        $imgs = $_FILES["imgs"];

        if (key_exists("active_imgs", $dados)) {
            if (count($imgs["type"]) > 4 || ((count($imgs["type"]) + count($dados["active_imgs"])) >= 5 && $imgs["error"][0] !== UPLOAD_ERR_NO_FILE)) {
                $callback["message"] = "Excedeu o limite máximo de imagens na galeria...";
                echo json_encode($callback);
                return;
            }
        }

        for ($i = 0; $i < count($imgs["type"]); $i++) {
            foreach (array_keys($imgs) as $keys) {
                $imgFiles[$i][$keys] = $imgs[$keys][$i];
            }
        }

        //Fazer mais um foreach para percorrer se existe alguma imagem indisponível, só depois criar a imagem
        foreach ($imgFiles as $file) {
            if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
                if ($file["error"] !== UPLOAD_ERR_NO_FILE) {
                    $callback["message"] = "O arquivo \"{$file["name"]}\" não é válido.<br> Selecione uma imagem válida e inferior a " . ini_get("upload_max_filesize") . "B!";
                    echo json_encode($callback);
                    return;
                }
            }
        }

        $uploadedFiles = null;
        foreach ($imgFiles as $file) {
            if ($file["error"] !== UPLOAD_ERR_NO_FILE) {
                $uploadedFiles [] = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 1200);
            }
        }


        if (!$product->save()) {
            $callback["message"] = $product->fail()->getMessage();
            echo json_encode($callback);
            return;
        }

        //verificar quais imagens remover
        if (key_exists("active_imgs", $dados)) {
            foreach ($product->pictures() as $picture) {
                if (!in_array($picture->link, $dados["active_imgs"])) {
                    $pictureRemove = (new ProductPicture())->findById($picture->id);
                    $pictureRemove->destroy();
                }
            }
        } elseif ($product->pictures()) {
            foreach ($product->pictures() as $picture) {
                $pictureRemove = (new ProductPicture())->findById($picture->id);
                $pictureRemove->destroy();
            }
        }

        if ($uploadedFiles) {
            foreach ($uploadedFiles as $picture) {
                $pic = (new ProductPicture())->add($product->id, $picture, $product->name);
                $pic->save();
            }
        }

        // UMA FUNÇÃO PARA TAMANHOS
        $this->sizes($product, $dados["sizes"]);

        // UMA FUNÇÃO PARA TAGS
        if (key_exists("tags", $dados)) {
            $this->tags($product, $dados["tags"]);
        } else {
            $this->tags($product);
        }

        $callback["type"] = "success";
        $callback["message"] = "Produto actualizado com sucesso";
        echo json_encode($callback);
    }

    public function deletar($dados): void
    {
        $id = filter_var($dados["id"], FILTER_VALIDATE_INT);

        if (!$id) {
            $callback["type"] = "error";
            $callback["message"] = "Ocorreu um erro inesperado..";
            echo json_encode($callback);
            return;
        }

        $material = (new Material())->findById($id);
        if (!$material) {
            $callback["type"] = "error";
            $callback["message"] = "Ocorreu um erro inesperado...";
            echo json_encode($callback);
            return;
        }

        $titulo = $material->titulo;

        $product->destroy();

        $callback["type"] = "success";
        $callback["message"] = $titulo . " eliminado com sucesso";
        echo json_encode($callback);
    }
}