<?php

namespace App\DTO\V1\Patient;

use App\DTO\BaseDto;

class PatientStoreDTO extends BaseDto
{
    public string $name;
    public string $email;
    public string $address;
    public string $phone_number;
    public object|string $document_image;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return mixed
     */
    public function getDocumentImage()
    {
        return $this->document_image;
    }

    /**
     * @param mixed $document_image
     */
    public function setDocumentImage($document_image): void
    {
        $this->document_image = $document_image;
    }


}
