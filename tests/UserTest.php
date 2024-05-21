<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    public function testUserIsValid() {
        $user = new User("test@example.com", "Doe", "John", new DateTime("2000-01-01"), "Password1");
        $this->assertTrue($user->isValid());
    }

    public function testUserInvalidEmail() {
        $user = new User("invalid-email", "Doe", "John", new DateTime("2000-01-01"), "Password1");
        $this->assertFalse($user->isValid());
    }

    public function testUserEmptyEmail() {
        $user = new User("", "Doe", "John", new DateTime("2000-01-01"), "Password1");
        $this->assertFalse($user->isValid());
    }

    public function testUserEmptyLastName() {
        $user = new User("test@example.com", "", "John", new DateTime("2000-01-01"), "Password1");
        $this->assertFalse($user->isValid());
    }

    public function testUserEmptyFirstName() {
        $user = new User("test@example.com", "Doe", "", new DateTime("2000-01-01"), "Password1");
        $this->assertFalse($user->isValid());
    }

    public function testUserUnderage() {
        $user = new User("test@example.com", "Doe", "John", new DateTime("2015-01-01"), "Password1");
        $this->assertFalse($user->isValid());
    }

    public function testUserExactly13YearsOld() {
        $user = new User("test@example.com", "Doe", "John", new DateTime(date('Y-m-d', strtotime('-13 years'))), "Password1");
        $this->assertTrue($user->isValid());
    }

    public function testUserInvalidPassword() {
        $user = new User("test@example.com", "Doe", "John", new DateTime("2000-01-01"), "short1");
        $this->assertFalse($user->isValid());
    }
}
