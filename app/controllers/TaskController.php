<?php
require_once(__DIR__ . '../../models/class/ToDoModel.php');
require_once(__DIR__ . '../../models/class/TaskModel.php');
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
        // !isset comprueba si NO se almaceno algo en la variable superglobal "user", si se cumple esta condición es porque no se valido el usuario por lo que sera redirigido al formulario de login
        if(!isset($_SESSION["user"])){

            header("location:loginUsersForm_View");
    
        }else{
            // echo "estas en TaskController->tasksList_ViewAction()";
             $toDo = $this->toDo;
            return $arrayTasks = $toDo->getTasks();
            // var_dump($arrayTasks);
        }
    
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

    public function insertTaskAction()
    {
        if(isset($_POST["user"]))
        {
            $user= $_POST["user"];
            $taskName= $_POST["taskName"];
            $taskType= $_POST["taskType"];
            $creationDate= $_POST["creationDate"];
            $expectedEndDate= $_POST["expectedEndDate"];
            $statusTask= $_POST["statusTask"];

            $toDo = $this->toDo;
            $toDo->createTask(new Task(
                $taskName,
                $taskType,
                $creationDate,
                $expectedEndDate,
                $statusTask,
            ),
            $user);

            // Redirigimos a la página de listado de tareas con los nuevo datos insertados.
            header("location:tasksList_View");
        }else{
            echo "Debe introducir todos los datos";
        }
    }

    public function editTaskAction()
    {
                
    }

}

// $TaskController = new TaskController();
// $arrayTasks = $TaskController->tasksList_ViewAction();
// $TaskController->insertTaskAction("prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43");

// var_dump($arrayTasks);
