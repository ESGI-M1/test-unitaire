<?php
use PHPUnit\Framework\TestCase;

class TodoListTest extends TestCase {
    public function testAddItem() {
        $todoList = new TodoList();
        $user = new User("melvin.pierre.mp@gmail.com", "Doe", "John", new DateTime("2000-01-01"), "Password1");

        for ($i = 1; $i <= 8; $i++) {
            $item = new Item("Item" . $i, "Content for item " . $i);
            $todoList->addItem($item);
        }

        $item = new Item("Item9", "Content for item 9");
        $todoList->addItem($item);

        $this->assertCount(9, $todoList->getItems());
    }
}
