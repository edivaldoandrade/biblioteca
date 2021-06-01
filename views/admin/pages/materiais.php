<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>

<?php $v->end(); ?>

<section>
    <h1>Materiais</h1>
</section>

<div>
    <h3>Materiais Cadastrados</h3>

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
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lista as $materiais): ?>
                <tr style="background-color: #dcdcdc;">
                    <td><?= $material->titulo ?></td>
                    <td><?= $material->autor ?></td>
                    <td><?= $material->ano_publicacao ?></td>
                    <td><?= $material->ano_chegada ?></td>
                    <td><?= $material->editorial ?></td>
                    <td><?= $material->quantidade ?></td>
                    <td><?= number_format($material->preco, 2, ",", " ") ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot><?php echo $paginator->render(); ?></tfoot>
        </table>
    <?php else: ?>
        <span>Não existem materiais no sistema...</span>
    <?php endif; ?>
</div>

<section>
    <div>
        <h3>Registrar Material!</h3>
        <div class="login_form_callback">
            <?= flash(); ?>
        </div>
        <form class="form" action="<?= $router->route("material.registrar"); ?>" method="post">
            <div>
                <input type="text" name="titulo" required placeholder="Título *">
            </div>
            <div>
                <input type="text" name="autor" required placeholder="Autor *">
            </div>
            <div>
                <input type="text" name="ano_publicacao" required placeholder="Ano da publicação *">
            </div>
            <div>
                <input type="text" name="ano_chegada" required placeholder="Ano de chegada na biblioteca *">
            </div>
            <div>
                <input type="text" name="editoral" required placeholder="Editora *">
            </div>
            <div>
                <input type="text" name="quantidade" required placeholder="Quantidade *">
            </div>
            <div>
                <label>Categoria *</label>
                <div>
                    <label>
                        <input type="radio" name="categoria" required value="ata">
                        <span>Ata</span>
                    </label>
                    <label>
                        <input type="radio" name="categoria" required value="livro">
                        <span>Livro</span>
                    </label>
                    <label>
                        <input type="radio" name="categoria" required value="revista">
                        <span>Revista</span>
                    </label>
                </div>
            </div>

            <div>
                <button type="submit" value="submit">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</section>

<?php $v->start("scripts") ?>
<script src="<?= asset("js/jquery-ui.min.js"); ?>"></script>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end(); ?>
