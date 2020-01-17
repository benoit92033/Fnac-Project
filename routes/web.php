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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'RechercheController@index');
Route::get('/isadmin', 'AdminController@isadmin');
//Route::get('/musics', 'MusicController@all');
Route::post('/searchResult', 'RechercheController@recherche');

//MON COMPTE
Route::get('/MonCompte', 'MonCompteController@user_profil'); 
Route::get('/editCompte', 'MonCompteController@edit');
Route::post('/updateUser', 'MonCompteController@update');

//SERVICE COM
Route::get('/serviceCom', 'ServiceComController@allAvisAbusif');
Route::post('/delAvisAbusif', 'ServiceComController@delAvisAbusif');

//SERVICE VENTE
Route::get('/serviceVente', 'ServiceVenteController@index');
Route::post('/ajouterRayon', 'ServiceVenteController@ajouterRayon');
Route::post('/ajouterPhoto', 'ServiceVenteController@ajouterPhoto');

//SERVICE ADHERENT
Route::get('/serviceAdherent', 'ServiceAdherentController@index');
Route::post('/serviceAdherent', 'ServiceAdherentController@index');

//PANIER
Route::post('/delMusique', 'PanierController@delMusique');
Route::post('/delAllPanier', 'PanierController@delAllPanier');
Route::get('/panier', 'PanierController@panier');
Route::post('/panier', 'PanierController@panier');
Route::post('/addPanier', 'PanierController@addMusique');

//AVIS
Route::post('/avisUtileInutile', 'AvisController@utileInutile');
Route::post('/avis', 'AvisController@allAvis');
Route::post('/avisAbusif', 'AvisController@avisAbusif');
Route::post('/avisNegatif', 'AvisController@avisNegatif');
Route::post('/formAddAvis', 'AvisController@formAddAvis');
Route::post('/addAvis', 'AvisController@addAvis');

//FAVORIS
Route::post('/delFavori', 'FavorisController@delFavori');
Route::get('/favoris', 'FavorisController@favoris');
Route::post('/addFavori', 'FavorisController@addFavori');


//COMMANDE
Route::post('/commande', 'CommandeController@commande');