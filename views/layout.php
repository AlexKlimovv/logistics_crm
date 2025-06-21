<?php require_once __DIR__ . '/../config/init.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_SESSION['username']; ?></title>
</head>
<body>
    <div class="navbar">
        <a href="#">Контрагенты</a>
        <a href="#">Договора</a>
        <a href="#">Контакты</a>
        <a href="#">Транспорт</a>
        <a href="#">Проекты</a>
        <a href="#">Справочник</a>
        <form method="POST" action="/PhpstormProjects/logistics_crm/controllers/logout_controller.php">
        <input type="submit" value="EXIT">
        </form>
    </div>
    <div>
        <?= $content; ?>
    </div>
</body>
</html>