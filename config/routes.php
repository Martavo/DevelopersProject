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
	// Validacion Login
	'/checkLoging'=> 'User#checkLogin',
	//Crear un usuario
	'/createUserForm_view' => 'User#createUserForm_view',
	// Listar todas las tareas
	'/listaTareas_View' => 'tasks#listaTareas_View',
	//Borrar un usuario
	//login usuario
	//Actualizar perfil de un usuario
	//Ver perfil de un usuario
	//Actualizar una tarea
	//Valida el usuario existe en la BBDD
	//Cierra la sesion del usuario
	//Crear un nuevo usuario
	
);
