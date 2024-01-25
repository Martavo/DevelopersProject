<?php

$userId = $_GET["userId"];

$userModel -> deleleUser($userId);

header("Location: /loginUserForm");