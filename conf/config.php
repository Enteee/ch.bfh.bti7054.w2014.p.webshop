<?php
/*	config_inc.php
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0 
*
*	Configuration file
*	Require:
*
*
*	Licence:
*	You're allowed to edit and publish my source in all of your free and open-source projects.
*	Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
*	Leave this Header untouched!
*
*	Warranty:
*		Warranty void if signet is broken
*	================== / /===================
*	[    Waranty      / /    Signet         ]
*	=================/ /=====================
*	!!Wo0t!!
*/

/*General configuration*/
$config['title'] = 'Codeshop';
$config['subtitle'] = 'never code again';
$config['logo'] = '../layout/img/logo.png';
$config['favicon'] = '../layout/img/favicon.gif';
$config['author'] = 'winki,dbigler,ente';
$config['page_url'] = 'http://www.codeshop.ch';
$config['mail'] = 'ducksource@duckpond.ch';

/*DEFINES*/
$config['debug'] = TRUE;
$config['timezone'] = 'Europe/Zurich';

/*Composer autoload*/
$config['composer']['autoload.php'] = '../vendor/autoload.php';

/*Propel conf*/
$config['propel_conf'] = '../conf/propel-codeshop-conf.php';
$config['propel_model'] = '../model/';

/*Google api conf*/
$config['gitkit']['server-config'] = '../conf/gitkit-server-config.json';
//require_once('../conf/google_api_key.php');

/*Paths for includes*/
$config['include_handler'] = '../controller/include_handler_inc.php';
$config['includes'][] = '../conf/';
$config['includes'][] = '../controller/';
$config['includes'][] = '../controller/classes/';
//$config['includes'][] = '../model/';
//$config['includes'][] = '../model/om/';
//$config['includes'][] = '../model/map/';
//$config['includes'][] = '../model/map/';
$config['includes'][] = '../www/js/';
$config['includes'][] = '../www/css/';
$config['includes'][] = '../www/bootstrap/js/';
$config['includes'][] = '../www/bootstrap/css/';

/*Special includes*/
$config['doctype'] = 'doctype_inc.html';	// where is the document type located
$config['head'] = 'head_inc.php';	// where is the header located
$config['scriptinc'] = 'script_inc.php';	// where is the script includer located
$config['css'][] = 'bootstrap.min.css';	// bootstrap css
$config['css'][] = 'layout.main.css';	// layouting 
$config['css'][] = 'style.main.css';	// syling css
$config['jincludes'][] = 'jquery-1.11.0.js';
$config['jincludes'][] = 'bootstrap.min.js';
$config['jincludes'][] = 'utils.js';
$config['jincludes'][] = 'dojs.js';
$config['jincludes'][] = 'read_meta.js';
//gitkit
$config['external_jincludes'][] = '//www.gstatic.com/authtoolkit/js/gitkit.js';
$config['jincludes'][] = 'signin.js';
$config['css'][] = '//www.gstatic.com/authtoolkit/css/gitkit.css';

/*PHP modules*/
//$config['modules'][] = 'pdo_mysql';
?>
