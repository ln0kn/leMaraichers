<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', 'HomeController@index')->name('home');

///////////////////////////////////Produit routes
Route::get('/produit', 'ProduitController@index')->name('produit');
Route::get('/getProduit', 'ProduitController@getProduit')->name('getProduit');
Route::post('/addProduit', 'ProduitController@addProduit')->name('addProduit');
Route::put('/updateProduit', 'ProduitController@updateProduit')->name('updateProduit');
Route::delete('/deleteProduit', 'ProduitController@deleteProduit')->name('deleteProduit');
//////////////////////////////////


///////////////////////////////////Fournisseur routes
Route::get('/getFournisseur', 'FournisseurController@getFournisseur')->name('getFournisseur');
Route::post('/addFournisseur', 'FournisseurController@addFournisseur')->name('addFournisseur');
Route::put('/updateFournisseur', 'FournisseurController@updateFournisseur')->name('updateFournisseur');
Route::delete('/deleteFournisseur', 'FournisseurController@deleteFournisseur')->name('deleteFournisseur');
//////////////////////////////////


///////////////////////////////////Client routes
Route::get('/client', 'ClientController@index')->name('client');
Route::get('/getClient', 'ClientController@getClient')->name('getClient');
Route::post('/addClient', 'ClientController@addClient')->name('addClient');
Route::put('/updateClient', 'ClientController@updateClient')->name('updateClient');
Route::delete('/deleteClient', 'ClientController@deleteClient')->name('deleteClient');
//////////////////////////////////


///////////////////////////////////Versement routes
Route::get('/getHistorique', 'VersementController@getHistorique')->name('getHistorique');
Route::get('/getVersement', 'VersementController@getVersement')->name('getVersement');
Route::post('/addVersement', 'VersementController@addVersement')->name('addVersement');
//Route::put('/updateVersement', 'VersementController@updateVersement')->name('updateVersement');
//Route::delete('/deleteVersement', 'VersementController@deleteVersement')->name('deleteVersement');
//////////////////////////////////


///////////////////////////////////Approvisionnement routes
Route::get('/approvisionnement', 'ApprovisionnementController@index')->name('approvisionnement');
Route::get('/getApprovisionnement', 'ApprovisionnementController@getApprovisionnement')->name('getApprovisionnement');
Route::post('/addApprovisionnement', 'ApprovisionnementController@addApprovisionnement')->name('addApprovisionnement');
Route::put('/updateApprovisionnement', 'ApprovisionnementController@updateApprovisionnement')->name('updateApprovisionnement');
Route::delete('/deleteApprovisionnement', 'ApprovisionnementController@deleteApprovisionnement')->name('deleteApprovisionnement');
//////////////////////////////////


///////////////////////////////////Approvisionnement routes
Route::get('/urlPlus', 'StockController@urlPlus')->name('urlPlus');
//////////////////////////////////


///////////////////////////////////vente routes
Route::get('/vente', 'VenteController@index')->name('vente');
Route::get('/getVente', 'VenteController@getVente')->name('getVente');
Route::post('/addVente', 'VenteController@addVente')->name('addVente');
Route::put('/updateVente', 'VenteController@updateVente')->name('updateVente');
Route::delete('/deleteVente', 'VenteController@deleteVente')->name('deleteVente');
Route::post('/factureVente', 'VenteController@factureVente')->name('factureVente');
//////////////////////////////////



///////////////////////////////////depense routes
Route::get('/getDepense', 'DepenseController@getDepense')->name('getDepense');
Route::post('/addDepense', 'DepenseController@addDepense')->name('addDepense');
Route::put('/updateDepense', 'DepenseController@updateDepense')->name('updateDepense');
Route::delete('/deleteDepense', 'DepenseController@deleteDepense')->name('deleteDepense');
//////////////////////////////////



///////////////////////////////////cloture routes
Route::get('/getCloture', 'ClotureController@getCloture')->name('getCloture');
Route::post('/addCloture', 'ClotureController@addCloture')->name('addCloture');
Route::post('/bilan', 'ClotureController@bilan')->name('bilan');

//////////////////////////////////


///////////////////////////////////stock routes
Route::get('/stock', 'StockController@index')->name('stock');
Route::get('/getStock', 'StockController@getStock')->name('getStock');
Route::post('/addStock', 'StockController@addStock')->name('addStock');
//Route::post('/addStock', 'StockController@addStock')->name('addStock');
//////////////////////////////////


///////////////////////////////////stock routes
Route::post('/addAjustement', 'StockController@addAjustement')->name('addAjustement');
Route::get('/getAjustement', 'StockController@getAjustement')->name('getAjustement');
//////////////////////////////////


///////////////////////////////////stock routes
Route::post('/addRebut', 'RebutController@addRebut')->name('addRebut');
Route::get('/getRebut', 'RebutController@getRebut')->name('getRebut');
//////////////////////////////////


///////////////////////////////////user routes
Route::delete('/deleteUser', 'Auth\RegisterController@deleteUser')->name('deleteUser');
Route::put('/updateUser', 'Auth\RegisterController@updateUser')->name('updateUser');
Route::post('/addUser', 'Auth\RegisterController@addUser')->name('addUser');
Route::get('/getUser', 'Auth\RegisterController@getUser')->name('getUser');
//////////////////////////////////

//
//Route::get('/parametre', function () {
//    return view('mesVues.parametres');
//});

Route::get('/autre', function () {
    return view('mesVues.autre');
});
//
//
//Route::get('/vente', function () {
//    return view('mesVues.ventes');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
