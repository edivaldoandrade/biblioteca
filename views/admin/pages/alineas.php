<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>
<?php $v->end(); ?>

    <div>
        <h3>Alínea B) Lista dos materiais solicitados pelo autor e título</h3>

        <?php if (!empty($materiais)): ?>
            <table>
                <thead>
                <tr>
                    <th>Autor</th>
                    <th>Titulo</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($materiais as $material): ?>
                    <?php if ($material->contagemMaterialSolicitado()): ?>
                        <tr style="background-color: #dcdcdc;">
                            <td><?= $material->autor ?></td>
                            <td><?= $material->titulo ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <span>Não existem pedidos no sistema...</span>
        <?php endif; ?>
    </div>

    <div>
        <h3>Alínea C) Lista todos os pedidos de revistas com o nome do cliente e o endereço e título do material em
            particular.
        </h3>

        <?php if (!empty($revistas)): ?>
            <table>
                <thead>
                <tr>
                    <th>Autor</th>
                    <th>Titulo</th>
                    <th>Frequência de publicação</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($revistas as $revista): ?>
                    <tr style="background-color: #dcdcdc;">
                        <td><?= $revista->material()->autor ?></td>
                        <td><?= $revista->material()->titulo ?></td>
                        <td><?= $revista->material()->tipoMaterial()->frequenciaPublicacao()->frequencia; ?></td>
                        <td><a href="<?= $router->route("admin.alineaC", ["id" => $revista->id]); ?>">Listar pedidos</a></ah></td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <span>Não existem pedidos no sistema...</span>
        <?php endif; ?>
    </div>


<?php $v->start("scripts") ?>
<?php $v->end(); ?>