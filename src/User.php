<?php

class User {

    private string $email;
    private string $lastName;
    private string $firstName;
    private DateTime $birthDate;
    // Constante pour l'age minimum

    public function __construct(string $email, string $lastName, string $firstName, DateTime $birthDate) {
        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthDate = $birthDate;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getBirthDate(): DateTime {
        return $this->birthDate;
    }

    public function isValid(): bool {

        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (empty($this->lastName) || empty($this->firstName)) {
            return false;
        }

        $now = new DateTime();
        $age = $now->diff($this->birthDate)->y;
        if ($age < 13) {
            return false;
        }
        return true;
    }
}
