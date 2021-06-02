<?php


namespace Source\Controllers\Admin;


use CoffeeCode\Paginator\Paginator;
use Source\Controllers\Controller;
use Source\Models\CartaoAssociado;
use Source\Models\Emprestimo;
use Source\Models\Material\Ata;
use Source\Models\Material\Livro;
use Source\Models\Material\Material;
use Source\Models\Material\Revista;
use Source\Models\Pedido;

class Admin extends Controller
{

    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function home(): void
    {
        $head = $this->seo->optimize(
            site("name") . " - Dashboard",
            site("descAdmin"),
            $this->router->route("admin.home"),
            routeImage("Dashboard")
        )->render();

        echo $this->view->render("admin/pages/home", [
            "head" => $head,
            "usuarios" => (new CartaoAssociado())->find()->limit(5)->order("id DESC")->fetch(true),
            "materiais" => (new Material())->find()->limit(5)->fetch(true),
            "pedidos" => (new Pedido())->find()->limit(5)->fetch(true),
            "emprestimos" => (new Emprestimo())->find()->limit(5)->fetch(true)
        ]);
    }

    public function usuarios(): void
    {
        $itens = new CartaoAssociado();
        $page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);

        $paginator = new Paginator();
        $paginator->pager($itens->find()->count(), 5, $page, 1);

        $lista = $itens->find()->order("id DESC");

        $head = $this->seo->optimize(
            site("name") . " - Dashboard",
            site("descAdmin"),
            $this->router->route("admin.usuarios"),
            routeImage("Dashboard")
        )->render();

        echo $this->view->render("admin/pages/usuarios", [
            "head" => $head,
            "lista" => $lista->limit($paginator->limit())->offset($paginator->offset())->fetch(true),
            "paginator" => $paginator
        ]);
    }

    public function materiais(): void
    {
        $itens = new Material();
        $page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);

        $paginator = new Paginator();
        $paginator->pager($itens->find()->count(), 5, $page, 1);

        $lista = $itens->find()->order("id DESC");

        $head = $this->seo->optimize(
            site("name") . " - Dashboard",
            site("descAdmin"),
            $this->router->route("admin.materiais"),
            routeImage("Dashboard")
        )->render();

        echo $this->view->render("admin/pages/materiais", [
            "head" => $head,
            "lista" => $lista->limit($paginator->limit())->offset($paginator->offset())->fetch(true),
            "paginator" => $paginator
        ]);
    }

    public function atas(): void
    {
        $itens = new Ata();
        $page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);

        $paginator = new Paginator();
        $paginator->pager($itens->find()->count(), 5, $page, 1);

        $lista = $itens->find()->order("id DESC");

        $head = $this->seo->optimize(
            site("name") . " - Dashboard",
            site("descAdmin"),
            $this->router->route("admin.atas"),
            routeImage("Dashboard")
        )->render();

        echo $this->view->render("admin/pages/tiposMateriais", [
            "head" => $head,
            "lista" => $lista->limit($paginator->limit())->offset($paginator->offset())->fetch(true),
            "paginator" => $paginator,
            "title" => "Atas"
        ]);
    }

    public function livros(): void
    {
        $itens = new Livro();
        $page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);

        $paginator = new Paginator();
        $paginator->pager($itens->find()->count(), 5, $page, 1);

        $lista = $itens->find()->order("id DESC");

        $head = $this->seo->optimize(
            site("name") . " - Dashboard",
            site("descAdmin"),
            $this->router->route("admin.livros"),
            routeImage("Dashboard")
        )->render();

        echo $this->view->render("admin/pages/tiposMateriais", [
            "head" => $head,
            "lista" => $lista->limit($paginator->limit())->offset($paginator->offset())->fetch(true),
            "paginator" => $paginator,
            "title" => "Livros"
        ]);
    }

    public function revistas(): void
    {
        $itens = new Revista();
        $page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);

        $paginator = new Paginator();
        $paginator->pager($itens->find()->count(), 5, $page, 1);

        $lista = $itens->find()->order("id DESC");

        $head = $this->seo->optimize(
            site("name") . " - Dashboard",
            site("descAdmin"),
            $this->router->route("admin.revistas"),
            routeImage("Dashboard")
        )->render();

        echo $this->view->render("admin/pages/tiposMateriais", [
            "head" => $head,
            "lista" => $lista->limit($paginator->limit())->offset($paginator->offset())->fetch(true),
            "paginator" => $paginator,
            "title" => "Revistas"
        ]);
    }

    public function actualizarMaterial($data): void
    {

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);

        if (!$id) {
            $this->router->redirect("admin.erro");
        }

        $item = (new Material())->findById($id);

        if (!$item) {
            $this->router->redirect("admin.erro");
        }

        $head = $this->seo->optimize(
            site("name") . " - Dashboard",
            site("descAdmin"),
            $this->router->route("admin.actualizarMaterial"),
            routeImage("Dashboard"),
            false
        )->render();

        echo $this->view->render("admin/pages/actualizarMaterial", [
            "head" => $head,
            "material" => $item
        ]);
    }

    public function erro($dados): void
    {
        $head = $this->seo->optimize(
            site("name") . " - Oooops!",
            site("descAdmin"),
            $this->router->route("admin.erro"),
            routeImage("Erro")
        )->render();

        echo $this->view->render("admin/pages/erro", [
            "head" => $head
        ]);
    }
}