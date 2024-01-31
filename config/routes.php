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
	// Pagina principal
		'/' => 'User#index',
	// USUARIOS
		// Formulario Login usuario
		'/loginUsersForm_View'=> 'User#loginUsersForm_View',
		//Crear un usuario
		'/createUsersForm_View' => 'User#createUsersForm_View',
		// Validacion login usuario
		'/checkLogin'=> 'User#checkLogin',
		// Cerrar sesion del usuario
		'closeUserSession'=> 'User#closeUserSession',
	// TAREAS
		// Listar todas las tareas
		'/tasksList_View' => 'Task#tasksList_View',
		// Borrar Tarea
		'/deleteTask' => 'Task#deleteTask',
		// Insertar una nueva tarea
		'/insertTask'=> 'Task#insertTask',
		// Editar una tarea
		'/editTask'=> 'editTask',
	//Borrar un usuario
	//login usuario
	//Actualizar perfil de un usuario
	//Ver perfil de un usuario
	//Actualizar una tarea
	//Valida el usuario existe en la BBDD
	//Cierra la sesion del usuario
	//Crear un nuevo usuario
	
);
