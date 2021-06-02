<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>
<link rel="stylesheet" href="<?= assetAdmin("css/sweetalert2.css"); ?>">
<?php $v->end(); ?>

<section>
    <h1>Emprestimos</h1>
</section>

<div>
    <h3>Emprestimos Registrados</h3>

    <?php if (!empty($lista)): ?>
        <table>
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Usuário</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lista as $emprestimo): ?>
                <tr style="background-color: #dcdcdc;">
                    <td><?= $emprestimo->pedido()->material()->titulo ?></td>
                    <td><?= $emprestimo->pedido()->associado()->nome ?></td>
                    <td>
                        <div>
                            <a href="#" class="remove"
                               data-action="<?= $router->route("emprestimo.remover", ["id" => $emprestimo->id]); ?>">
                                Remover
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot><?php echo $paginator->render(); ?></tfoot>
        </table>
    <?php else: ?>
        <span>Não existem emprestimos no sistema...</span>
    <?php endif; ?>
</div>

<?php $v->start("scripts") ?>
<script src="<?= assetAdmin("js/sweetalert2.min.js") ?>"></script>
<script src="<?= assetAdmin("js/sweet.js") ?>"></script>
<?php $v->end(); ?>
