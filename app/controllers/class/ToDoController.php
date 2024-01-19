<?php

class ToDo
{

    // PENDIENTES: metodos de tareas

    protected array $tasks;

    public function getTasks()
    {   
        $tasks = json_decode(file_get_contents(__DIR__ . '../../../models/toDo.json'), true);

        return $this->tasks = $tasks;
    }

    public function createTask(Task $task, User $user)
    {
        $tasks = $this->getTasks(); //obtenemos todas las tareas antes de agregar la nueva tarea

        // recogemos los valores de los getters de cada objeto en cada variable
        $taskId=$task->getTaskId();
        $user = $user->getNickName();
        $taskName = $task->getTaskName();
        $taskType=$task->getTaskType();
        $creationDate=$task->getCreationDate();
        $expectedEndDate=$task->getExpectedEndDate();
        $taskStatus=$task->gettaskStatus();

        // creamos la tarea con los valores de cada variable
        $newTask = ["taskId"=>$taskId, "usuario"=>$user,"nomTarea"=>$taskName, "taskType"=>$taskType, "creationDate"=>$creationDate, "expectedEndDate"=>$expectedEndDate, "taskStatus"=>$taskStatus];

        // insertamos la tarea en el array de $tasks
        $tasks []= $newTask;

        // insertamos el array $tasks en la BBDD(el archivo Json) por medio del metodo addJson() junto con la nueva tarea creada
        $this->addJson($tasks);

    }

    public function addJson($tasks)
    {
        file_put_contents(__DIR__ . '../../../models/toDo.json', json_encode($tasks, JSON_PRETTY_PRINT));
    }

    // Método para buscar por usuario
    public function listByUser(string $searchedUser){
        $tasks = $this->getTasks();
        $filterTasks = array();

        foreach ($tasks as $task){
            if($task["user"] == $searchedUser){   
            $filterTasks[] = $task; // Almacena la información completa de la tarea
            }
        }

        if(empty($filterTasks)){
            // Si el array está vacío, gestion de errores
        } else {
            print_r($filterTasks);
        }
    }

   // Método para obtener la información de usuarios y tareas por tipo
    public function getUsersAndTasksByType(taskType $type){
        $tasks = $this->getTasks();
        $filteredTasks = [];

        foreach ($tasks as $task) {
            $taskTypeEnum = new taskType();
            $taskType = $taskTypeEnum->tasks()[$task['taskType']] ?? null;

            if ($taskType === $type->tasks()) {
                $filteredTasks[] = $task; // Almacena la información completa de la tarea
            }
        }

        print_r($filteredTasks);
}


    // Método para filtrar la información por el nombre de la tarea sea mayusculas o minusculas
    public function getTasksByName($searchString){

        $tasks = $this->getTasks();
        $filteredTasksbyName = [];

        foreach ($tasks as $task) {
            // Buscamos la cadena de búsqueda en el nombre de la tarea
            if (stripos($task['taskName'], $searchString) !== false) {
            $filteredTasksbyName[] = $task;
            }
        }

        print_r($filteredTasksbyName);
    }

}


