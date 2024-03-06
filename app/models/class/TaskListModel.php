<?php


class TaskListModel
{
    
    protected $taskLists; 

    
    public function __construct()
    {
        $this->taskLists = $this->getUserTaskLists(); 
    }

    
    protected function getAllTaskLists()
    {
        $taskLists = json_decode(file_get_contents(__DIR__ . '/../../BBDD/taskLists.json'), true);
        
        return $taskLists;
    }

    
    protected function saveTaskLists($taskLists)
    {
        file_put_contents(__DIR__ . '/../../BBDD/taskLists.json', json_encode($taskLists, JSON_PRETTY_PRINT));
    }

    
    protected function getUserTaskLists()
    {
        $allTaskLists = $this->getAllTaskLists();
        $currentUser = $_SESSION["user"]; 
        $userTaskLists = [];

        foreach ($allTaskLists as $list) {
            if ($list['user'] === $currentUser) {
                $userTaskLists[] = $list;
            }
        }

        return $userTaskLists; 
    }

    public function createTaskList($listName, $tasks = [])
    {
        $allTaskLists = $this->getAllTaskLists();
        $currentUser = $_SESSION["user"]; 

        $newList = [
            'listId' => uniqid(), 
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

    public function deleteTaskList($listId)
{
    $allTaskLists = $this->getAllTaskLists();
    $currentUser = $_SESSION["user"];
    $isFound = false; 
    $i = 0; 

    while (!$isFound && $i < count($allTaskLists)) {
        if ($allTaskLists[$i]["listId"] === $listId && $allTaskLists[$i]["user"] === $currentUser) {
            array_splice($allTaskLists, $i, 1);
            $isFound = true; 
        } else {
            $i++; 
        }
    }

    if ($isFound) {
        $this->saveTaskLists($allTaskLists);
    }
}
}
