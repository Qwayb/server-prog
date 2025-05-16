<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main site</title>
    <link rel="stylesheet" href="../../public/css/main.css">
</head>
<body>
<?php if (app()->auth::check()): ?>
    <header>
        <div class="container">
            <nav>
                <a href="<?= app()->route->getUrl('/') ?>">Главная</a>
                <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= htmlspecialchars(app()->auth::user()->login) ?>)</a>
            </nav>
        </div>
    </header>
<?php endif; ?>
<main>
    <div class="container">
        <?= $content ?? '' ?>
    </div>
</main>

</body>
</html>
