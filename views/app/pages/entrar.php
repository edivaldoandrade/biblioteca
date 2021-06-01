<?php $v->layout("app/pages/_tema"); ?>

<?php $v->start("links") ?>

<?php $v->end(); ?>

<section>
    <h1>Entrar</h1>
</section>

<section>
    <div>
        <h3>Bem-vindo de Volta!</h3>
        <div class="login_form_callback">
            <?= flash(); ?>
        </div>
        <form class="form" action="<?= $router->route("autenticacao.entrar"); ?>" method="post">
            <legend>&nbsp; Informação pessoal</legend>
            <div>
                <input type="text" name="nome_usuario" placeholder="Usuário">
            </div>
            <div>
                <input type="password" name="senha" placeholder="Senha *">
            </div>
            <div>
                <button type="submit" value="submit">
                    Entrar
                </button>
                <a href="<?= $router->route("app.registrar"); ?>">Ainda não tem uma conta?</a>
            </div>
        </form>
    </div>
</section>


<?php $v->start("scripts") ?>
<script src="<?= asset("js/jquery-ui.min.js"); ?>"></script>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end(); ?>
