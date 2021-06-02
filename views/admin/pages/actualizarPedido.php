<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>
    <link rel="stylesheet" href="<?= assetAdmin("css/sweetalert2.css"); ?>">
<?php $v->end(); ?>

    <section>
        <h1>Pedido</h1>
    </section>

    <section>
        <div>
            <h3><?= $pedido->id ?></h3>
            <form class="ajaxForm" action="<?= $router->route("pedido.actualizar"); ?>" method="post"
                  data-form="actualizar">
                <input type="hidden" name="id" value="<?= $pedido->id; ?>">
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
                    <tr style="background-color: #dcdcdc;">
                        <td><?= $pedido->material()->titulo ?></td>
                        <td><?= $pedido->material()->preco ?></td>
                        <td><?= $pedido->associado()->nome ?></td>
                        <td><?= strftime('%d/%m/%Y, %T', strtotime($pedido->created_at)) ?></td>
                        <td><?= $pedido->estado ?></td>
                    </tr>
                    </tbody>
                </table>
                <div>
                    <label>Título</label>
                    <input disabled value="<?= $pedido->material->titulo; ?>">
                </div>
                <div>
                    <label>Preço</label>
                    <input disabled value="<?= $pedido->material->preco; ?>">
                </div>
                <div>
                    <label>Usuário</label>
                    <input disabled value="<?= $pedido->associado()->nome; ?>">
                </div>
                <div>
                    <label>Data do pedido</label>
                    <input disabled value="<?= strftime('%d/%m/%Y, %T', strtotime($pedido->created_at)); ?>">
                </div>
                <div>
                    <label>Estado</label>
                    <select name="estado">
                        <option value="Em processamento" <?php if ($pedido->estado === "Em processamento"): echo "selected"; endif; ?>>
                            Em processamento
                        </option>
                        <option value="Rejeitado" <?php if ($pedido->estado === "Rejeitado"): echo "selected"; endif; ?>>
                            Rejeitado
                        </option>
                        <option value="Confirmado" <?php if ($pedido->estado === "Confirmado"): echo "selected"; endif; ?>>
                            Confirmado
                        </option>
                        <option value="Entregue" <?php if ($pedido->estado === "Entregue"): echo "selected"; endif; ?>>
                            Entregue
                        </option>
                    </select>
                </div>
                <div>
                    <button type="submit" value="submit">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </section>

<?php $v->start("scripts") ?>
    <script src="<?= assetAdmin("js/sweetalert2.min.js") ?>"></script>
    <script src="<?= assetAdmin("js/sweet.js") ?>"></script>
<?php $v->end(); ?>