<?php

class TodoList {
    private array $items = [];
    private const MAX_ITEMS = 10;
    private const EMAIL_THRESHOLD = 8;
    private const DELAY = 30;

    public function addItem(Item $item): bool {
        if (count($this->items) >= self::MAX_ITEMS) {
            throw new Exception("Cannot add more than " . self::MAX_ITEMS . " items to the list.");
        }

        foreach ($this->items as $existingItem) {
            if ($existingItem->getName() === $item->getName()) {
                throw new Exception("Item with the same name already exists.");
            }
        }

        if (!empty($this->items)) {
            $lastItem = end($this->items);
            $interval = ($lastItem->getCreationDate())->diff(new DateTime());
            if ($interval->i < self::DELAY && $interval->h === 0 && $interval->d === 0 && $interval->m === 0 && $interval->y === 0) {
                throw new Exception("You must wait at least 30 minutes between item creations.");
            }
        }


        $this->items[] = $item;

        if (count($this->items) === self::EMAIL_THRESHOLD) {
            $this->sendEmailNotification();
        }

        return true;
    }

    // should be in private but need to be in public to be mocked
    public function sendEmailNotification(): void {
        $to = "melvin.pierre.mp@gmail.com";
        $subject = "TodoList Notification";
        $message = "You have reached 8 items in your TodoList.";
        $headers = "From: melvin.pierre.mp@gmail.com";

        if (!mail($to, $subject, $message, $headers)) {
            throw new Exception("Failed to send email notification.");
        }
    }

    public function getItems(): array {
        return $this->items;
    }

    public function isValid(){
        return count($this->items) <= self::MAX_ITEMS;
    }
}
