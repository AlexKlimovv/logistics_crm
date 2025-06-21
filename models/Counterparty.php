<?php

namespace models;

class Counterparty
{
    public ?int $id; // может быть null при создании нового
    public string $name;
    public string $companyType;
    public int $edrpou;
    public int $inn;
    public string $taxCertificateNumber;

    public int $legalCityId;
    public string $legalStreet;
    public string $legalIndex;

    public int $postalCityId;
    public string $postalStreet;
    public string $postalIndex;

    public int $contactPersonId;
    public array $phones;

    public bool $isOurCompany;
    public bool $isBlackListed;
    public int $createdByUser;

    public function __construct(
        ?int $id,
        string $name,
        string $companyType,
        int $edrpou,
        int $inn,
        string $taxCertificateNumber,
        string $legalCityId,
        string $legalStreet,
        string $legalIndex,
        string $postalCityId,
        string $postalStreet,
        string $postalIndex,
        int $contactPersonId,
        array $phones,
        bool $isOurCompany,
        bool $isBlackListed,
        int $createdByUser
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->companyType = $companyType;
        $this->edrpou = $edrpou;
        $this->inn = $inn;
        $this->taxCertificateNumber = $taxCertificateNumber;

        $this->legalCityId = $legalCityId;
        $this->legalStreet = $legalStreet;
        $this->legalIndex = $legalIndex;

        $this->postalCityId = $postalCityId;
        $this->postalStreet = $postalStreet;
        $this->postalIndex = $postalIndex;

        $this->contactPersonId = $contactPersonId;
        $this->phones = $phones;

        $this->isOurCompany = (int) $isOurCompany;
        $this->isBlackListed = (int) $isBlackListed;
        $this->createdByUser = $createdByUser;
    }

    public string $legalCityName = '';
    public string $postalCityName = '';
}
