<?php

class ToDo 
{
    protected array $currentTasks;

    public function getTasks()
    {   
        $currentTasks = json_decode(file_get_contents( __DIR__ . '../../BBDD/toDo.json'), true);

        return $this->currentTasks = $currentTasks;
    }

    public function createTask(Task $task, string $nickName)
    {
        $currentTasks = $this->getTasks(); //obtenemos todas las tasks antes de agregar la nueva tarea

        // creamos la tarea nueva con los valores de cada campo
        $newTask = [
            // recogemos los valores de los getters y lo pasamos a la clave del array asociativo
            "taskId"=>$task->getTaskId(), 
            "user"=>$nickName,
            "taskName"=>$task->getTaskName(), 
            "taskType"=>$task->getTaskType(), 
            "creationDate"=>$task->getCreationDate(), 
            "expectedEndDate"=>$task->getExpectedEndDate(), "taskStatus"=>$task->gettaskStatus()
        ];

        // insertamos la tarea en el array de $currentTasks
        $currentTasks []= $newTask;

        // insertamos el array $currentTasks en la BBDD(el archivo Json) por medio del metodo addJson() junto con la nueva tarea creada
        $this->addJson($currentTasks);

    }

    public function addJson($currentTasks)
    {
        file_put_contents(__DIR__ . '../../BBDD/toDo.json', json_encode($currentTasks, JSON_PRETTY_PRINT));
    }


    public function deleteTask(int $taskId)
    {
        $currentTasks = $this->getTasks();

        $isFound = false;
        $longArray = count($currentTasks);
        $i=0;
        while($isFound==false && $i<$longArray)             
        {
            if($currentTasks[$i]["taskId"]==$taskId)
            {//elimina la posicion de la tarea dentro del array $currentTasks
                array_splice($currentTasks,$i, 1);
                $isFound = true;//cuando encuentre la tarea dejara de iterar
            }
            $i++;
        }

        $this->addJson($currentTasks);
    }

    public function searchTask(int $taskId): array
    {
        $currentTasks = $this->getTasks();

        $isFound = false;
        $longArray = count($currentTasks);
        $i=0;
        while($isFound==false && $i<$longArray)             
        {
            if($currentTasks[$i]["taskId"]==$taskId)
            {
                $taskFound = $currentTasks[$i];
                $isFound = true;//cuando encuentre la tarea dejara de iterar
            }
            $i++;
        }
        return $taskFound;
    }

    public function updateTask(array $updatedTask)
    {
        $currentTasks = $this->getTasks();

        // var_dump($currentTasks);

        $isFound = false;
        $longArray = count($currentTasks);
        $i=0;
        while($isFound==false && $i<$longArray)             
        {

            if($currentTasks[$i]["taskId"]==$updatedTask["taskId"])
            {   //sobreescribria los datos antiguos con los actualizados
                $currentTasks[$i] = array_merge($currentTasks[$i], $updatedTask);
                $isFound = true;//cuando encuentre la tarea dejara de iterar
            }
            $i++;
        }

        // var_dump($currentTasks);

            $this->addJson($currentTasks);
    }



  // Método para buscar por usuario
    public function filterByUser(string $searchedUser){
        $currentTasks = $this->getTasks();
        $filterTasks = array();

        foreach ($currentTasks as $task){
            if($task["user"] == $searchedUser){   
            $filterTasks[] = $task; // Almacena la información completa de la tarea
            }
        }
        return $filterTasks;
    }

    // Método para filtrar la información por el nombre de la tarea sea mayusculas o minusculas
    public function filterByTasksName($searchString){

        $currentTasks = $this->getTasks();
        $filteredTasksbyName = [];

        foreach ($currentTasks as $task) {
            // Buscamos la cadena de búsqueda en el nombre de la tarea
            if (stripos($task['taskName'], $searchString) !== false) {
            $filteredTasksbyName[] = $task;
            }
        }
        // var_dump($filteredTasksbyName);

        return $filteredTasksbyName;
    }

       // Método para obtener la información de usuarios y tareas por tipo
   public function filterByTasksType(string $type){
    $currentTasks = $this->getTasks();
    $filteredTasks = [];

    foreach ($currentTasks as $task) {
        // recogemos en el array asosiciativo el valor que hay del taskType en la task actual y asi podemos compararlo con el que intrudujo el usuario
        if ($task["taskType"] === $type) {
            $filteredTasks[] = $task; // Almacena la información completa de la tarea
        }
    }

    return $filteredTasks;
    }


}

// $toDo = new ToDo();

// $arrayTasks = $toDo->getTasks();

// var_dump($arrayTasks);



