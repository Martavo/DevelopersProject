<?php
require_once(__DIR__ . '../../models/class/ToDoModel.php');
require_once(__DIR__ . '/../../lib/base/Controller.php');


class TaskController extends Controller
{

    private $toDo;

    public function __construct()
    {
        $this->toDo = $toDo = new ToDo();  
    }

    public function tasksList_ViewAction()
    {
        // echo "estas en TaskController->tasksList_ViewAction()";
         $toDo = $this->toDo;
        return $arrayTasks = $toDo->getTasks();
        // var_dump($arrayTasks);
    }

    public function deleteTaskAction()
    {
        echo "Estas en deleteTaskAction";
        if(isset($_GET["taskId"]))
        {
            $taskId = $_GET["taskId"];
            $toDo = $this->toDo;
    
            $toDo->deleteTask($taskId);
    
            header("location:tasksList_View");
        }else{
            echo "Hay un error en la ruta";
        }    
    }

}

// $TaskController = new TaskController();
// $arrayTasks = $TaskController->tasksList_ViewAction();

// var_dump($arrayTasks);
