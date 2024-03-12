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
		'/user-index' => 'User#index',
		// Formulario Login usuario
		'/login-users-form_view'=> 'User#loginUsersForm_View',
		//Crear un usuario
		'/create-users-form_view' => 'User#createUsersForm_View',
		// Validacion login usuario
		'/check-login'=> 'User#checkLogin',
		// Cerrar sesion del usuario
		'/close-user-session'=> 'User#closeUserSession',
		//Crear un nuevo usuario
		'/create-user' => 'User#createUser',
		//Borrar un usuario
		'/delete-user' => 'User#deleteUser',
		//Editar un usuario
		'/update-user' => 'User#updateUser',
		//Ver perfil de un usuario
		'/user-profile_view'  => 'User#userProfile_View',
		
	// TAREAS:
		// Listar todas las tareas
		'/all-tasks_view'=> 'Task#allTasks_View',
		// Borrar Tarea
		'/delete-task' => 'Task#deleteTask',
		// Insertar una nueva tarea
		'/insert-task'=> 'Task#insertTask',
		// Pre-edicion de una tarea
		'/update-task_View'=> 'Task#UpdateTask_View',
		// Edicion tarea
		'/update-task'=>'Task#updateTask',
		// FILTROS:
			// Filtrar por nombre de tarea
			'/filter-by-task-name_view'=>'Task#filterByTaskName_View',
			// Filtrar por tipo de tarea
			'/filter-by-task-type_view'=>'Task#filterByTaskType_View',
		// Listas de tareas
		'/list_view'=>'Task#list_view',

	// LISTA DE TAREAS:
		//vista de la lista de tareas
		'/task-list_view'=> 'TaskList#TaskList_View',
		//vista para crear lista
		'/createlist_view'=> 'TaskList#createlist_View',
		//crear una lista
		'/create-list'=> 'TaskList#createTaskList',
		//eliminar una lista
		'/delete-list' => 'TaskList#deleteList',
		//modificar una lista
		'/updateList'=> 'TaskList#updateList',
		//vista para modificar una lista
		'/update-list_view' => 'TaskList#updatelist_View',
	
		
		
	
	
);
