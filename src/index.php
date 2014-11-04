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
require_once('conf/config.php');

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

/* Set up composer autoload */
require_once($config['composer']['autoload.php']);

/* Set up include handler */
require_once('includes/include_handler_inc.php');
$inc = new Include_handler($config['includes']);
spl_autoload_register(array('Include_handler', 'autoload'));

/* Set up Propel */
Propel::init($config['propel_conf']);

/* Set up google client */
$gitkitClient = Gitkit_Client::createFromFile($config['gitkit']['server-config']);
$gitkitUser = $gitkitClient->getUserInRequest();

/* Create language object */
$langCode = $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$lang = new Language($langCode);

/* Set up SaveVar environment (No direct access to superglobals) */
$save = new SaveVars();
$GLOBALS['save'] = $save;

/* Set up repository */
//$repos = new Repository();
//$GLOBALS['repos'] = $repos;

/* Set up template system */
$page = new Template($inc,$config['doctype'],
                        array( 
                            'title' => $lang->title,
                            'subtitle' => $lang->subtitle,
                            'logo' => $config['logo'],
                            'favicon' => $config['favicon'],
                            'author' => $config['author'], 
                            'mail' => $config['mail'],
                            'css' => $config['css'],
                            'head' => $config['head'],
                            'scriptinc' => $config['scriptinc'],
                            'jincludes' => $config['jincludes'],
                            'external_jincludes' => $config['external_jincludes'],
                        ));

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
    case 'gitkit':
        $inc->dorequire('gitkit_inc.php');
    break;
    case 'sample':
        $inc->dorequire('sample_inc.php');
    break;
}



// insert test
//$product = new Product();
//$product->setTitle('test');
//$product->setDescription('test jkfgh lsdkfjgh sdk');
//$product->save();

/*
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
