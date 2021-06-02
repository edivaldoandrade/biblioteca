<?php $v->layout("admin/pages/_tema"); ?>

<?php $v->start("links") ?>

<?php $v->end(); ?>

<section>
    <h1>Dashboard</h1>
</section>

<div>
    <div>
        <h3>Últimos Usuários Registrados</h3>

        <?php if (!empty($usuarios)): ?>
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
                <?php foreach ($usuarios as $usuario): ?>
                    <tr style="background-color: #dcdcdc;">
                        <td><?= $usuario->usuario()->nome ?></td>
                        <td><?= $usuario->nome ?></td>
                        <td><?= $usuario->bi ?></td>
                        <td><?= $usuario->endereco ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <span>Não existem usuários no Sistema...</span>
        <?php endif; ?>
    </div>

    <div>
        <h3>Últimos Materiais Registrados</h3>

        <?php if (!empty($materiais)): ?>
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
                    <?php foreach ($materiais as $material): ?>
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
            </table>
        <?php else: ?>
            <span>Não existem materiais no sistema...</span>
        <?php endif; ?>
    </div>

    <div>
        <h3>Últimos Pedidos Registrados</h3>

        <?php if (!empty($pedidos)): ?>
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
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr style="background-color: #dcdcdc;">
                            <td><?= $pedido->material()->titulo ?></td>
                            <td><?= $pedido->material()->preco ?></td>
                            <td><?= $pedido->associado()->nome ?></td>
                            <td><?= strftime('%d/%m/%Y, %T', strtotime($pedido->created_at)) ?></td>
                            <td><?= $pedido->estado ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <span>Não existem pedidos no sistema...</span>
        <?php endif; ?>
    </div>

    <div>
        <h3>Últimos Emprestimos Registrados</h3>

        <?php if (!empty($emprestimos)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Usuário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emprestimos as $emprestimo): ?>
                        <tr style="background-color: #dcdcdc;">
                            <td><?= $emprestimo->pedido()->material()->titulo ?></td>
                            <td><?= $emprestimo->pedido()->associado()->nome ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <span>Não existem emprestimos no sistema...</span>
        <?php endif; ?>
    </div>
</div>

<?php $v->start("scripts") ?>

<?php $v->end(); ?>
