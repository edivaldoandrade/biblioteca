<?php


namespace Source\Controllers\App;


use Source\Controllers\Controller;
use Source\Models\CartaoAssociado;
use Source\Models\Usuario;

class Autenticacao extends Controller
{

    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function entrar($dados): void
    {
        $nome = filter_var($dados["nome_usuario"], FILTER_DEFAULT);
        $senha = filter_var($dados["senha"], FILTER_DEFAULT);

        if (!$nome || !$senha) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Dados inválidos. Por favor, informe os seus dados para entrar."
            ]);
            return;
        }

        $usuario = (new Usuario())->find("nome = :n", "n={$nome}")->fetch();
        if (!$usuario || !password_verify($senha, $usuario->senha)) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Os dados estão incorrectos..."
            ]);
            return;
        }

        $_SESSION["usuario"] = $usuario->id;

        echo $this->ajaxResponse("redirect", ["url" => $this->router->route("app.home")]);
    }

    public function registrar($dados): void
    {
        $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
        if (in_array("", $dados)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos!"
            ]);
            return;
        }

        if (strcmp($dados["senha"], $dados["confirmar_senha"])) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "As senhas não coincidem!"
            ]);
            return;
        }

        $usuario = new Usuario();

        $usuario->nome = $dados["nome_usuario"];
        $usuario->senha = $dados["senha"];

        if (!$usuario->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $usuario->fail()->getMessage()
            ]);
            return;
        }

        $cartao = (new CartaoAssociado())->add($usuario, $dados["nome"], $dados["bi"], $dados["endereco"]);
        $cartao->save();

        $_SESSION["usuario"] = $usuario->id;

        echo $this->ajaxResponse("redirect", ["url" => $this->router->route("app.home")]);
    }
}