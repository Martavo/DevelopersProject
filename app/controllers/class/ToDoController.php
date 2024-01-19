<?php

class ToDo
{

    // PENDIENTES: updateTask(), listTasks()->(creo que seria el mismo getTasks())

    protected array $tasks;

    public function getTasks()
    {   
        $tasks = json_decode(file_get_contents(__DIR__ . '../../../models/toDo.json'), true);

        return $this->tasks = $tasks;
    }

    public function deleteTask(int $searchedTaskId)
    {
        $tasks = $this->getTasks();
        $foundTask = false;

        $longArray = count($tasks);
        $i=0;
        while($foundTask==false && $i<$longArray)             
        {
            if($tasks[$i]["taskId"]==$searchedTaskId)
            {
                array_splice($tasks,$i, 1);
                $foundTask = true;
            }
            $i++;
        }
        echo $foundTask==false ? "La tarea buscada no se encuentra en nuestra BBDD" : null;

        $this->addJson($tasks);
    }

    public function createTask(Task $task, User $user)
    {
        $tasks = $this->getTasks(); //obtenemos todas las tasks antes de agregar la nueva tarea

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

}

