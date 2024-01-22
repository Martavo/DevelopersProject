<?php

require_once 'User.php';
require_once 'UserManager.php';

$userManager = new UserManager();


$newUser = new User("username1", "password1");
$userManager->createUser($newUser);


$updatedUser = new User("username2", "password2");
$userManager->updateUser($updatedUser, "username1");


$userManager->deleteUser("username1");

?>
