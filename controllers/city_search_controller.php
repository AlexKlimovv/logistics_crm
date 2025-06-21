<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../repositories/CityRepository.php';

header('Content-Type: application/json');

if (!isset($_GET['q']) || trim($_GET['q']) === ''){
    echo json_encode([]);
    exit;
}

$q = trim($_GET['q']);
$repo = new CityRepository($pdo);
$cities = $repo->findByNamePart($q);

echo json_encode($cities);