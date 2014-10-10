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

//General configuration
$config['title'] = 'CodeShop';                          // The pagetitel
$config['subtitle'] = 'never code again';               // The subtitel
$config['logo'] = 'layout/img/logo.png';                // The logo
$config['author'] = 'winki,dbigler,ente';               // The authors
$config['page_url'] = 'http://www.codeshop.ch';         // the url to the page
$config['mail'] = 'ducksource@duckpond.ch';             // admin email

// DEFINES
$config['debug'] = TRUE;                                // Debug mode?
$config['timezone'] = 'Europe/Zurich';                  // The Server Timezone

//Database access
$config['db_host'] = 'localhost';
$config['db_user'] = 'webshop';
$config['db_password'] = 'gggggg';
$config['db_database'] = 'duckpond_webshop';

//Paths for includes
$config['includes'][] = './';
$config['includes'][] = 'includes/';
$config['includes'][] = 'includes/classes/';
$config['includes'][] = 'includes/javascript/';
$config['includes'][] = 'layout/includes/';

//Special includes
$config['css'][] = 'layout/css/reset.css';              // reset css
$config['css'][] = 'layout/css/fonts.css';              // fints css
$config['css'][] = 'layout/css/layout.css';             // layouting css
$config['css'][] = 'layout/css/style.css';              // syling css
$config['doctype'] = 'doctype_inc.html';                // where is the document type located
$config['head'] = 'head_inc.php';                       // where is the header located
$config['scriptinc'] = 'script_inc.php';                // where is the script includer located
$config['defaultjs'][] = 'utils.js';                    // wait until page load then do some basic js..
$config['defaultjs'][] = 'dojs.js';                     // wait until page load then do some basic js..
$config['defaultjs'][] = 'read_meta.js';                // read metadata of page
?>
