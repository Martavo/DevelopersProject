<?php

class ToDo
{

    protected array $userTasks;
    protected array $currentTasks;
    protected array $currentLists;


    public function getAllUsersTasks()
    {
        $allUsersTask = json_decode(file_get_contents(__DIR__ . '../../BBDD/toDo.json'), true);

        return $allUsersTask;
    }

    public function getTasks()
    {
        $currentTasks = json_decode(file_get_contents(__DIR__ . '../../BBDD/toDo.json'), true);

        return $this->currentTasks = $currentTasks;
    }

    public function getUserTasks()
    {
        $allUsersTask = $this->getAllUsersTasks();

        $user = $_SESSION["user"];
        // var_dump($user);
        $userTasks = [];
        foreach ($allUsersTask as $key => $task) {
            if ($task['user'] == $user) {
                $userTasks[] = $task;
            }
        }
        // var_dump($userTasks);
        return $this->userTasks = $userTasks;
    }

    public function createTask(Task $task, string $nickName)
    {
        $allUsersTasks = $this->getAllUsersTasks(); //obtenemos todas las tasks antes de agregar la nueva tarea

        // creamos la tarea nueva con los valores de cada campo
        $newTask = [
            // recogemos los valores de los getters y lo pasamos a la clave del array asociativo
            "taskId" => $task->getTaskId(),
            "user" => $nickName,
            "taskName" => $task->getTaskName(),
            "taskType" => $task->getTaskType(),
            "creationDate" => $task->getCreationDate(),
            "expectedEndDate" => $task->getExpectedEndDate(), "taskStatus" => $task->getTaskStatus()
        ];

        // insertamos la tarea en el array de $allUsersTasks
        $allUsersTasks[] = $newTask;

        // insertamos el array $allUsersTasks en la BBDD(el archivo Json) por medio del metodo addJson() junto con la nueva tarea creada
        $this->addJson($allUsersTasks);
    }

    public function addJson($allUsersTasks)
    {
        file_put_contents(__DIR__ . '../../BBDD/toDo.json', json_encode($allUsersTasks, JSON_PRETTY_PRINT));
    }


    public function deleteTask(int $taskId)
    {
        $allUsersTasks = $this->getAllUsersTasks();

        $isFound = false;
        $longArray = count($allUsersTasks);
        $i = 0;
        while ($isFound == false && $i < $longArray) {
            if ($allUsersTasks[$i]["taskId"] == $taskId) { //elimina la posicion de la tarea dentro del array $allUsersTasks
                array_splice($allUsersTasks, $i, 1);
                $isFound = true; //cuando encuentre la tarea dejara de iterar
            }
            $i++;
        }

        $this->addJson($allUsersTasks);
    }

    public function searchTask(int $taskId): array
    {
        $allUsersTasks = $this->getAllUsersTasks();

        $isFound = false;
        $longArray = count($allUsersTasks);
        $i = 0;
        while ($isFound == false && $i < $longArray) {
            if ($allUsersTasks[$i]["taskId"] == $taskId) {
                $taskFound = $allUsersTasks[$i];
                $isFound = true; //cuando encuentre la tarea dejara de iterar
            }
            $i++;
        }
        return $taskFound;
    }

    public function updateTask(array $updatedTask)
    {
        $allUsersTasks = $this->getAllUsersTasks();

        // var_dump($allUsersTasks);

        $isFound = false;
        $longArray = count($allUsersTasks);
        $i = 0;
        while ($isFound == false && $i < $longArray) {

            if ($allUsersTasks[$i]["taskId"] == $updatedTask["taskId"]) {   //sobreescribria los datos antiguos con los actualizados
                $allUsersTasks[$i] = array_merge($allUsersTasks[$i], $updatedTask);
                $isFound = true; //cuando encuentre la tarea dejara de iterar
            }
            $i++;
        }

        // var_dump($allUsersTasks);

        $this->addJson($allUsersTasks);
    }



    // Método para buscar por usuario
    /*public function filterByUser(string $searchedUser)
    {
        $allUsersTasks = $this->getAllUsersTasks();
        $filterTasks = array();

        foreach ($allUsersTasks as $task) {
            if ($task["user"] == $searchedUser) {
                $filterTasks[] = $task; // Almacena la información completa de la tarea
            }
        }
        return $filterTasks;
    }*/

    // Método para filtrar la información por el nombre de la tarea sea mayusculas o minusculas
    public function filterByTasksName($searchString)
    {

        $allUsersTasks = $this->getAllUsersTasks();
        $currentTasks = $this->getTasks();
        $filteredTasksbyName = [];
        $currentUser = $_SESSION["user"];

        foreach ($allUsersTasks as $task) {
            if (stripos($task['taskName'], $searchString) !== false && $task["user"] == $currentUser) {
                $filteredTasksbyName[] = $task;
            }
        }

        return $filteredTasksbyName;
    }

    // Método para obtener la información de usuarios y tareas por tipo
    public function filterByTasksType(string $type)
    {
        $allUsersTasks = $this->getAllUsersTasks();
        $filteredTasks = [];
        $currentUser = $_SESSION["user"];

        foreach ($allUsersTasks as $task) {
            if ($task["taskType"] === $type && $task["user"] === $currentUser) {
                $filteredTasks[] = $task;
            }
        }

        return $filteredTasks;
    }
}

// $toDo = new ToDo();

// $toDo->createTask(new Task('prueba', 'prueba', 'prueba', 'prueba', 'prueba'),'pol45');

// var_dump($arrayTasks);
