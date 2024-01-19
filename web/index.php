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

$tarea1 = new Task( "Agregar color fondo", taskType::FRONTEND, "2021-01-01", "2021-01-10", taskStatus::PENDIENTE); 
$tarea2 = new Task( "Crear funcion sumar", taskType::BACKEND, "2022-11-04", "2022-12-15", taskStatus::EN_EJECUCION); 

$usuario1 = new User("ribol", "jk2389m");
$usuario2 = new User("rasbil", "nns42l");

$toDo = new ToDo();
// CREAR NUEVA TAREA
    // $toDo->createTask($tarea2,$usuario1);

// BORRAR TAREA
    // $toDo->deleteTask(13);

// ACTUALIZAR UNA TAREA
    $taskToUpdate= $toDo->searchTask(3);
    $taskToUpdate["statusTask"]="Finalizada";
    $toDo->updateTask($taskToUpdate, 3);

var_dump($toDo->getTasks());


?>
<body>
    
</body>
</html>