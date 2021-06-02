<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>
    <link rel="stylesheet" href="<?= assetAdmin("css/sweetalert2.css"); ?>">
<?php $v->end(); ?>

    <section>
        <h1>Editar Material</h1>
    </section>

    <section>
        <div>
            <h3><?= $material->titulo ?></h3>
            <form class="ajaxForm" action="<?= $router->route("material.actualizar"); ?>" method="post"
                  data-form="actualizar">
                <input type="hidden" name="id" value="<?= $material->id; ?>">
                <div>
                    <input type="text" name="titulo" required placeholder="Título *" value="<?= $material->titulo; ?>">
                </div>
                <div>
                    <input type="text" name="autor" required placeholder="Autor *" value="<?= $material->autor; ?>">
                </div>
                <div>
                    <input type="number" name="ano_publicacao" required placeholder="Ano da publicação *"
                           value="<?= $material->ano_publicacao; ?>">
                </div>
                <div>
                    <input type="number" name="ano_chegada" required placeholder="Ano de chegada na biblioteca *"
                           value="<?= $material->ano_chegada; ?>">
                </div>
                <div>
                    <input type="text" name="editoral" required placeholder="Editora *"
                           value="<?= $material->editorial; ?>">
                </div>
                <div>
                    <input type="number" name="quantidade" required placeholder="Quantidade *"
                           value="<?= $material->quantidade; ?>">
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