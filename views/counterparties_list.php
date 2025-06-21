<?php if (empty($counterparties)): ?>
    <p>Нет контрагентов</p>
    <?php else: ?>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Контрагент</th>
            <th>Форма собсвенности</th>
            <th>ЕДРПОУ</th>
            <th>ИНН</th>
            <th>Св-во налог-ка</th>
            <th>Город</th>
            <th>Адрес</th>
            <th>Индекс</th>
            <th>Город</th>
            <th>Адрес</th>
            <th>Индекс</th>
            <th>Контакт</th>
            <th>Телефон</th>
            <th>Наша компания</th>
            <th>Черный список</th>
            <th>Ответственный</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($counterparties as $counterparty): ?>
        <tr>
            <td><?= htmlspecialchars($counterparty->name) ?></td>
            <td><?= htmlspecialchars($counterparty->companyType) ?></td>
            <td><?= htmlspecialchars($counterparty->edrpou) ?></td>
            <td><?= htmlspecialchars($counterparty->inn) ?></td>
            <td><?= htmlspecialchars($counterparty->taxCertificateNumber) ?></td>
            <td><?= htmlspecialchars($counterparty->legalCityName ?? '') ?></td>
            <td><?= htmlspecialchars($counterparty->legalStreet) ?></td>
            <td><?= htmlspecialchars($counterparty->legalIndex) ?></td>
            <td><?= htmlspecialchars($counterparty->postalCityName ?? '') ?></td>
            <td><?= htmlspecialchars($counterparty->postalStreet) ?></td>
            <td><?= htmlspecialchars($counterparty->postalIndex) ?></td>
            <td><?= htmlspecialchars($counterparty->contactPersonId) ?></td>
            <td><?= htmlspecialchars(implode(', ',$counterparty->phones)) ?></td>
            <td><?= $counterparty->isOurCompany ? 'Да' : 'Нет' ?></td>
            <td><?= $counterparty->isBlackListed ? '❗' : '' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
<a href="/PhpstormProjects/logistics_crm/views/counterparty_form.php">Добавить контрагента</a>

