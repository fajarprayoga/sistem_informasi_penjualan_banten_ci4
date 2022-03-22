<?php namespace Config;

use CodeIgniter\Database\MySQLi\Result;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

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
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->group('auth',['filter' => 'auth_filter'], function ($routes) {
    $routes->get('login', 'Auth::index');
    $routes->post('proses_login', 'Auth::proses_login');
    $routes->post('proses_register', 'Auth::proses_register');
    $routes->get('register', 'Auth::register');
    $routes->get('activate/(:num)/(:any)', 'Auth::activate/$1/$2');
});
$routes->get('auth/logout', 'Auth::logout');

// App/Controller/..../..../

$routes->get('/', 'Market\Home::index');
$routes->get('/market', 'Market\Home::index');
$routes->get('/market/account-number', 'Market\Home::account_number');
$routes->get('/market/term-and-service', 'Market\Home::term_and_service');
$routes->get('market/shop', 'Market\Shop::index');
$routes->get('market/detail/(:num)', 'Market\Detail::index/$1');
$routes->post('/market/add-cart', 'Market\Cart::add');
$routes->get('market/rate/comment', 'Market\Rate::comment');
$routes->group('market',['filter' => 'market_login'], function ($routes) {

    // cart
    $routes->get('cart', 'Market\Cart::index');

    $routes->post('edit-cart', 'Market\Cart::edit');
    $routes->get('destroy-cart', 'Market\Cart::destroy');
    $routes->post('select-destroy-cart', 'Market\Cart::destroyById');

    // checkout
    $routes->get('checkout', 'Market\Checkout::index');
    $routes->post('checkout-process', 'Market\Checkout::process');
    $routes->get('history', 'Market\Checkout::history');
    $routes->get('history-detail/(:num)', 'Market\Checkout::historyDetail/$1');
    $routes->post('upload-token/(:num)', 'Market\Checkout::upload_token/$1');


    $routes->get('profile', 'Market\Profile::index');
    $routes->post('profile/update/', 'Market\Profile::update');
    $routes->post('order-status-market/(:num)', 'Order::update_status_market/$1');


    $routes->post('rate/create', 'Market\Rate::create');
    $routes->get('nota/(:num)', 'Market\Checkout::nota/$1');
});


$routes->group('admin',['filter' => 'admin_login'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    
    // $routes->get('auth/login', 'Auth::login');
    
    $routes->get('dashboard', 'Dashboard::index');
    
    $routes->get('category', 'Category::index');
    $routes->get('category/create', 'Category::create');
    $routes->post('category/store', 'Category::store');
    $routes->get('category/edit/(:num)', 'Category::edit/$1');
    $routes->post('category/update/', 'Category::update');
    $routes->get('category/delete/(:num)', 'Category::delete/$1');
    // $routes->get('tesajax', 'Category::testajax');
    $routes->get('product', 'Product::index');
    $routes->get('product/create', 'Product::create');
    $routes->post('product/store', 'Product::store');
    $routes->get('product/edit/(:num)', 'Product::edit/$1');
    $routes->post('product/update', 'Product::update');
    $routes->get('product/delete/(:num)', 'Product::delete/$1');
    $routes->get('product/show/(:num)', 'Product::show/$1');
    $routes->get('product/report/', 'Product::report');
    
// subcategriy
    $routes->get('sub_category/(:num)', 'SubCategory::sub_category/$1');


    // orders
    $routes->get('order', 'Order::index');
    $routes->get('order-detail/(:num)', 'Order::order_detail/$1');
    $routes->post('order-status/(:num)', 'Order::update_status/$1');
    $routes->get('order/report/', 'Order::report');

    // $routes->get('transaction', 'Transaction::index');
    // $routes->get('transaction/import', 'Transaction::import');
    // $routes->post('transaction/proses_import', 'Transaction::proses_import');
    // $routes->get('transaction/export', 'Transaction::export');


    // user
    $routes->get('user', 'User::index');
    $routes->get('user/edit/(:num)', 'User::edit/$1');
    $routes->post('user/update', 'User::update');
    $routes->get('user/report/', 'User::report');

    $routes->get('report/product', 'Report::product');

    $routes->get('rate/', 'Market\Rate::index');
    $routes->post('rate/(:num)', 'Market\Rate::update/$1');
});

// $routes->group('ui', function ($routes) {
//     $routes->add('users', 'Admin\Users::index');
//     $routes->add('blog', 'Admin\Blog::index');
// });

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
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