<?php
require_once(__DIR__ . '../../models/class/ToDoModel.php');
require_once(__DIR__ . '/../../lib/base/Controller.php');


class TaskController extends Controller
{
    private $toDo;

    public function __construct()
    {
        $this->toDo = new ToDo();
    }

    public function listTasksAction()
    {
        echo "estas en el listTasksAction";
    }

}