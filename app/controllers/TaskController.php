<?php
require_once(__DIR__ . '../../models/class/ToDoModel.php');
require_once(__DIR__ . '/../../lib/base/Controller.php');


class TaskController extends Controller
{

    public function GetTasksAction()
    {
        $toDo = new ToDo();   
        $arrayTasks = $toDo->getTasks();
        // var_dump($arrayTasks);

        return $arrayTasks;

    }

}

// $TaskController = new TaskController();
// $arrayTasks = $TaskController->GetTasksAction();

// var_dump($arrayTasks);
