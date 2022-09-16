<?php

namespace Config;

// Create a new instance of our RouteCollection class.

use App\Controllers\ClientController;
use app\Controllers\modalController;
use App\Controllers\ReportController;
use App\Controllers\ReturnsController;


$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UserController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//Reports
$routes->get('report','ReportController::index',['filter'=>'auth']);
$routes->get('dailyreport','ReportController::export',['filter'=>'auth']);
//faults
$routes->post('save-fault','ReturnsController::savefault',['filter'=>'auth']);
$routes->get('loadTbl','ReturnsController::returnsTbl',['filter'=>'auth']);
$routes->get('search','ReturnsController::search',['filter'=>'auth']);
$routes->get('get/unit/(:num)','ReturnsController::get_unit/$1');
$routes->get('exportUnits/(:any)','DeviceExportController::exportUnit/$1');
$routes->get('exportUnits','DeviceExportController::exportUnit');
$routes->get('removeImage/(:num)','UnitsController::rmImage/$1',['filter'=>'auth']);
//returns
$routes->get('return','ReturnsController::index',['filter'=>'auth']);
$routes->post('save-unit','ReturnsController::insertReturn',['filter'=>'auth']);
$routes->get('home', 'HomeController::index',['filter'=>'auth']);
$routes->get('home', 'HomeController::totalInstallation',['filter'=>'auth']);
$routes->get('returns/delete/(:any)','ReturnsController::delete/$1',['filter'=>'auth']);
$routes->get('return/view/(:num)','ReturnsController::editReturn/$1',['filter'=>'auth']);
$routes->post('returns/update','ReturnsController::update',['filter'=>'auth']);
$routes->get('checkups','CheckupController::index',['filter'=>'auth']);
$routes->post('checkup/add','CheckupController::addCheckup',['filter'=>'auth']);
$routes->get('checkups/load','CheckupController::checkupsTbl',['filter'=>'auth']);
$routes->get('checkups/edit/(:num)','CheckupController::edit/$1',['filter'=>'auth']);
$routes->post('checkups/update','CheckupController::update',['filter'=>'auth']);
$routes->get('checkups/delete/(:any)','CheckupController::delete/$1',['filter'=>'auth']);
//transfer routes
$routes->get('transfer','TransController::index',['filter'=>'auth']);
$routes->post('transfer/update','TransController::update',['filter'=>'auth']);
$routes->post('transfer/unitChange','TransController::unitChange',['filter'=>'auth']);
$routes->post('transfer/clientChange','TransController::clientChange',['filter'=>'auth']);
$routes->match(['get','post'],'transfer/transferTbl','TransController::transferTbl',['filter'=>'auth']);
$routes->get('changes/report','ChangesController::downloadExcelReport');
$routes->get('changes/view/(:num)','TransController::transrecords/$1');
//accessories crud routes
$routes->get('accessories','AccessController::index',['filter'=>'auth']);
$routes->match(['get','post'],'accessories','AccessController::insert',['filter'=>'auth']);
$routes->get('accessory/load','AccessController::accessoryTbl',['filter'=>'auth']);
$routes->get('accview/load','AccessController::viewAccTbl',['filter'=>'auth']);
$routes->get('accessory/delete/(:any)','AccessController::delete/$1',['filter'=>'auth']);
//Improved Accessories
$routes->get('accss','AddAccessController::index',['filter'=>'auth']);
$routes->get('accss/load','AddAccessController::accviewTbl',['filter'=>'auth']);
$routes->match(['get','post'],'accss/add','AddAccessController::insert',['filter'=>'auth']);
$routes->get('accss/edit/(:num)','AddAccessController::edit/$1',['filter'=>'auth']);
$routes->post('accss/update','AddAccessController::update',['filter'=>'auth']);
//units crud routes
$routes->get('units', 'UnitsController::index',['filter'=>'auth']);
$routes->get('add-unit','AddUnitController::index',['filter'=>'auth']);
$routes->post('create-unit','AddUnitController::AddUnit',['filter'=>'auth']);
$routes->match(['get','post'],'units', 'UnitsController::insert',['filter'=>'auth']);
$routes->post('units/update','UnitsController::update',['filter'=>'auth']);
$routes->get('units/edit/(:num)','UnitsController::edit/$1',['filter'=>'auth']);
$routes->get('units/view/(:num)','UnitsController::viewUnit/$1',['filter'=>'auth']);
$routes->get('units/load','UnitsController::unitsTbl',['filter'=>'auth']);
$routes->get('units/delete/(:any)','UnitsController::delete/$1',['filter'=>'auth']);
//archive crud routes
$routes->get('archive/units', 'ArchiveController::index',['filter'=>'auth']);
$routes->get('archive/edit/(:num)','ArchiveController::edit/$1',['filter'=>'auth']);
$routes->get('archive/view/(:num)','ArchiveController::viewUnit/$1',['filter'=>'auth']);
$routes->get('archive/load','ArchiveController::unitsTbl',['filter'=>'auth']);
//user crud routes
$routes->match(['get','post'],'login','UserController::index',['filter'=>'noauth']);
$routes->get('user','UserController::getData',['filter'=>'auth']);
$routes->get('user/edit/(:num)','UserController::edit/$1',['filter'=>'auth']);
$routes->post('user/update','UserController::update',['filter'=>'auth']);
$routes->get('user/delete/(:num)','UserController::delete/$1',['filter'=>'auth']);
$routes->match(['get','post'],'user/add','UserController::insert',['filter'=>'auth']);
$routes->match(['get','post'],'user/logout','UserController::logout');
$routes->match(['get','post'],'user/userTbl','UserController::usersTbl',['filter'=>'auth']);
//Client crud routes
$routes->get('client/edit/(:num)','ClientController::edit/$1',['filter'=>'auth']);
$routes->post('client/update/(:num)','ClientController::Update/$1',['filter'=>'auth']);
$routes->match(['get','post'],'client/insert','ClientController::insert',['filter'=>'auth']);
$routes->get('client','ClientController::index',['filter'=>'auth']);
$routes->get('client/delete/(:any)','ClientController::del/$1',['filter'=>'auth']);
$routes->get('clientTbl','ClientController::clientsTbl',['filter'=>'auth']);
// Removals
$routes->get('removals', 'RemovalsController::index',['filter'=>'auth']);
$routes->get('removals/load','RemovalsController::removalsTbl',['filter'=>'auth']);
$routes->get('removals/view/(:num)','RemovalsController::viewUnit/$1',['filter'=>'auth']);
$routes->get('removals/restore/(:any)','RemovalsController::restore/$1',['filter'=>'auth']);
// Armings
$routes->get('armings', 'ArmingController::index',['filter'=>'auth']);
$routes->post('import-csv', 'ArmingController::importCsvToDb');
$routes->get('armings/load','ArmingController::armingsTbl',['filter'=>'auth']);
/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
