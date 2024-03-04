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

            header("location:login-users-form_view");
    
        }else{
             $toDo = $this->toDo;
            return $arrayTasks = $toDo->getUserTasks();
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
    
            header("location:tasks-list_view");
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
            header("location:tasks-list_view");
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
            $toDo = $this->toDo;
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

            $toDo->updateTask($updatedTask);

            header("location:tasks-list_view");
        }
    }

// METODOS DE FILTRAR >>>>>>>>>>>>>>>>>
    public function filterByUser_ViewAction()
    {
        if(isset($_GET["filteredUser"])){
            $filteredUser = $_GET['filteredUser'];
            // var_dump($filteredUser);
            
            $filteredTasks= $this->toDo->filterByUser($filteredUser);

            return $filteredTasks;
        }
    }
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

    public function list_viewAction()
{
    
}

}
    

// $TaskController = new TaskController();
// $arrayTasks = $TaskController->tasksList_ViewAction();
// $TaskController->insertTaskAction("prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43");
// $updateTask = ["taskId"=>1,"prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43","prueba 18.43", "prueba 18.43"];
// $TaskController->editTaskAction($updateTask);

// var_dump($arrayTasks);
