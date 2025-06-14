<?php
require_once __DIR__ . '/../config/init.php';

session_unset();
session_destroy();

header('Location: ../views/login.php');
exit;
