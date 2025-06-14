<?php
require_once __DIR__ .'/config/init.php';

echo "Hi, ".$_SESSION['username'];
?>
<form method="POST" action="controllers/logout_controller.php">
    <input type="submit" value="EXIT">
</form>