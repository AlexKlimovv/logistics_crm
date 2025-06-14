<?php
    session_start();
    $error = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);
?>

<?php if ($error): ?>
    <p style="color: red" align="center"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<div align="center">
    <form method="post" action="../controllers/login_controller.php">
        <label>Логин:
            <input type="text" name="username">
        </label><br>
        <label>Пароль:
            <input type="password" name="password">
        </label><br>
        <input type="submit" value="Вход">
    </form>
</div>
