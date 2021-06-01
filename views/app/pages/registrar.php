<?php $v->layout("app/pages/_tema"); ?>

<?php $v->start("links") ?>

<?php $v->end(); ?>

<section>
    <h2>
        Registrar
    </h2>
</section>

<section>
    <div>
        <h3>Crie uma conta agora!</h3>
        <div class="login_form_callback">
            <?= flash(); ?>
        </div>
        <form class="form" action="<?= $router->route("autenticacao.registrar"); ?>" method="post">
            <legend>&nbsp; Informação pessoal</legend>
            <div>
                <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,100}" type="text" name="nome" required
                       placeholder="Nome completo *">
            </div>
            <div>
                <input pattern="[A-Z0-9]{1,14}" type="text" name="bi" required placeholder="Bilhete de Identidade *">
            </div>
            <div>
                <input type="text" name="endereco" required placeholder="Endereço *">
            </div>

            <legend>Dados da conta</legend>
            <div>
                <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,100}" type="text" name="nome_usuario" required maxlength="100"
                       placeholder="Digite seu nome de usuário *">
            </div>
            <div>
                <input type="password" name="senha" required maxlength="100" placeholder="Crie uma senha *">
            </div>
            <div>
                <input type="password" name="confirmar_senha" required maxlength="100" placeholder="Redigite a senha *">
            </div>
            <div>
                <button type="submit" value="submit">
                    Registrar
                </button>
                <a href="<?= $router->route("app.entrar"); ?>">Eu já tenho uma conta!</a>
            </div>
        </form>
    </div>
</section>

<?php $v->start("scripts") ?>
<script src="<?= asset("js/jquery-ui.min.js"); ?>"></script>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end(); ?>
