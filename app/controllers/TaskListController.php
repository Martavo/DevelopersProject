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
    private $taskList;

    public function __construct(){

        $this->taskList = new TaskListModel();
     }

    // Devuelve todas las listas de tareas creadas por el usuario
    public function TaskList_ViewAction()
    {

        if (!isset($_SESSION["user"])) {/*nota 1 */

            header("location:login-users-form_view");
        } else {
            $taskList = $this->taskList;

            return $userTaskLists = $taskList->getUserTaskLists();
        }
    }

    // Borra una lista de tareas
    public function deleteTaskListAction()
    {
        if(isset($_GET["listId"]))
        {
            $listId = $_GET["listId"];
    
            $this->taskList->deleteTaskList($listId);
    
            header("location:task-list_view");
        }else{
            echo "Hay un error en la ruta";
        }    
    }

    // Crea una lista de tareas
    public function createTaskListAction(string $listName)
    {
            $this->taskList->createTaskList($listName);

            header("location:task-list_view");

    }

    // Agrega una tarea a una lista
    public function insertTasktoListAction()
    {
        //⚠️pendiente xavi cree el metodo para agregar tarea a una lista del usuario, puede ser que se utilice el metodo updateTaskList() para agregar una tarea?
    }

    public function updateTask_ViewAction($listId, $listName, $task)
    {
            $this->taskList->updateTaskList($listId, $listName, $task);

            header("location:task-list_view");
    }

    
}
