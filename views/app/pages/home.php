<?php $v->layout("app/pages/_tema"); ?>

<?php $v->start("links") ?>
<link rel="stylesheet" href="<?= assetAdmin("css/sweetalert2.css"); ?>">
<?php $v->end(); ?>

<section>
    <h1>Home</h1>
</section>


<div>
    <h3>Últimos Materiais Registrados</h3>

    <?php if (!empty($materiais)): ?>
        <table>
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Ano de Publicação</th>
                <th>Editora</th>
                <th>Preço</th>
                <th
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($materiais as $material): ?>
                <tr style="background-color: #dcdcdc;">
                    <td><?= $material->titulo ?></td>
                    <td><?= $material->autor ?></td>
                    <td><?= $material->ano_publicacao ?></td>
                    <td><?= $material->editorial ?></td>
                    <td><?= number_format($material->preco, 2, ",", " ") ?></td>
                    <td>
                        <a href="#" class="add"
                           data-action="<?= $router->route("pedido.registrar", ["id" => $material->id]); ?>">
                            Solicitar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <span>Não existem materiais no sistema...</span>
    <?php endif; ?>
</div>

<?php $v->start("scripts") ?>
<script src="<?= assetAdmin("js/sweetalert2.min.js") ?>"></script>
<script src="<?= assetAdmin("js/sweet.js") ?>"></script>
<?php $v->end(); ?>
