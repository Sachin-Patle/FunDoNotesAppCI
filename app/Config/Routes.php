<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UserController');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);


/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'UserController::login');

/**
 * Routes of UserController class 
 * @description
 * Handling login, registration of user
 * Working with Sessions
 */
$routes->get('register', 'UserController::register');
$routes->get('login', 'UserController::login');
$routes->get('logout', 'UserController::logout');
$routes->post('registration', 'UserController::user_registration');
$routes->post('user_login', 'UserController::user_login');

/**
 * Routes of NotesController class 
 * @description
 * Handling CRUD operations for notes
 */
$routes->get('notes', 'NotesController::notes');
$routes->get('archive', 'NotesController::archive');
$routes->get('trash', 'NotesController::trash');
$routes->post('get-note', 'NotesController::single_note');
$routes->get('notes-list', 'NotesController::notes_list');
$routes->get('notes-by-label', 'NotesController::notes_list_by_label');
$routes->post('save-note', 'NotesController::save_note');
$routes->post('delete-note', 'NotesController::delete_note');
$routes->post('update-note', 'NotesController::update_note');
$routes->post('set-archive', 'NotesController::set_archive');
$routes->post('unset-archive', 'NotesController::unset_archive');
$routes->get('archive-list', 'NotesController::archive_list');
$routes->get('trash-list', 'NotesController::trash_list');
$routes->post('trash-note', 'NotesController::trash_note');
$routes->post('restore-note', 'NotesController::restore_note');

/**
 * Routes of LabelsController class 
 * @description
 * Handling CRUD operations for labels
 */
$routes->get('labels', 'LabelsController::labels');
$routes->post('get-label', 'LabelsController::single_label');
$routes->get('labels-list', 'LabelsController::labels_list');
$routes->get('labels-list-on-form', 'LabelsController::labels_list_on_form');
$routes->post('save-label', 'LabelsController::save_label');
$routes->post('delete-label', 'LabelsController::delete_label');
$routes->post('update-label', 'LabelsController::update_label');
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}



