<?php

use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase {
    private const VALID_LENGTH = 1000;
    private const INVALID_LENGTH = 1001;
    private const VALID_NAME = "Item";

    private static function VALID_CREATION_DATE(): DateTime {
        return new DateTime("-1 day");
    }

    private static function INVALID_CREATION_DATE(): DateTime {
        return new DateTime("+1 day");
    }

    public function testItemIsValid() {
        $item = new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH),
            self::VALID_CREATION_DATE()
        );
        $this->assertTrue($item->isValid());
    }

    public function testItemEmptyName() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Name or content cannot be empty");

        new Item(
            "",
            str_repeat("a", self::VALID_LENGTH),
            self::VALID_CREATION_DATE()
        );
    }

    public function testItemValidContent() {
        $item = new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH),
            self::VALID_CREATION_DATE()
        );
        $this->assertTrue($item->isValid());
    }

    public function testItemInvalidContent() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Content exceeds 1000 characters");

        new Item(
            self::VALID_NAME,
            str_repeat("a", self::INVALID_LENGTH),
            self::VALID_CREATION_DATE()
        );
    }

    public function testItemEmptyContent() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Name or content cannot be empty");

        new Item(
            self::VALID_NAME,
            "",
            self::VALID_CREATION_DATE()
        );
    }

    public function testItemInvalidCreationDate() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Creation date cannot be in the future");

        new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH),
            self::INVALID_CREATION_DATE()
        );
    }

    public function testItemEmptyCreationDate() {
        $item = new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH)
        );
        $this->assertTrue($item->isValid());
    }

    public function testItemValidCreationDate() {
        $item = new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH),
            self::VALID_CREATION_DATE()
        );
        $this->assertTrue($item->isValid());
    }

    public function testItemDefaultCreationDate() {
        $item = new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH)
        );
        $now = new DateTime();
        $this->assertEquals($now->format('Y-m-d'), $item->getCreationDate()->format('Y-m-d'));
    }

    public function testGetters() {
        $item = new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH),
            self::VALID_CREATION_DATE()
        );

        $this->assertEquals(self::VALID_NAME, $item->getName());
        $this->assertEquals(str_repeat("a", self::VALID_LENGTH), $item->getContent());
        $this->assertEquals(self::VALID_CREATION_DATE()->format('Y-m-d'), $item->getCreationDate()->format('Y-m-d'));
    }

    public function testSetName() {
        $item = new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH),
            self::VALID_CREATION_DATE()
        );

        $newName = "NewItem";
        $item->setName($newName);
        $this->assertEquals($newName, $item->getName());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Name cannot be empty");
        $item->setName("");
    }

    public function testSetContent() {
        $item = new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH),
            self::VALID_CREATION_DATE()
        );

        $newContent = str_repeat("b", self::VALID_LENGTH);
        $item->setContent($newContent);
        $this->assertEquals($newContent, $item->getContent());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Content exceeds 1000 characters");
        $item->setContent(str_repeat("b", self::INVALID_LENGTH));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Content cannot be empty");
        $item->setContent("");
    }

    public function testSetCreationDate() {
        $item = new Item(
            self::VALID_NAME,
            str_repeat("a", self::VALID_LENGTH),
            self::VALID_CREATION_DATE()
        );

        $newDate = new DateTime("-2 days");
        $item->setCreationDate($newDate);
        $this->assertEquals($newDate->format('Y-m-d'), $item->getCreationDate()->format('Y-m-d'));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Creation date cannot be in the future");
        $item->setCreationDate(self::INVALID_CREATION_DATE());
    }
}

