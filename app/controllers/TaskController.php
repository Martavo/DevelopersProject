<?php
require_once(__DIR__ . '../../models/class/ToDoModel.php');
require_once(__DIR__ . '/../../lib/base/Controller.php');


class TaskController extends Controller
{

    public function tasksList_ViewAction()
    {
        echo "estas en TaskController->tasksList_ViewAction()";

        $toDo = new ToDo();   
        return $arrayTasks = $toDo->getTasks();
        // var_dump($arrayTasks);

    }

}

// $TaskController = new TaskController();
// $arrayTasks = $TaskController->tasksList_ViewAction();

// var_dump($arrayTasks);
