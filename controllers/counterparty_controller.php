<?php
file_put_contents(__DIR__.'/../log.txt', 'Контроллер вызван'.PHP_EOL, FILE_APPEND);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../models/Counterparty.php';
require_once __DIR__ . '/../repositories/CounterpartyRepository.php';

use models\Counterparty;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /counterparties_controller.php');
    exit;
}

$name = $_POST['name'] ?? '';
$companyType = $_POST['company_type'] ?? '';
$edrpou = $_POST['edrpou'] ?? '';
$inn = $_POST['inn'] ?? '';
$taxCertificateNumber = $_POST['tax_certificate_number'] ?? '';

$legalCityId = isset($_POST['legal_city_id']) ? (int) $_POST['legal_city_id'] : 0;
$legalStreet = $_POST['legal_street'] ?? '';
$legalIndex = $_POST['legal_index'] ?? '';

$postalCityId = isset($_POST['postal_city_id']) ? (int) $_POST['postal_city_id'] : 0;
$postalStreet = $_POST['postal_street'] ?? '';
$postalIndex = $_POST['postal_index'] ?? '';

$contactPersonId = isset($_POST['contact_person_id']) ? (int) $_POST['contact_person_id'] : 0;
$phones = $_POST['phones'] ?? [];

$isOurCompany =  isset($_POST['is_our_company']) ? 1 : 0;
$isBlackListed = isset($_POST['is_blacklisted']) ? 1 : 0;

$createdByUser = $_SESSION['user_id'] ?? '';

$counterparty = new Counterparty(
  0,
    $name,
    $companyType,
    $edrpou,
    $inn,
    $taxCertificateNumber,
    $legalCityId,
    $legalStreet,
    $legalIndex,
    $postalCityId,
    $postalStreet,
    $postalIndex,
    $contactPersonId,
    $phones,
    $isOurCompany,
    $isBlackListed,
    $createdByUser
);

$repo = new CounterpartyRepository($pdo);

try {
    $repo->addCounterparty($counterparty);
    header('Location: /PhpstormProjects/logistics_crm/controllers/counterparties_controller.php');
    exit;
} catch (Exception $e) {
    file_put_contents(__DIR__.'/../log.txt', 'Ошибка: '.$e->getMessage().PHP_EOL, FILE_APPEND);
    $_SESSION['error'] = 'Ошибка при добавлении: ' . $e->getMessage();
    header('Location: /PhpstormProjects/logistics_crm/views/counterparty_form.php');
    exit;
}