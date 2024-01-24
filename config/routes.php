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
	//Crear un usuario
	'/createUserForm' => 'application#createUserForm_View',
	//Borrar un usuario
	'/deleteUser' => 'models#deleteUser',
	//login usuario
	'/loginUsersForm' => 'application#loginUsersForm_View',
	//Actualizar perfil de un usuario
	'/updateUserProfile' => 'application#updateUserProfile_View',
	//Ver perfil de un usuario
	'/userProfile' => 'application#userProfile_View',
	//Actualizar una tarea
	'/updateTask' => 'application#updateTask_View',
	//Valida el usuario existe en la BBDD
	'/checkLogin' => 'models#checkLogin',
	//Cierra la sesion del usuario
	'/closeSession' => 'models#closeSession',
	//Crear un nuevo usuario
	'/insertUsersData' => 'models#insertUsersData'
	
);
