<?php

class ToDo
{
    protected array $tasks;

    public function getTasks()
    {   
        $tasks = json_decode(file_get_contents(__DIR__ . '../../../models/toDo.json'), true);

        return $this->tasks = $tasks;
    }

    public function createTask(Task $task, User $user)
    {
        $tasks = $this->getTasks(); //obtenemos todas las tasks antes de agregar la nueva tarea

        // creamos la tarea nueva con los valores de cada campo
        $newTask = [
            // recogemos los valores de los getters y lo pasamos a la clave del array asociativo
            "taskId"=>$task->getTaskId(), 
            "user"=>$user->getNickName(),
            "taskName"=>$task->getTaskName(), 
            "taskType"=>$task->getTaskType(), 
            "creationDate"=>$task->getCreationDate(), 
            "expectedEndDate"=>$task->getExpectedEndDate(), "taskStatus"=>$task->gettaskStatus()
        ];

        // insertamos la tarea en el array de $tasks
        $tasks []= $newTask;

        // insertamos el array $tasks en la BBDD(el archivo Json) por medio del metodo addJson() junto con la nueva tarea creada
        $this->addJson($tasks);

    }

    public function addJson($tasks)
    {
        file_put_contents(__DIR__ . '../../../models/toDo.json', json_encode($tasks, JSON_PRETTY_PRINT));
    }


    public function deleteTask(int $taskId)
    {
        $tasks = $this->getTasks();

        $isFound = false;
        $longArray = count($tasks);
        $i=0;
        while($isFound==false && $i<$longArray)             
        {
            if($tasks[$i]["taskId"]==$taskId)
            {//elimina la posicion de la tarea dentro del array $tasks
                array_splice($tasks,$i, 1);
                $isFound = true;//cuando encuentre la tarea dejara de iterar
            }
            $i++;
        }

        $this->addJson($tasks);
    }

    public function searchTask(int $taskId): array
    {
        $tasks = $this->getTasks();

        $isFound = false;
        $longArray = count($tasks);
        $i=0;
        while($isFound==false && $i<$longArray)             
        {
            if($tasks[$i]["taskId"]==$taskId)
            {
                $taskFound = $tasks[$i];
                $isFound = true;//cuando encuentre la tarea dejara de iterar
            }
            $i++;
        }
        return $taskFound;
    }

    public function updateTask(array $updatedTask, int $taskId)
    {
        $tasks = $this->getTasks();

        $isFound = false;
        $longArray = count($tasks);
        $i=0;
        while($isFound==false && $i<$longArray)             
        {
            if($tasks[$i]["taskId"]==$taskId)
            {   //sobreescribria los datos antiguos con los actualizados
                $tasks[$i] = array_merge($tasks[$i], $updatedTask);
                $isFound = true;//cuando encuentre la tarea dejara de iterar
            }
            $i++;
        }

        $this->addJson($tasks);
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
            return $filterTasks;
        }
    }

   // Método para obtener la información de usuarios y tareas por tipo
   public function getUsersAndTasksByType(string $type){
    $tasks = $this->getTasks();
    $filteredTasks = [];

    foreach ($tasks as $task) {
        // recogemos en el array asosiciativo el valor que hay del taskType en la task actual y asi podemos compararlo con el que intrudujo el usuario
        if ($task["taskType"] === $type) {
            $filteredTasks[] = $task; // Almacena la información completa de la tarea
        }
    }

    return $filteredTasks;
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




