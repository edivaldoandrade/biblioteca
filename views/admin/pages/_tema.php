<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?= $head; ?>

    <?php if ($v->section("links")):
        echo $v->section("links");
    endif; ?>

</head>
<body>

<ul>
    <li><a href="<?= $router->route("app.home"); ?>">Início</a></li>
    <li><a href="<?= $router->route("admin.home"); ?>">Dashboard</a></li>
    <br>
    <li><a href="<?= $router->route("admin.alineas"); ?>">Alineas</a></li>
    <br>
    <li><a href="<?= $router->route("admin.usuarios"); ?>">Usuários</a></li>
    <li>
        <a href="<?= $router->route("admin.materiais"); ?>">Materiais</a>
        <ul>
            <li><a href="<?= $router->route("admin.atas"); ?>">Atas</a></li>
            <li><a href="<?= $router->route("admin.livros"); ?>">Livros</a></li>
            <li><a href="<?= $router->route("admin.revistas"); ?>">Revistas</a></li>
        </ul>
    </li>
    <li><a href="<?= $router->route("admin.pedidos"); ?>">Pedidos</a></li>
    <li><a href="<?= $router->route("admin.emprestimos"); ?>">Emprestimos</a></li>
</ul>

<?= $v->section("content"); ?>

<script src="<?= asset("js/jquery-3.2.1.min.js"); ?>"></script>
<?php if ($v->section("scripts")):
    echo $v->section("scripts");
endif; ?>
</body>
</html>
