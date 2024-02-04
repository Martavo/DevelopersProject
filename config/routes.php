<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an cont =roller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
	// PAGINA PRINCIPAL
		'/' => 'User#index',

	// USUARIOS:
	    //index route
		'/userIndex' => 'User#index',
		// Formulario Login usuario
		'/loginUsersForm_View'=> 'User#loginUsersForm_View',
		//Crear un usuario
		'/createUsersForm_View' => 'User#createUsersForm_View',
		// Validacion login usuario
		'/checkLogin'=> 'User#checkLogin',
		// Cerrar sesion del usuario
		'/closeUserSession'=> 'User#closeUserSession',
		//Crear un nuevo usuario
		'/createUser' => 'User#createUser',
		//Borrar un usuario
		'/deleteUser' => 'User#deleteUser',
		//Editar un usuario
		'/updateUser' => 'User#updateUser',
		//Ver perfil de un usuario
		'/userProfile_View'  => 'User#userProfile_View',
		
	// TAREAS:
		// Listar todas las tareas
		'/tasksList_View'=> 'Task#tasksList_View',
		// Borrar Tarea
		'/deleteTask' => 'Task#deleteTask',
		// Insertar una nueva tarea
		'/insertTask'=> 'Task#insertTask',
		// Pre-edicion de una tarea
		'/UpdateTask_View'=> 'Task#UpdateTask_View',
		// Edicion tarea
		'/updateTask'=>'Task#updateTask',
		// FILTROS:
			// Filtrar por usuario
			'/filterByUser_View'=>'Task#filterByUser_View',
			// Filtrar por nombre de tarea
			'/filterByTaskName_View'=>'Task#filterByTaskName_View',
			// Filtrar por tipo de tarea
			'/filterByTaskType_View'=>'Task#filterByTaskType_View',

	
	
	
);
