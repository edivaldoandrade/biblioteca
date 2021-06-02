<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>

<?php $v->end(); ?>

<section>
    <h1>Usuários</h1>
</section>

<div>
    <h3>Usuários Registrados</h3>

    <?php if (!empty($lista)): ?>
        <table>
            <thead>
            <tr>
                <th>Usuario</th>
                <th>Nome</th>
                <th>Bilhete de Identidade</th>
                <th>Endereço</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lista as $usuario): ?>
                <tr style="background-color: #dcdcdc;">
                    <td><?= $usuario->usuario()->nome ?></td>
                    <td><?= $usuario->nome ?></td>
                    <td><?= $usuario->bi ?></td>
                    <td><?= $usuario->endereco ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot><?php echo $paginator->render(); ?></tfoot>
        </table>
    <?php else: ?>
        <span>Não existem usuários no Sistema...</span>
    <?php endif; ?>
</div>

<?php $v->start("scripts") ?>

<?php $v->end(); ?>
