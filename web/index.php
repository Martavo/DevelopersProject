<?php

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);
date_default_timezone_set('CET');

// defines the web root
define('WEB_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], '/index.php')));
// defindes the path to the files
define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
// defines the cms path
define('CMS_PATH', ROOT_PATH . '/lib/base/');

// starts the session
session_start();

// includes the system routes. Define your own routes in this file
include(ROOT_PATH . '/config/routes.php');

/**
 * Standard framework autoloader
 * @param string $className
 */
function autoloader($className) {
	// controller autoloading
	if (strlen($className) > 10 && substr($className, -10) == 'Controller') {
		if (file_exists(ROOT_PATH . '/app/controllers/' . $className . '.php') == 1) {
			require_once ROOT_PATH . '/app/controllers/' . $className . '.php';
		}
	}
	else {
		if (file_exists(CMS_PATH . $className . '.php')) {
			require_once CMS_PATH . $className . '.php';
		}
		else if (file_exists(ROOT_PATH . '/lib/' . $className . '.php')) {
			require_once ROOT_PATH . '/lib/' . $className . '.php';
		}
		else {
			require_once ROOT_PATH . '/app/models/'.$className.'.php';
		}
	}
}

// activates the autoloader
spl_autoload_register('autoloader');

$router = new Router();
$router->execute($routes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require_once "../../../controllers/class/ToDoController.php";
require_once "../../../controllers/class/TaskController.php";
require_once "../../../controllers/class/UserController.php";

$tarea1 = new Task( "Agregar color fondo", taskType::FRONTEND, "2021-01-01", "2021-01-10", taskStatus::PENDIENTE); 
$tarea2 = new Task( "Crear funcion sumar", taskType::BACKEND, "2022-11-04", "2022-12-15", taskStatus::EN_EJECUCION); 

$usuario1 = new User("ribol", "jk2389m");
$usuario2 = new User("rasbil", "nns42l");

$toDo = new ToDo();
$toDo->createTask($tarea2,$usuario1);

var_dump($toDo->getTasks());

//codigo para buscar por usuario:
$searchedUser = "paolo";
$filterTasks= $toDo->listByUser($searchedUser);


//codigo para buscar por tipo de tarea
$selectedType = taskType::FRONTEND; 
$filteredTasks = $toDo->getUsersAndTasksByType($selectedType);


//codigo ejemplo para buscar por nombre tarea
$searchedString = "Enviar"; 
$filteredTasksbyName = $toDo->getTasksByName($searchedString);

?>
<body>
    
</body>
</html>