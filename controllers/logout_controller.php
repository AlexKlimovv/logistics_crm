<?php
require_once __DIR__ . '/../config/init.php';

session_unset();
session_destroy();

header('Location: /PhpstormProjects/logistics_crm/views/login.php');
exit;
