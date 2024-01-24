<?php
require_once "../../../app/controllers/ApplicationController.php";


$taskId = $_GET["taskId"];

$toDo->deleteTask($taskId);

header("location:../index.php");
