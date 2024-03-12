<?php
require_once(__DIR__ . '../../models/class/ToDoModel.php');
require_once(__DIR__ . '../../models/class/TaskModel.php');
require_once(__DIR__ . '../../models/class/TaskListModel.php');
require_once(__DIR__ . '/../../lib/base/Controller.php');

/*
🗒️NOTAS:
1: !isset comprueba si NO se almaceno algo en la variable superglobal "user", si se cumple esta condición es porque no se valido el usuario por lo que sera redirigido al formulario de login.
2: Comprueba que se haya realizado una sesion valida de un usuario y si no es asi redirigira al formulario de login.
*/

class TaskListController extends Controller
{
    protected $taskList;

    public function __construct()
    {
        $this->taskList = new TaskListModel();
    }

    // Devuelve todas las listas de tareas creadas por el usuario
    public function TaskList_ViewAction()
    {
        if (!isset($_SESSION["user"])) {
            header("location:login-users-form_view");
        } else {
            $taskList = $this->taskList;
            return $taskList->getUserTaskLists();
        }
    }

    // Borra una lista de tareas
    public function deleteListAction()
{
    if (isset($_GET["listId"])) {
        $listId = $_GET["listId"];

        $this->taskList->deleteList($listId);

        header("location:task-list_view");
    } else {
        echo "Hay un error en la ruta";
    }
}


    public function createTaskListAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica si el campo 'listName' está presente en la solicitud
            if (isset($_POST['listName'])) {
                $listName = $_POST['listName'];
                
                // Verifica si el campo 'taskContent' está presente en la solicitud
                if (isset($_POST['taskContent']) && is_array($_POST['taskContent'])) {
                    $tasks = $_POST['taskContent'];
                } else {
                    // Si 'taskContent' no está presente o no es un array, asigna un array vacío
                    $tasks = [];
                }

                $this->taskList->createTaskList($listName, $tasks);

                header("location: task-list_view");
                exit(); 
            } else {
                // Si 'listName' no está presente en la solicitud POST
                echo "Error: El campo 'listName' no está presente en la solicitud POST.";
            }
        } else {
            // Si la solicitud no es de tipo POST
            echo "Error: La solicitud no es de tipo POST.";
        }
    }
    public function createlist_ViewAction()
    {
        
    }

    public function updateListAction()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['listId'], $_POST['listName'])) {
            $listId = $_POST['listId'];
            $listName = $_POST['listName'];

            if($_POST['tasks']!=null){//impide que se intente guardar un valor null cuando no hay tareas asignadas 
                $tasks = $_POST['tasks'];            
            }else{
                $tasks = [];
            }
            $this->taskList->updateTaskList($listId, $listName, $tasks);
            
            header("Location: task-list_view");
            exit();
        } else {
            echo "Error: Campos faltantes en la solicitud POST.";
        }
    } else {
        echo "Error: La solicitud no es de tipo POST.";
    }
}

    public function updatelist_ViewAction()
{
    if (isset($_GET["listId"])) {
        $listId = $_GET["listId"];

        $listFound = $this->taskList->searchList($listId);

    } 

    return $listFound;
}

    
}


