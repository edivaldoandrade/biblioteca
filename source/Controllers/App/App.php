<?php


namespace Source\Controllers\App;


use Source\Controllers\Controller;
use Source\Models\Usuario;

class App extends Controller
{
    /** @var Usuario */
    protected $usuario;

    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function home(): void
    {
        if (empty($_SESSION["usuario"]) || !$this->usuario = (new Usuario())->findById($_SESSION["usuario"])) {
            $this->usuario = null;
        }

        $head = $this->seo->optimize(
            site("name") . " - Livros, revistas e mais!",
            site("desc"),
            $this->router->route("app.home"),
            routeImage("Home")
        )->render();

        echo $this->view->render("app/pages/home", [
            "head" => $head,
            "usuario" => $this->usuario
        ]);
    }

    public function catalogo(): void
    {
        if (empty($_SESSION["usuario"]) || !$this->usuario = (new Usuario())->findById($_SESSION["usuario"])) {
            $this->usuario = null;
        }

        $head = $this->seo->optimize(
            site("name") . " - Catalogo",
            site("desc"),
            $this->router->route("app.catalogo"),
            routeImage("Home")
        )->render();

        echo $this->view->render("app/pages/catalogo", [
            "head" => $head,
            "usuario" => $this->usuario
        ]);
    }

    public function entrar(): void
    {
        if (empty($_SESSION["usuario"]) || !$this->usuario = (new Usuario())->findById($_SESSION["usuario"])) {

            $head = $this->seo->optimize(
                site("name") . " - Entre Para Continuar",
                site("desc"),
                $this->router->route("app.entrar"),
                routeImage("Entrar")
            )->render();

            echo $this->view->render("app/pages/entrar", [
                "head" => $head
            ]);

        } else {
            $this->router->redirect("app.home");
        }
    }

    public function sair(): void
    {
        unset($_SESSION["usuario"]);

        flash("info", "Você saiu com sucesso, volte logo...");
        $this->router->redirect("app.entrar");
    }

    public function registrar(): void
    {
        if (empty($_SESSION["usuario"]) || !$this->usuario = (new Usuario())->findById($_SESSION["usuario"])) {

            $head = $this->seo->optimize(
                site("name") . " - Criar uma conta",
                site("desc"),
                $this->router->route("app.registrar"),
                routeImage("Registrar")
            )->render();


            echo $this->view->render("app/pages/registrar", [
                "head" => $head
            ]);

        } else {
            $this->router->redirect("app.home");
        }
    }

    public function erro($dados): void
    {
        $erro = filter_var($dados["errcode"], FILTER_VALIDATE_INT);

        $head = $this->seo->optimize(
            site("name") . " - Oooops!",
            site("desc"),
            $this->router->route("app.erro", ["errcode" => $erro]),
            routeImage($erro)
        )->render();

        echo $this->view->render("app/pages/erro", [
            "head" => $head,
            "erro" => $erro
        ]);
    }
}