<?php

class User {

    private string $email;
    private string $lastName;
    private string $firstName;
    private DateTime $birthDate;
    private string $password;

    public function __construct(string $email, string $lastName, string $firstName, DateTime $birthDate, string $password) {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email");
        }

        if (empty($lastName) || empty($firstName)) {
            throw new InvalidArgumentException("First name or last name cannot be empty");
        }

        $now = new DateTime();
        $age = $now->diff($birthDate)->y;
        if ($age < 13) {
            throw new InvalidArgumentException("User must be at least 13 years old");
        }

        $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,40}$/';
        if (!preg_match($passwordRegex, $password)) {
            throw new InvalidArgumentException("Invalid password");
        }

        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthDate = $birthDate;
        $this->password = $password;
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

        $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,40}$/';
        if (!preg_match($passwordRegex, $this->password)) {
            return false;
        }

        return true;
    }
}
