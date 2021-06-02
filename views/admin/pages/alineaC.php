<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>
<?php $v->end(); ?>

<div>
    <h3>Alínea C) Lista todos os pedidos de revistas com o nome do cliente e o endereço e título do material em
        particular.
    </h3>

    <?php if (!empty($lista)): ?>
        <table>
            <thead>
            <tr>
                <th>Nome do cliente</th>
                <th>Endereço do cliente</th>
                <th>Título da revista</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lista as $pedido): ?>
                <tr style="background-color: #dcdcdc;">
                    <td><?= $pedido->associado()->nome ?></td>
                    <td><?= $pedido->associado()->endereco ?></td>
                    <td><?= $pedido->material()->titulo ?></td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <span>Não existem pedidos para esta revista no sistema...</span>
    <?php endif; ?>
</div>


<?php $v->start("scripts") ?>
<?php $v->end(); ?>
