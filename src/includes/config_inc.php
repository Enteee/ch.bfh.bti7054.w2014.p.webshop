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
$config['subtitle'] = 'never code again';               // The subtitel..
$config['author'] = 'ente';                             // The Author
$config['page_url'] = 'www.codeshop.ch';                // the url to the page
$config['mail'] = 'ducksource@duckpond.ch';             // admin email

// DEFINES
$config['debug'] = TRUE;                                // Debug mode?
$config['max_space'] = 1073741824;                      // Maximum physical space for the site (in bytes) NOTE: You maybe have to alter post_max_size and upload_max_filesize in php.ini
$config['upload_directory'] = '/home/ente/web/upload/'; // The directory for uploaded files (shouldnt be directly accessible)
$config['tmp_upload_directory'] = '/tmp';
$config['timezone'] = 'Europe/Zurich';                  // The Server Timezone

//Database access
$config['db_host'] = 'localhost';
$config['db_user'] = 'canyouholdthis';
$config['db_password'] = 'gggggg';
$config['db_database'] = 'duckpond_webshop';

//Paths for includes
$config['includes'][] = './';
$config['includes'][] = 'includes/';
$config['includes'][] = 'includes/classes/';
$config['includes'][] = 'includes/javascript/';
$config['includes'][] = 'layout/includes/';

//Special includes
$config['css'] = 'layout/stylesheet/greenorange.css';   // the default stylesheet of the page
$config['doctype'] = 'doctype_inc.html';                // where is the document type located
$config['scriptinc'] = 'script_inc.php';                // where is the script includer located
$config['defaultjs'][] = 'utils.js';                    // wait until page load then do some basic js..
$config['defaultjs'][] = 'dojs.js';                     // wait until page load then do some basic js..
$config['defaultjs'][] = 'read_meta.js';                // read metadata of page
?>
