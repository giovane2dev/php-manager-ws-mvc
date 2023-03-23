<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . '/vendor/autoload.php';
require 'init.php';

$container = new \Slim\Container();

$app = new Slim\App($container);

unset($app->getContainer()['notFoundHandler']);
$app->getContainer()['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('A página que você procura não existe!');
    };
};

// <editor-fold defaultstate="collapsed" desc="LOGIN ROUTES">

// create login
// create login page
$app->get('/', function ($request) {
    $LoginController = new App\Controllers\LoginController();
    $LoginController->createLogin();
});

// create login
// create login page -> process
$app->post('/readcreatelogin', function () {
    $LoginController = new App\Controllers\LoginController();
    $LoginController->readCreateLogin();
});

// exit login
$app->get('/exit', function () {
    $LoginController = new App\Controllers\LoginController();
    $LoginController->exitLogin();
});

//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="NEWS ROUTES">

/* CREATE */

// create news
// create news page
$app->get('/createnews/{category_id}', function ($request) {
    $category_id = $request->getAttribute('category_id');

    $NewsController = new App\Controllers\NewsController();
    $NewsController->createNews($category_id);
});

// create news
// create news page -> process
$app->post('/storecreatenews', function () {
    $NewsController = new App\Controllers\NewsController();
    $NewsController->storeCreateNews();
});

/* READ */

// news list
// news page
$app->get('/news/{category_id}', function ($request) {
    $category_id = $request->getAttribute('category_id');

    $NewsController = new App\Controllers\NewsController();
    $NewsController->readNews($category_id);
});

/* UPDATE */

// update news
// update news page
$app->get('/updatenews/{id}/{category_id}', function ($request) {
    $id = $request->getAttribute('id');
    $category_id = $request->getAttribute('category_id');

    $NewsController = new App\Controllers\NewsController();
    $NewsController->updateNews($id, $category_id);
});

// update news
// update news page -> process
$app->post('/storeupdatenews', function () {
    $NewsController = new App\Controllers\NewsController();
    $NewsController->storeUpdateNews();
});

/* DELETE */

// delete news
// delete news page
$app->get('/deletenews/{id}/{category_id}', function ($request) {
    $id = $request->getAttribute('id');
    $category_id = $request->getAttribute('category_id');

    $NewsController = new App\Controllers\NewsController();
    $NewsController->deleteNews($id, $category_id);
});

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="CATEGORIES ROUTES">

/* CREATE */

// create categories
// create categories page
$app->get('/createcategories', function () {
    $CategoriesController = new App\Controllers\CategoriesController();
    $CategoriesController->createCategories();
});

// create categories
// create categories page -> process
$app->post('/storecreatecategories', function () {
    $CategoriesController = new App\Controllers\CategoriesController();
    $CategoriesController->storeCreateCategories();
});

/* READ */

// categories list
// categories page
$app->get('/categories', function () {
    $CategoriesController = new App\Controllers\CategoriesController();
    $CategoriesController->readCategories();
});

/* UPDATE */

// update categories
// update categories page
$app->get('/updatecategories/{id}', function ($request) {
    $id = $request->getAttribute('id');

    $CategoriesController = new App\Controllers\CategoriesController();
    $CategoriesController->updateCategories($id);
});

// update categories
// update categories page -> process
$app->post('/storeupdatecategories', function () {
    $CategoriesController = new App\Controllers\CategoriesController();
    $CategoriesController->storeUpdateCategories();
});

/* DELETE */

// delete categories
// delete categories page
$app->get('/deletecategories/{id}', function ($request) {
    $id = $request->getAttribute('id');

    $CategoriesController = new App\Controllers\CategoriesController();
    $CategoriesController->deleteCategories($id);
});

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="SUBCATEGORIES ROUTES">

/* CREATE */

// create categories
// create categories page
$app->get('/createsubcategories/{category_id}', function ($request) {
    $category_id = $request->getAttribute('category_id');

    $SubcategoriesController = new App\Controllers\SubcategoriesController();
    $SubcategoriesController->createSubcategories($category_id);
});

// create categories
// create categories page -> process
$app->post('/storecreatesubcategories', function () {
    $SubcategoriesController = new App\Controllers\SubcategoriesController();
    $SubcategoriesController->storeCreateSubcategories();
});

/* READ */

// categories list
// categories page
$app->get('/subcategories/{category_id}', function ($request) {
    $category_id = $request->getAttribute('category_id');

    $SubcategoriesController = new App\Controllers\SubcategoriesController();
    $SubcategoriesController->readSubcategories($category_id);
});

/* UPDATE */

// update categories
// update categories page
$app->get('/updatesubcategories/{id}', function ($request) {
    $id = $request->getAttribute('id');

    $SubcategoriesController = new App\Controllers\SubcategoriesController();
    $SubcategoriesController->updateSubcategories($id);
});

// update categories
// update categories page -> process
$app->post('/storeupdatesubcategories', function () {
    $SubcategoriesController = new App\Controllers\SubcategoriesController();
    $SubcategoriesController->storeUpdateSubcategories();
});

/* DELETE */

// delete categories
// delete categories page
$app->get('/deletesubcategories/{id}', function ($request) {
    $id = $request->getAttribute('id');

    $SubcategoriesController = new App\Controllers\SubcategoriesController();
    $SubcategoriesController->deleteSubcategories($id);
});

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="ERRORS ROUTES">

// create erros
// create erros page
$app->get('/error/{id}', function ($request) {
    $id = $request->getAttribute('id');

    $ErrosController = new App\Controllers\ErrorsController();
    $ErrosController->readErros($id);
});

// </editor-fold>

$app->run();
