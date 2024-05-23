<?php

class Item {
    private string $name;
    private string $content;
    private DateTime $creationDate;

    public function __construct(string $name, string $content, DateTime $creationDate = new DateTime()) {
        if (strlen($content) > 1000) {
            throw new InvalidArgumentException("Content exceeds 1000 characters");
        }

        if($creationDate > new DateTime()) {
            throw new InvalidArgumentException("Creation date cannot be in the future");
        }

        if(empty($name) || empty($content)) {
            throw new InvalidArgumentException("Name or content cannot be empty");
        }

        $this->name = $name;
        $this->content = $content;
        $this->creationDate = $creationDate;
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

    public function setName(string $name): void {
        if (empty($name)) {
            throw new InvalidArgumentException("Name cannot be empty");
        }
        $this->name = $name;
    }

    public function setContent(string $content): void {
        if (strlen($content) > 1000) {
            throw new InvalidArgumentException("Content exceeds 1000 characters");
        }

        if (empty($content)) {
            throw new InvalidArgumentException("Content cannot be empty");
        }

        $this->content = $content;
    }

    public function setCreationDate(DateTime $creationDate): void {
        if($creationDate > new DateTime()) {
            throw new InvalidArgumentException("Creation date cannot be in the future");
        }

        $this->creationDate = $creationDate;
    }

    public function isValid(): bool {
        return !empty($this->name) 
            && !empty($this->content) 
            && strlen($this->content) <= 1000 
            && $this->creationDate <= new DateTime();
    }
}
