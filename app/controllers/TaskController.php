<?php
require_once(__DIR__ . '../../models/class/ToDoModel.php');
require_once(__DIR__ . '/../../lib/base/Controller.php');



/*enum TaskType: string {
    case FrontEnd = 'FrontEnd';
    case BackEnd = 'BackEnd';
    case DataScience = 'DataScience';
}

enum TaskStatus: string {
    case Pending = 'Pendiente';
    case Finished = 'Finalizada';
    case InProcess = 'En Ejecucion';
}*/


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

    public function updateTaskAction()
{

    $taskId = $_POST["taskId"];

    if (isset($_POST["taskId"])) {
        $taskId = $_POST["taskId"];
        $user = $_POST["user"];
        $updatedTask = [
            'user' => $_POST ['user'],
            'taskName' => $_POST['taskName'],
            'taskType' => $_POST['taskType'],
            'creationDate' => $_POST['creationDate'],
            'expectedEndDate' => $_POST['expectedEndDate'],
            'taskStatus' => $_POST['taskStatus'],
        ];

        $toDo = $this->toDo;
        $toDo->updateTask($updatedTask, $taskId, $user);

        header("location:tasksList_View");  
    } else {
        echo "Error en la ruta.";  
    }
}

    public function updateTask_ViewAction(){
        if (isset($_GET["taskId"])) {
            $taskId = $_GET["taskId"];
            $task = $this->toDo->searchTask($taskId); 

            if ($task) {
                include_once 'C:\xampp\htdocs\DevelopersProject\app\views\scripts\task\updateTask_View.phtml'; 
            } else {
                
                echo "Tarea no encontrada.";
                return;
            }
        } else {
            
            echo "TaskID no encontrada.";
            return;
        }
    }


    if (!isset($taskId)) {
        header("location:error_404.php");
        } else {
        $toDo = $this->toDo;
        $task = $toDo->getTask($taskId);

        if (!$task) {
            header("location:error_404.php");
        } else {
            $updatedTask = $_POST;

            $taskName = $updatedTask["taskName"];
            $taskType = $updatedTask["taskType"];
            $taskStatus = $updatedTask["taskStatus"];

            $updatedTask = new Task($taskName, $taskType, $taskStatus);

            $toDo->updateTask($updatedTask, $taskId);
            header("location:tasksList_View");
        }
    }
}




// $TaskController = new TaskController();
// $arrayTasks = $TaskController->tasksList_ViewAction();

// var_dump($arrayTasks);
