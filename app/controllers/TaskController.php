<?php
require_once(__DIR__ . '../../models/class/ToDoModel.php');
require_once(__DIR__ . '../../models/class/TaskModel.php');
require_once(__DIR__ . '/../../lib/base/Controller.php');

/*
🗒️NOTAS:
1: !isset comprueba si NO se almaceno algo en la variable superglobal "user", si se cumple esta condición es porque no se valido el usuario por lo que sera redirigido al formulario de login.
*/
class TaskController extends Controller
{

    private $toDo;

    public function __construct()
    {
        $this->toDo = new ToDo();  
    }

    public function allTasks_ViewAction()
    {
        
        if(!isset($_SESSION["user"])){/*nota 1 */

            header("location:login-users-form_view");
    
        }else{
             $toDo = $this->toDo;
            return $arrayTasks = $toDo->getUserTasks();
        }
    
    }

    public function deleteTaskAction()
    {
        if(isset($_GET["taskId"]))
        {
            $taskId = $_GET["taskId"];
            $toDo = $this->toDo;
    
            $toDo->deleteTask($taskId);
    
            header("location:all-tasks_view");
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
            header("location:all-tasks_view");
        }else{
            echo "Debe introducir todos los datos";
        }
    }

    public function UpdateTask_viewAction()
    {

        if (isset($_GET["taskId"])) {
            $taskId = $_GET["taskId"];
            $tasksFound = $this->toDo->searchTask($taskId); 
                
            return $tasksFound; //lo enviara a la vista para que imprima el registro elegido para modificar
        }
    }

    public function updateTaskAction()
    {

        if(isset($_POST["taskId"]))
        {    
            // Recogemos todos los valores recibidos de la vista incluyendo los modificados para hacer el cambio en la BBDD
                $taskId= (int) $_POST["taskId"];//casteamos el valor a int ya que el POST lo devuelve como string
                $user= $_POST["user"];
                $taskName= $_POST["taskName"];
                $taskType= $_POST["taskType"];
                $creationDate= $_POST["creationDate"];
                $expectedEndDate= $_POST["expectedEndDate"];
                $statusTask= $_POST["taskStatus"];
    
            $updatedTask =[
                "taskId" =>$taskId,
                "user" =>$user,
                "taskName" =>$taskName,
                "taskType" =>$taskType,
                "creationDate" =>$creationDate,
                "expectedEndDate" =>$expectedEndDate,
                "taskStatus" =>$statusTask
            ];

            // var_dump($updatedTask);

            $this->toDo->updateTask($updatedTask);

            header("location:all-tasks_view");
        }
    }

// METODOS DE FILTRAR >>>>>>>>>>>>>>>>>
    public function filterByTaskName_ViewAction()
    {
        if(isset($_GET["filteredTaskName"])){
            $filteredTaskName = $_GET['filteredTaskName'];
            
            $filteredTasks= $this->toDo->filterByTasksName($filteredTaskName);

            // var_dump($filteredTasks);

            return $filteredTasks;
        }
    }
    public function filterByTaskType_ViewAction()
    {
        if(isset($_GET["filteredTaskType"])){
            $filteredTaskType = $_GET['filteredTaskType'];
            
            $filteredTasks= $this->toDo->filterByTasksType($filteredTaskType);

            // var_dump($filteredTasks);

            return $filteredTasks;
        }
    }

}
    

// $TaskController = new TaskController();
// $arrayTasks = $TaskController->tasksList_ViewAction();
// $TaskController->insertTaskAction("prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43");
// $updateTask = ["taskId"=>1,"prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43", "prueba 18.43"];
// $TaskController->editTaskAction($updateTask);

// var_dump($arrayTasks);
