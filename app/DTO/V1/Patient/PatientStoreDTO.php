<?php

namespace App\DTO\V1\Patient;

class PatientStoreDTO
{
    public string $name;
    public string $email;
    public string $address;
    public string $phone_number;
    public object|string $document_image;

    /**
     * @param string $name
     * @param string $email
     * @param string $address
     * @param string $phone_number
     * @param $document_image
     */
    public function __construct(string $name, string $email, string $address, string $phone_number, $document_image)
    {
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->phone_number = $phone_number;
        $this->document_image = $document_image;
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
