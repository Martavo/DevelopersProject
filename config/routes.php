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
<<<<<<< Updated upstream
	// Formulario Login
	'/loginUsersForm_View'=> 'User#loginUsersForm_View',
	//Crear un usuario
	'/createUsersForm_View' => 'User#createUsersForm_View',
	// validacion login
	'/checkLogin'=> 'User#checkLogin',
	// Listar todas las tareas
	'/tasksList_View' => 'Task#tasksList_View',
	// Borrar Tarea
	'/deleteTask' => 'Task#deleteTask',


	//Borrar un usuario
	'/deleteUser' => 'User#deleteUser',
=======
	// USUARIOS
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
		
		
	// TAREAS
		// Listar todas las tareas
		'/tasksList_View' => 'Task#tasksList_View',
		// Borrar Tarea
		'/deleteTask' => 'Task#deleteTask',
		// Insertar una nueva tarea
		'/insertTask'=> 'Task#insertTask',
		// Editar una tarea
		'/editTask'=> 'editTask',
>>>>>>> Stashed changes
	//login usuario
	//Actualizar perfil de un usuario
	'/updateUser' => 'User#updateUser',
	//Ver perfil de un usuario
	'/userProfileView' => 'User#userProfile_View'
	//Actualizar una tarea
	//Valida el usuario existe en la BBDD
	//Cierra la sesion del usuario
	
	
);
