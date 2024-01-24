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
	//Create
	'/createUserForm' => 'application#createUserForm_View',
	//Delete
	'/deleteUserProfile' => 'application#deleteUserProfile_View',
	'/loginUsersForm' => 'application#loginUsersForm_View',
	'/updayeUserProfile' => 'application#updateUserProfile_View',
	'/userProfile' => 'application#userProfile_View',
	'/updateTask' => 'application#updateTask_View'


	
);
