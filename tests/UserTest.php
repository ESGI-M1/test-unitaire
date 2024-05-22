<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    const VALID_AGE = 18;
    const INVALID_AGE = 12;
    const VALID_PASSWORD = "Password1";
    const INVALID_PASSWORD = "short1";
    const VALID_EMAIL = "test@example.com";
    const INVALID_EMAIL = "invalid-email";

    public function testUserIsValid() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
        $this->assertTrue($user->isValid());
    }

    public function testUserInvalidEmail() {
        $user = new User(
            self::INVALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserEmptyEmail() {
        $user = new User(
            "",
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserEmptyLastName() {
        $user = new User(
            self::VALID_EMAIL,
            "",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserEmptyFirstName() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserUnderage() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::INVALID_AGE . " years"),
            self::VALID_PASSWORD
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserExactly13YearsOld() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-13 years"),
            self::VALID_PASSWORD
        );
        $this->assertTrue($user->isValid());
    }

    public function testUserInvalidPassword() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD
        );
        $this->assertFalse($user->isValid());
    }
}
?>
