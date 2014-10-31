<?php
/*  config_inc.php
*   Mischa Lehmann
*   ducksource@duckpond.ch
*   Version:1.0 
*
*   Configuration file
*   Require:
*
*
*   Licence:
*   You're allowed to edit and publish my source in all of your free and open-source projects.
*   Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
*   Leave this Header untouched!
*
*   Warranty:
*       Warranty void if signet is broken
*   ================== / /===================
*   [   Waranty       / /   Signet          ]
*   =================/ /=====================   
*   !!Wo0t!!
*/

/*General configuration*/
$config['title'] = 'CodeShop';                          // The pagetitel
$config['subtitle'] = 'never code again';               // The subtitel
$config['logo'] = 'layout/img/logo.png';                // The logo
$config['author'] = 'winki,dbigler,ente';               // The authors
$config['page_url'] = 'http://www.codeshop.ch';         // the url to the page
$config['mail'] = 'ducksource@duckpond.ch';             // admin email

/*DEFINES*/
$config['debug'] = TRUE;                                // Debug mode?
$config['timezone'] = 'Europe/Zurich';                  // The Server Timezone

/*Propel conf*/
$config['propel_conf'] = './conf/propel-codeshop-conf.php';

/*Paths for includes*/
$config['includes'][] = './';
$config['includes'][] = 'conf/';
$config['includes'][] = 'lib/propelorm/runtime/lib/';
$config['includes'][] = 'includes/';
$config['includes'][] = 'includes/classes/';
$config['includes'][] = 'includes/classes/model/';
$config['includes'][] = 'includes/classes/model/om/';
$config['includes'][] = 'includes/classes/model/map/';
$config['includes'][] = 'includes/classes/model/map/';
$config['includes'][] = 'includes/javascript/';
$config['includes'][] = 'layout/includes/';
$config['includes'][] = 'layout/bootstrap/js/';

/*Special includes*/
$config['css'][] = 'layout/bootstrap/css/bootstrap.min.css';    // bootstrap css
$config['css'][] = 'layout/css/layout.main.css';                // layouting 
$config['css'][] = 'layout/css/style.main.css';                 // syling css
$config['doctype'] = 'doctype_inc.html';                        // where is the document type located
$config['head'] = 'head_inc.php';                               // where is the header located
$config['scriptinc'] = 'script_inc.php';                        // where is the script includer located
$config['defaultjs'][] = 'jquery-1.11.0.js';                    // jquery
$config['defaultjs'][] = 'bootstrap.min.js';                    // bootstrap
$config['defaultjs'][] = 'utils.js';                            // wait until page load then do some basic js..
$config['defaultjs'][] = 'dojs.js';                             // wait until page load then do some basic js..
$config['defaultjs'][] = 'read_meta.js';                        // read metadata of page

/*PHP modules*/
$config['modules'][] = 'pdo_mysql';                  // the pdo mysql module
?>