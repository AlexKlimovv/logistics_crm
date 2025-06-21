<?php
file_put_contents(__DIR__.'/../log.txt', 'SQL выполнен'.PHP_EOL, FILE_APPEND);

require_once __DIR__ . '/../models/Counterparty.php';
use models\Counterparty;
class CounterpartyRepository
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function addCounterparty(Counterparty $counterparty): bool
    {
        $stmt = $this->pdo->prepare("SELECT id FROM counterparties WHERE edrpou = :edrpou OR inn = :inn LIMIT 1");
        $stmt->execute([
            'edrpou' => $counterparty->edrpou,
            'inn' => $counterparty->inn
        ]);
        if ($stmt->fetch()) {
            throw new Exception('Контрагент с таким ЕДРПОУ или ИНН уже существует');
        }

        $sql = "INSERT INTO counterparties (name, company_type, edrpou, inn, tax_certificate_number, legal_city_id, 
                            legal_street, legal_index, postal_city_id, postal_street, postal_index, contact_person_id, 
                            phones, is_our_company, is_blacklisted, created_by_user_id) 
                VALUES (:name, :company_type, :edrpou, :inn, :tax_certificate_number, :legal_city_id, 
                            :legal_street, :legal_index, :postal_city_id, :postal_street, :postal_index, :contact_person_id, 
                            :phones, :is_our_company, :is_blacklisted, :created_by_user_id)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'name' => $counterparty->name,
            'company_type' => $counterparty->companyType,
            'edrpou' => $counterparty->edrpou,
            'inn' => $counterparty->inn,
            'tax_certificate_number' => $counterparty->taxCertificateNumber,
            'legal_city_id' => $counterparty->legalCityId,
            'legal_street' => $counterparty->legalStreet,
            'legal_index' => $counterparty->legalIndex,
            'postal_city_id' => $counterparty->postalCityId,
            'postal_street' => $counterparty->postalStreet,
            'postal_index' => $counterparty->postalIndex,
            'contact_person_id' => $counterparty->contactPersonId,
            'phones' => json_encode($counterparty->phones),
            'is_our_company' => (int)$counterparty->isOurCompany,
            'is_blacklisted' => (int)$counterparty->isBlackListed,
            'created_by_user_id' => $counterparty->createdByUser
            ]);
    }

    public function getAllCounterparty() :array
    {
        $stmt = $this->pdo->query("SELECT * FROM counterparties");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $counterparties = [];

        $cityIds = [];

        foreach ($rows as $row) {
            if (!empty($row['legal_city_id'])) {
                $cityIds[] = $row['legal_city_id'];
            }
            if (!empty($row['postal_city_id'])) {
                $cityIds[] = $row['postal_city_id'];
            }
        }
        $cityIds = array_unique($cityIds);

        $cityNames = [];
        if (empty($cityIds)) {
            $cityNames = [];
        } else {
            $in = implode(',', array_fill(0, count($cityIds), '?'));
            $stmtCities = $this->pdo->prepare("SELECT id, name FROM cities WHERE id IN ($in)");
            $stmtCities->execute(array_values($cityIds)); // <-- array_values на всякий случай
            $cities = $stmtCities->fetchAll(PDO::FETCH_ASSOC);

            foreach ($cities as $city) {
                $cityNames[$city['id']] = $city['name'];
            }
        }

        foreach ($rows as $row) {
            $phones = json_decode($row['phones'], true);
            $counterparty = new Counterparty(
                (int)$row['id'],
                $row['name'],
                $row['company_type'],
                $row['edrpou'],
                $row['inn'],
                $row['tax_certificate_number'],
                $row['legal_city_id'],
                $row['legal_street'],
                $row['legal_index'],
                $row['postal_city_id'],
                $row['postal_street'],
                $row['postal_index'],
                $row['contact_person_id'],
                $phones,
                (int)$row['is_our_company'],
                (int)$row['is_blacklisted'],
                $row['created_by_user_id']
            );
            $counterparty->legalCityName = $cityNames[$row['legal_city_id']] ?? '';
            $counterparty->postalCityName = $cityNames[$row['postal_city_id']] ?? '';

            $counterparties[] = $counterparty;
        }
        return $counterparties;
    }
}