<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// app/Config/Routes.php

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    // Rota para HomeController
    $routes->get('/', 'HomeController::index');

    // Grupo de rotas para CategoriesController
    $routes->group('categories', function ($routes) {
        $routes->get('/', 'CategoriesController::index');
        $routes->get('new', 'CategoriesController::new');
        $routes->post('create', 'CategoriesController::create');
        $routes->get('edit/(:segment)', 'CategoriesController::edit/$1');
        $routes->put('update/(:segment)', 'CategoriesController::update/$1');
        $routes->delete('delete/(:segment)', 'CategoriesController::delete/$1');
    });
    // Grupo de rotas para CustomersController
    $routes->group('customers', function ($routes) {
        $routes->get('/', 'CustomersController::index');
        $routes->get('show/(:segment)', 'CustomersController::show/$1');
        $routes->get('new', 'CustomersController::new');
        $routes->post('create', 'CustomersController::create');
        $routes->get('edit/(:segment)', 'CustomersController::edit/$1');
        $routes->put('update/(:segment)', 'CustomersController::update/$1');
        $routes->delete('delete/(:segment)', 'CustomersController::delete/$1');


            $routes->group('cars', function ($routes) {

            $routes->get('all/(:segment)', 'CarsController::all/$1');
            $routes->get('new/(:segment)', 'CarsController::new/$1');
            $routes->get('edit/(:segment)', 'CarsController::edit/$1');
            $routes->put('update/(:segment)', 'CarsController::update/$1');
            $routes->post('create/', 'CarsController::create');
            $routes->delete('delete/(:segment)', 'CarsController::delete/$1');
            });
      
    });



    $routes->group('company', function ($routes) {

        $routes->get('/', 'CompanyController::index');
        $routes->match(['post', 'put'], 'process', 'CompanyController::process');
  
    });

    $routes->group('parking', function ($routes) {

        $routes->get('/', 'ParkingController::index');
        $routes->get('show/ticket', 'ParkingController::show');
        $routes->get('close/ticket', 'ParkingController::close');
        //close/ticket;

        $routes->group('single', function ($routes) {

            $routes->post('create/ticket', 'SingleTicketController::create');
            $routes->post('create/ticket', 'SingleTicketController::create');
            $routes->get('new/ticket', 'SingleTicketController::new');
            $routes->get('show/ticket', 'SingleTicketController::create');
            // $routes->match(['post', 'put'], 'process', 'ParkingController::process');

        });

        $routes->group('customers', function ($routes) {

            $routes->post('create/ticket', 'CustomerTicketsController::create');
            $routes->post('create/ticket', 'CustomerTicketsController::create');
            $routes->get('new/ticket', 'CustomerTicketsController::new');
            $routes->get('cars', 'CustomerTicketsController::cars');
            $routes->get('show/ticket', 'CustomerTicketsController::create');
            // $routes->match(['post', 'put'], 'process', 'ParkingController::process');

        });


        $routes->group('close', function ($routes) {

            $routes->get('ticket/(:segment)', 'CloseTicketController::close/$1');
            $routes->put('ticket/process/(:segment)', 'CloseTicketController::process/$1');
            // $routes->match(['post', 'put'], 'process', 'ParkingController::process');

        });




    });
});
