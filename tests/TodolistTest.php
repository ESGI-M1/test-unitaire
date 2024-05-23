<?php
use PHPUnit\Framework\TestCase;

class TodoListTest extends TestCase {
    
    public function testAddItemSendsEmail() {
        // Create a mock for the TodoList class, mocking the sendEmailNotification method
        $todoListMock = $this->getMockBuilder(TodoList::class)
                             ->onlyMethods(['sendEmailNotification'])
                             ->getMock();

        // Set up the expectation that sendEmailNotification will be called once
        $todoListMock->expects($this->once())
                     ->method('sendEmailNotification');

        $yesterday = new DateTime("-1 day");

        for ($i = 1; $i <= 8; $i++) {
            $item = new Item("Item" . $i, "Content for item " . $i, (clone $yesterday)->modify("+$i hours"));
            $todoListMock->addItem($item);
        }

        // Check if items count is as expected
        $this->assertCount(8, $todoListMock->getItems());
        $this->assertTrue($todoListMock->isValid());
    }


    public function testAddItemThrowsExceptionWhenNameExists() {
        $todoList = new TodoList();
        
        $item1 = new Item("Item1", "Content for item 1");
        $todoList->addItem($item1);

        $item2 = new Item("Item1", "Content for item 2");
        
        // This should throw an exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Item with the same name already exists.");
        $todoList->addItem($item2);
    }

    public function testAddItemThrowsExceptionWhenAddingTooSoon() {
        $todoList = new TodoList();
        
        $item1 = new Item("Item1", "Content for item 1");
        $todoList->addItem($item1);

        // Simulate the passage of time less than 30 minutes
        $item2 = new Item("Item2", "Content for item 2");
        
        // This should throw an exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("You must wait at least 30 minutes between item creations.");
        $todoList->addItem($item2);
    }
}
