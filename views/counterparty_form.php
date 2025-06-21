<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить контрагента</title>
</head>
<body>
<?php require_once __DIR__ . '/../config/init.php'; ?>

<?php
$error = $_SESSION['error'] ?? '';
unset ($_SESSION['error']);
?>

<?php if ($error): ?>
    <div style="color: red; margin-bottom: 10px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<form method="post" action="../controllers/counterparty_controller.php">
    <label>Наименование
        <input name="name">
    </label>

    <label>Форма собственности
        <select name="company_type">
            <option value="ТОВ">ТОВ</option>
            <option value="ФОП">ФОП</option>
            <option value="ПП">ПП</option>
            <option value="ФХ">ФХ</option>
        </select>
    </label><br>

    <label>ЕДРПОУ
        <input type="text" name="edrpou">
    </label>
    <label>ИНН
        <input type="text" name="inn">
    </label>
    <label>Св-во налогоплательщика
        <input type="text" name="tax_certificate_number">
    </label><br>

    <label>Юридический адрес:
        <div style="position: relative">
            <label>Город:
                <input type="text" id="legal_city" name="legal_city" autocomplete="off">
                <input type="hidden" id="legal_city_id" name="legal_city_id">
                <div id="city_suggestions" class="autocomplete-box"></div>
            </label>
        </div>
    </label>
    <label>Улица:
        <input type="text" name="legal_street">
    </label>
    <label>Индекс:
        <input type="text" name="legal_index">
    </label><br>

    <label>Почтовый адрес:
        <div style="position: relative">
            <label>Город:
                <input type="text" id="postal_city" name="postal_city" autocomplete="off">
                <input type="hidden" id="postal_city_id" name="postal_city_id">
                <div id="postal_city_suggestions" class="autocomplete-box"></div>
            </label>
        </div>
    </label>
    <label>Улица:
        <input type="text" name="postal_street">
    </label>
    <label>Индекс:
        <input type="text" name="postal_index">
    </label><br>

    <label>Контактное лицо
        <input type="text" name="contact_person_id">
    </label><br>

    <label>Связь
        <input type="text" name="phones[]">
    </label><br>

    <label>Наша Компания
        <input type="checkbox" name="is_our_company" value="1">
    </label>
    <label>Черный список
        <input type="checkbox" name="is_blacklisted" value="1">
    </label><br>

    <input type="submit" value="OK">
    <input type="button" value="Отмена" onclick="history.back()">
</form>
<link rel="stylesheet" href="/PhpstormProjects/logistics_crm/style/style.css">
<script src="../public/js/city_autocomplete.js"></script>
</body>
</html>