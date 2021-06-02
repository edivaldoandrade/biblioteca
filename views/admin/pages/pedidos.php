<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>
<link rel="stylesheet" href="<?= assetAdmin("css/sweetalert2.css"); ?>">
<?php $v->end(); ?>

<section>
    <h1>Pedidos</h1>
</section>

<div>
    <h3>Pedidos Registrados</h3>

    <?php if (!empty($lista)): ?>
        <table>
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Preço</th>
                <th>Usuário</th>
                <th>Data do pedido</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lista as $pedido): ?>
                <tr style="background-color: #dcdcdc;">
                    <td><?= $pedido->material()->titulo ?></td>
                    <td><?= $pedido->material()->preco ?></td>
                    <td><?= $pedido->associado()->nome ?></td>
                    <td><?= strftime('%d/%m/%Y, %T', strtotime($pedido->created_at)) ?></td>
                    <td><?= $pedido->estado ?></td>
                    <td>
                        <?php if(!$pedido->contagemEmprestimos()): ?>
                        <div>
                            <a href="<?= $router->route("admin.actualizarPedido", ["id" => $pedido->id]); ?>">
                                Editar
                            </a>
                        </div>
                        <div>
                            <a href="#" class="remove"
                               data-action="<?= $router->route("pedido.remover", ["id" => $pedido->id]); ?>">
                                Remover
                            </a>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot><?php echo $paginator->render(); ?></tfoot>
        </table>
    <?php else: ?>
        <span>Não existem pedidos no sistema...</span>
    <?php endif; ?>
</div>

<?php $v->start("scripts") ?>
<script src="<?= assetAdmin("js/sweetalert2.min.js") ?>"></script>
<script src="<?= assetAdmin("js/sweet.js") ?>"></script>
<?php $v->end(); ?>
