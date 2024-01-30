<?php

$userId = $_GET["userId"];

$userModel -> deleteUser($userId);

header("Location: /loginUserForm");