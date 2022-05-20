<?php

namespace App\Module\Survey;

class Survey
{
    private ?string $firstName;
    private ?string $lastName;
    private ?string $email;
    private ?string $age;


    public function __construct(?string $email = null, ?string $firstName = null, ?string $lastName = null, ?string $age = null) 
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    public function getAge(): ?string
    {
        return $this->age;
    }
}