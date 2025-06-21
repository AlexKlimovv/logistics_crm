<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../repositories/CounterpartyRepository.php';

$repo = new CounterpartyRepository($pdo);
$counterparties = $repo->getAllCounterparty();

ob_start();
require_once __DIR__ . '/../views/counterparties_list.php';
$content = ob_get_clean();

require_once __DIR__ . '/../views/layout.php';