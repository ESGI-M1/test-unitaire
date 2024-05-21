<?php

namespace src\Entity;

class Item {
    private string $name;
    private string $content;
    private DateTime $creationDate;

    public function __construct(string $name, string $content) {
        if (strlen($content) > 1000) {
            throw new InvalidArgumentException("Content exceeds 1000 characters");
        }

        $this->name = $name;
        $this->content = $content;
        $this->creationDate = new DateTime();
    }

    public function getName(): string {
        return $this->name;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getCreationDate(): DateTime {
        return $this->creationDate;
    }

    public static function initDataBase() : string {
        return "CREATE TABLE IF NOT EXISTS item (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            content TEXT NOT NULL,
            creation_date DATETIME NOT NULL
        )";
    }
}
