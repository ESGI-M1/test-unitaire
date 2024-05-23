<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    private const VALID_AGE = 18;
    private const INVALID_AGE = 12;
    private const INVALID_AGE_NEGATIVE = -1;
    private const VALID_PASSWORD = "Password1";
    private const INVALID_PASSWORD_NO_NUMBER = "Password";
    private const INVALID_PASSWORD_NO_LETTER = "123456";
    private const INVALID_PASSWORD_NO_UPPERCASE = "password1";
    private const INVALID_PASSWORD_NO_LOWERCASE = "PASSWORD1";
    private const INVALID_PASSWORD_TOO_SHORT = "Pass1";
    private const INVALID_PASSWORD_TOO_LONG = "PasswordPasswordPasswordPasswordPasswordPasswordPassword1";
    private const VALID_EMAIL = "test@example.com";
    private const INVALID_EMAIL = "invalid-email";

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
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid email");

        new User(
            self::INVALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testUserEmptyEmail() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid email");

        new User(
            "",
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testUserEmptyLastName() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("First name or last name cannot be empty");

        new User(
            self::VALID_EMAIL,
            "",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testUserEmptyFirstName() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("First name or last name cannot be empty");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testUserUnderage() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("User must be at least 13 years old");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::INVALID_AGE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testUserNegativeAge() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("User must be at least 13 years old");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::INVALID_AGE_NEGATIVE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testUserPasswordNoNumber() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid password");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_NO_NUMBER
        );
    }

    public function testUserPasswordNoLetter() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid password");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_NO_LETTER
        );
    }

    public function testUserPasswordNoUppercase() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid password");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_NO_UPPERCASE
        );
    }

    public function testUserPasswordNoLowercase() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid password");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_NO_LOWERCASE
        );
    }

    public function testUserPasswordTooShort() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid password");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_TOO_SHORT
        );
    }

    public function testUserPasswordTooLong() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid password");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_TOO_LONG
        );
    }

    public function testUserEmptyPassword() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid password");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            ""
        );
    }

    public function testGetters() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );

        $this->assertEquals(self::VALID_EMAIL, $user->getEmail());
        $this->assertEquals("Doe", $user->getLastName());
        $this->assertEquals("John", $user->getFirstName());
        $this->assertEquals(
            (new DateTime("-" . self::VALID_AGE . " years"))->format('Y-m-d'), 
            $user->getBirthDate()->format('Y-m-d')
        );
    }

    public function testConstructorInvalidEmail() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid email");

        new User(
            self::INVALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testConstructorEmptyFirstName() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("First name or last name cannot be empty");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testConstructorEmptyLastName() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("First name or last name cannot be empty");

        new User(
            self::VALID_EMAIL,
            "",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testConstructorUnderage() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("User must be at least 13 years old");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::INVALID_AGE . " years"),
            self::VALID_PASSWORD
        );
    }

    public function testConstructorInvalidPassword() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid password");

        new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_TOO_SHORT
        );
    }
}
