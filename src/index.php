<?php
/*  index.php
*   Mischa Lehmann
*   ducksource@duckpond.ch
*   Version:1.0
*
*   Main entrypoint for the whole site
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

/* Include configuration file */
require_once('includes/config_inc.php');

/* Debug settings */
if($config['debug']){
    ini_set('implicit_flush',1);            // flush stdout after each "echo"
    ini_set('display_errors',1);            // show errors
    ini_set('display_startup_errors',1);    // show starup errors
    error_reporting(-1);                    // be verbose as fuck: http://php.net/manual/de/errorfunc.constants.php
}

/* Load needed php modules */
foreach($config['modules'] as $module){
    if (!extension_loaded($module)){
        if(function_exists('dl')){
            if (!dl($module)){
                print('[Error] : Module loading failed');
                exit;
            }
        }else{
            // this happens with PHP > 5.3
            print('[Error] : Can not load module (dl missing)');
            exit;
        }
    }
}

/* Setup include handler */
require_once('includes/include_handler_inc.php');
$inc = new Include_handler($config['includes']);

/* Do includes */
$inc->dorequire('savevars.php');        // save variable layer
$inc->dorequire('db.php');              // database handler
$inc->dorequire('template.php');        // the template system
$inc->dorequire('repository.php');      // the repository
$inc->dorequire('language.php');        // the language handler

/* Create language object */
$langCode = $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$lang = new Language($langCode);


/* Set up SaveVar environment (No direct access to superglobals) */
$save = new SaveVars();
$GLOBALS['save'] = $save;

/* Set up database connection */
//$db = new DB(DB::DRIVER_MYSQL,
//                $config['db_host'],
//                $config['db_user'],
//                $config['db_password'],
//                $config['db_database']);

/* Set up repository */

/* Set up template system */
$page = new Template($inc,$config['doctype'],
                        array( 
                            'title' => $lang->title,
                            'subtitle' => $lang->subtitle,
                            'logo' => $config['logo'],
                            'author' => $config['author'], 
                            'mail' => $config['mail'],
                            'css' => $config['css'],
                            'head' => $config['head'],
                            'scriptinc' => $config['scriptinc'],
                            'jincludes' => $config['defaultjs']
                        ));


/* Set up repository */
$repos = new Repository($inc);
$GLOBALS['repos'] = $repos;


/* Select the page */
$action='';
if($save->save_global('action',SaveVars::T_STRING,SaveVars::G_GET)){
    $action = $save->action;
}

switch($action){
    default: // default page
    case 'start':
        $inc->dorequire('start_inc.php');
    break;
    case 'layout':
        $inc->dorequire('layout_inc.php');
    break;
    case 'sample':
        $inc->dorequire('sample_inc.php');
    break;
}

/* test propel */

/*
// Include the main Propel script
require_once './lib/propelorm/runtime/lib/Propel.php';

// Initialize Propel with the runtime configuration
Propel::init("./conf/propel-codeshop-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("./includes/classes/model" . PATH_SEPARATOR . get_include_path());



// insert test
$product = new Product();
$product->setTitle('test');
$product->setDescription('test jkfgh lsdkfjgh sdk');
$product->save();

// select test
$products = ProductQuery::create()
  ->find();
foreach ($products as $product) {
  echo $product->getTitle() . '<br />';
}
*/


/* Render the page initialized */
$page->render();

?>
