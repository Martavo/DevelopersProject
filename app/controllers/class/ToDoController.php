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

   // Método para buscar la información a través del nombre de usuario
    public function getTasksByUser($nickName){
        $tasks = $this->getTasks();
        $userTasks = [];

        foreach ($tasks as $task) {
            if ($task['user'] === $nickName) {
                // Obtenemos la información del usuario con el método getUserInfo
                $userInfo = $this->getUserInfo($nickName);

                if ($userInfo !== null) {
                    // Agregamos la información del usuario y la tarea al array $userTasks
                    $task['user'] = $userInfo; 
                    $userTasks[] = $task;
                } else {
                    // Gestionamos el error, creo que con el metodo errorController
                    
                
                }
            }

        return $userTasks;
        }
    }

    // Método para obtener la información del usuario
    public function getUserInfo($nickName){
        // Lee el json para obtener la información de los usuarios
        $users = json_decode(file_get_contents(__DIR__ . '../../../models/user.json'), true);

        foreach ($users as $user) {
            if ($user['nickName'] === $nickName) {
                unset($user['password']);
                return $user; // Devuelve la informacion del usuario sin la contraseña
            }
        }
        // Gestionamos el error, creo que con el metodo errorController
    }

    // Método para filtrar la información a través del tipo de tarea
    public function getTasksByType(taskType $type){
    
    $tasks = $this->getTasks();
    $filteredTasks = [];

    foreach ($tasks as $task) {
        $taskType = $this->getTaskType($task['taskType']);

        if ($taskType === $type->tasks()) {
            $filteredTasks[] = $task;
        }
    }

    return $filteredTasks;
    }

    // Método auxiliar para obtener el nombre del tipo de tarea
    public function getTaskType($type){

        $taskTypeEnum = new taskType(); 
        return $taskTypeEnum->tasks()[$type] ?? null; // Devuelve el nombre del tipo de tarea o null si no se encuentra
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

    return $filteredTasksbyName;
}

}


