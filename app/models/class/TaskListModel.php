<?php
/*
🗒️NOTAS:
1: Para generar el ID utiliza la hora actual en microsegundos como base para el ID. El unico incoveniente es que si se generan IDs simultáneamente en diferentes servidores, existe la posibilidad de que se generen IDs duplicados.
2: El símbolo & se utiliza para pasar la variable $list por referencia dentro del bucle foreach, Gracias al uso de &, las modificaciones realizadas a $list['listName'] y $list['tasks'] dentro del bucle foreach se reflejan directamente en el array original $allTaskLists. Sin &, se estarían modificando copias temporales de los elementos del array y los cambios no se guardarían.

*/

class TaskListModel
{
    
    protected $taskLists; 

    
    public function __construct()
    {
        $this->taskLists = $this->getUserTaskLists();
    }

    
    protected function getAllTaskLists()
    {
        $taskLists = json_decode(file_get_contents(__DIR__ . '../../BBDD/taskLists.json'), true);
        
        return $taskLists;
    }

    
    protected function saveTaskLists($taskLists)
    {
        file_put_contents(__DIR__ . '../../BBDD/taskLists.json', json_encode($taskLists, JSON_PRETTY_PRINT));
    }

    
    public function getUserTaskLists()
    {
        $allTaskLists = $this->getAllTaskLists();
        $currentUser = $_SESSION["user"]; 
        $userTaskLists = [];

        foreach ($allTaskLists as $list) {
            if ($list['user'] === $currentUser) {
                $userTaskLists[] = [
                    'user' => $list['user'],
                    'listName' => $list['listName'],
                    'listId' => $list['listId'],
                    'tasks' => $list['tasks'],
                ];
            }
        }

        return $userTaskLists; 
    }

    public function createTaskList($listName, $tasks = [])
    {
        $allTaskLists = $this->getAllTaskLists();
        $currentUser = $_SESSION["user"]; 

        $newList = [
            'listId' => uniqid()/*nota 1*/, 
            'user' => $currentUser,
            'listName' => $listName,
            'tasks' => $tasks,
        ];

        $allTaskLists[] = $newList; 
        $this->saveTaskLists($allTaskLists); 
    }

    public function updateTaskList($listId, $listName, $tasks)
{
    $allTaskLists = $this->getAllTaskLists();
    
    foreach ($allTaskLists as &$list) {
        if ($list['listId'] === $listId && $list['user'] === $_SESSION["user"]) {
            $list['listName'] = $listName;
            $list['tasks'] = $tasks;
            break;
        }
    }

    $this->saveTaskLists($allTaskLists);
}

    public function deleteList($listId)
{
    $allTaskLists = $this->getAllTaskLists();
    $currentUser = $_SESSION["user"];

    foreach ($allTaskLists as $index => $taskList) {
        if ($taskList["listId"] === $listId && $taskList["user"] === $currentUser) {
            unset($allTaskLists[$index]);
            break;
        }
    }

    $this->saveTaskLists($allTaskLists);
}

public function searchList($listId): array
{
    $allTaskLists = $this->getAllTaskLists();
    $currentUser = isset($_SESSION["user"]) ? $_SESSION["user"] : null;
    $listDetails = [];

    foreach ($allTaskLists as $list ) {
        if ($list["listId"] === $listId && $list["user"] === $currentUser) {
            $listDetails = $list;
            break;
        }
    }

    return [$listDetails];
}

}

