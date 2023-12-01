<?php
use App\Controllers\Compte;
use App\Controllers\Accueil;
use App\Controllers\Scenario;
use App\Controllers\Actualite;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Accueil::class, 'afficher']);
$routes->get('/compte/lister', [Compte::class, 'lister']);
$routes->get('actualite/afficher', [Actualite::class, 'afficher']);
$routes->get('actualite/afficher/(:num)', [Actualite::class, 'afficher']);
$routes->get('scenario/lister', [Scenario::class, 'lister']);
$routes->get('scenario/afficher_scenarios', [Scenario::class, 'afficher_scenarios']);
$routes->get('scenario/afficher_1ere_etape/(:any)/(:num)', [Scenario::class, 'afficher_1ere_etape']);
$routes->get('scenario/afficher_1ere_etape/(:any)/', [Scenario::class, 'afficher_1ere_etape']);
$routes->get('scenario/afficher_1ere_etape/', [Scenario::class, 'afficher_1ere_etape']);
$routes->get('scenario/afficher_scenario/(:any)', [Scenario::class, 'afficher_scenario']);
$routes->get('scenario/afficher_scenario/', [Scenario::class, 'afficher_scenario']); 
$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']); 
$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);
$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);
$routes->get('compte/afficher_accueil', [Compte::class, 'afficher_accueil']);
$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']); 
$routes->get('compte/modifier', [Compte::class, 'modifier']); 
$routes->post('compte/modifier', [Compte::class, 'modifier']);
