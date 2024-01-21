<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require_once "../app/controllers/class/ToDoController.php";
require_once "../app/controllers/class/TaskController.php";
require_once "../app/controllers/class/UserController.php";

$tarea1 = new Task( "Agregar color fondo", "FrontEnd", "2021-01-01", "2021-01-10", "Pendiente"); 
$tarea2 = new Task( "Crear funcion sumar", "BackEnd", "2022-11-04", "2022-12-15", "En ejecucion"); 

$usuario1 = new User("ribol", "jk2389m");
$usuario2 = new User("rasbil", "nns42l");

$toDo = new ToDo();

$toDo->createTask($tarea2,$usuario1->getNickName());

var_dump($toDo->getTasks());

// CREAR NUEVA TAREA
    $toDo->createTask(new Task("pruebaTarea", "DataScience", "2020-03-12", "2020-03-17","Pendiente"),$usuario2->getNickName());

// BORRAR TAREA
    // $toDo->deleteTask(13);

// ACTUALIZAR UNA TAREA
    // $taskToUpdate= $toDo->searchTask(3);
    // $taskToUpdate["statusTask"]="Finalizada";
    // $toDo->updateTask($taskToUpdate, 3);

// LISTAR POR TIPO DE TAREA
	// $listByTypeTask= $toDo->getUsersAndTasksByType("FronTend");
	// print_r($listByTypeTask);

//BUSCAR POR USUARIO:
    // $searchedUser = "paolo";
    // $filterTasks= $toDo->listByUser($searchedUser);
    // print_r($filterTasks);

//BUSCAR POR TIPO DE TAREA
    // $type = "enviar";
    // $filteredTasks = $toDo->getUsersAndTasksByType($type);
    // print_r($filterTasks);

//BUSCAR POR NOMBRE TAREA
    // $searchedString = "Enviar"; 
    // $filteredTasksbyName = $toDo->getTasksByName($searchedString);
    // print_r($filteredTasksbyName);

?>
<body>
    
</body>
</html>