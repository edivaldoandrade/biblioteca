<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?= $head; ?>

</head>
<body>

<h1>Ooops, erro <?= $erro; ?></h1>
<p>Desculpe por isso, caso o problema persista, por favor entre em contato connosco.</p>
<p><a href="<?= $router->route("app.home"); ?>">Voltar!</a></p>
</body>
</html>