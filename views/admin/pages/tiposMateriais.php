<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>

<?php $v->end(); ?>

<section>
    <h1><?= $title ?></h1>
</section>

<div>
    <h3>Registrados</h3>

    <?php if (!empty($lista)): ?>
        <table>
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Ano de Publicação</th>
                <th>Ano de Chegada</th>
                <th>Editora</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <?php if ($title === "Atas"): echo "<th>Congresso</th>"; endif; ?>
                <?php if ($title === "Livros"): echo "<th>Gênero</th>"; endif; ?>
                <?php if ($title === "Revistas"): echo "<th>Frequência de publicação</th>"; endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lista as $item): ?>
                <tr style="background-color: #dcdcdc;">
                    <td><?= $item->material()->titulo ?></td>
                    <td><?= $item->material()->autor ?></td>
                    <td><?= $item->material()->ano_publicacao ?></td>
                    <td><?= $item->material()->ano_chegada ?></td>
                    <td><?= $item->material()->editorial ?></td>
                    <td><?= $item->material()->quantidade ?></td>
                    <td><?= number_format($item->material()->preco, 2, ",", " ") ?></td>
                    <td>
                        <?php if ($title === "Atas"): echo $item->material()->tipoMaterial()->nome_congresso; endif; ?>
                        <?php if ($title === "Livros"): echo $item->material()->tipoMaterial()->genero()->nome; endif; ?>
                        <?php if ($title === "Revistas"): echo $item->material()->tipoMaterial()->frequenciaPublicacao()->frequencia; endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot><?php echo $paginator->render(); ?></tfoot>
        </table>
    <?php else: ?>
        <span>Não existem materiais no sistema...</span>
    <?php endif; ?>
</div>

<?php $v->start("scripts") ?>
<?php $v->end(); ?>
