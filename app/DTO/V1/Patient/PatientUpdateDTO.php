<?php

namespace App\DTO\V1\Patient;

use App\DTO\BaseDto;

class PatientUpdateDTO extends BaseDto
{
    public int $id;
    public ?string $name = null;
    public ?string $address = null;
    public string $phone_number;
    public object|string|null $document_image = null;

    /**
     * @param int $id
     * @param array $attributes
     */
    public function __construct(int $id, array $attributes = [])
    {
        $this->id = $id;
        parent::__construct($attributes);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    public function getDocumentImage(): object|string|null
    {
        return $this->document_image;
    }

    public function setDocumentImage(object|string|null $document_image): void
    {
        $this->document_image = $document_image;
    }


}
