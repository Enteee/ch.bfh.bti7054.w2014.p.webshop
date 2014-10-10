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

/*Include configuration file*/
require_once('includes/config_inc.php');

/*Setup include handler*/
require_once('includes/include_handler_inc.php');
$inc = new Include_handler($config['includes']);

/*do includes*/
$inc->dorequire('savevars.php');        // save variable layer
//$inc->dorequire('db.php');              // database handler
$inc->dorequire('template.php');        // the template system

/*Setup SaveVar environment (No direct access to superglobals)*/
$save = new SaveVars();

/*setup database connection*/
//$db = new DB(DB::DRIVER_MYSQL,
//                $config['db_host'],
//                $config['db_user'],
//                $config['db_password'],
//                $config['db_database']);

/*setup the template system*/
$page = new Template($inc,$config['doctype'],
                        array( 
                            'title' => $config['title'],
                            'subtitle' => $config['subtitle'],
                            'logo' => $config['logo'],
                            'author' => $config['author'], 
                            'mail' => $config['mail'],
                            'css' => $config['css'],
                            'head' => $config['head'],
                            'scriptinc' => $config['scriptinc'],
                            'jincludes' => $config['defaultjs']
                        ));

/*Select the page*/
$action='';
if($save->save_global('action',SaveVars::T_STRING,SaveVars::G_GET)){
    $action = $save->action;
}

switch($action){
    default: // default page
    case 'start':
        $inc->dorequire('start_inc.php');
    break;
    case 'sample':
        $inc->dorequire('sample_inc.php');
    break;
}

/* render the page initialized */
$page->render();

?>
