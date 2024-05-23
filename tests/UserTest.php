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

    public function testUserNegativeAge() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::INVALID_AGE_NEGATIVE . " years"),
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

    public function testUserValidPassword() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::VALID_PASSWORD
        );
        $this->assertTrue($user->isValid());
    }

    public function testUserPasswordNoNumber() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_NO_NUMBER
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserPasswordNoLetter() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_NO_LETTER
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserPasswordNoUppercase() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_NO_UPPERCASE
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserPasswordNoLowercase() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_NO_LOWERCASE
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserPasswordTooShort() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_TOO_SHORT
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserPasswordTooLong() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            self::INVALID_PASSWORD_TOO_LONG
        );
        $this->assertFalse($user->isValid());
    }

    public function testUserEmptyPassword() {
        $user = new User(
            self::VALID_EMAIL,
            "Doe",
            "John",
            new DateTime("-" . self::VALID_AGE . " years"),
            ""
        );
        $this->assertFalse($user->isValid());
    }
}
?>
