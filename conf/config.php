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
$config['logo'] = 'logo_small.png';
$config['favicon'] = 'favicon.gif';
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
$config['propel_model'] = '../';

/*Google api conf*/
$config['gitkit']['server-config'] = '../conf/gitkit-server-config.json';
//require_once('../conf/google_api_key.php');

/*Paths to views*/
$config['view'] = '../view/';
/*Paths for includes (include_handeler.php)*/
$config['include_handler'] = '../controller/include_handler_inc.php';
$config['include_path'][] = '../conf/';
$config['include_path'][] = '../controller/';
$config['include_path'][] = '../controller/classes/';
$config['include_path'][] = $config['view'];
/*Path for ref (Template.php)*/
$config['ref_base'] = '../www/';
$config['ref_path'][] = 'js/';
$config['ref_path'][] = 'css/';
$config['ref_path'][] = 'img/';
$config['ref_path'][] = 'bootstrap/js/';
$config['ref_path'][] = 'bootstrap/css/';

/*Special includes*/
$config['doctype'] = 'doctype_inc.html';	// where is the document type located
$config['head'] = 'head_inc.php';	// where is the header located
$config['scriptinc'] = 'script_inc.php';	// where is the script includer located
// bootstrap
$config['js'][] = 'jquery-1.11.0.js';
$config['css'][] = 'bootstrap.min.css';	// bootstrap css
$config['js'][] = 'bootstrap.min.js';
// gitkit
$config['external_js'][] = '//www.gstatic.com/authtoolkit/js/gitkit.js';
$config['js'][] = 'signin.js';
$config['external_css'][] = '//www.gstatic.com/authtoolkit/css/gitkit.css';
// own stuff
$config['css'][] = 'layout.main.css';	// layouting 
$config['css'][] = 'style.main.css';	// syling css
//$config['js'][] = 'utils.js';
//$config['js'][] = 'dojs.js';
//$config['js'][] = 'read_meta.js';

/*PHP modules*/
//$config['modules'][] = 'pdo_mysql';
?>
