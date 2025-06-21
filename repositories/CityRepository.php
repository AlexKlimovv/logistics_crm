<?php

class CityRepository
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByNamePart(string $part) : array
    {
        $sql = "SELECT * FROM cities WHERE name LIKE :part LIMIT 40";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'part' => '%' .$part. '%'
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}