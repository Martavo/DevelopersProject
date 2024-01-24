<?php

require_once("../app/models/class/taskModel.php");
require_once("../app/models/class/toDoModel.php");
require_once("../app/models/class/userModel.php");

// metodos Tareas
    $toDo = new ToDo();
    $arrayTasks = $toDo->getTasks();

// metodos usuarios
    $userModel = new UserManager();
    $users = $userModel->getUsers();

require_once("../app/views/layouts/tasksList_View.php");







