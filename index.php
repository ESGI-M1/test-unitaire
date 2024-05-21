<?php

require __DIR__ . '/vendor/autoload.php';

use src\Entity\User;
use src\Config\DataBase;

database::initDataBase();

$user = new User("test@example.com", "Doe", "John", new DateTime("2000-01-01"), "Password1");
//print_r($user);
