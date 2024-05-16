<?php

namespace App\DTO\V1\Patient;

class PatientUpdateDTO
{
    public int $id;
    public string $name;
    public string $address;
    public string $phone_number;
    public object|string $document_image;

    /**
     * @param int $id
     * @param string $name
     * @param string $address
     * @param string $phone_number
     * @param $document_image
     */
    public function __construct(int $id, string $name, string $address, string $phone_number, $document_image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->phone_number = $phone_number;
        $this->document_image = $document_image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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
