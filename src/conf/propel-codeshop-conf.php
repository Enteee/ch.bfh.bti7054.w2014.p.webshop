<?php
// This file generated by Propel 1.7.1 convert-conf target
// from XML runtime conf file C:\Users\Mathias\Documents\GitHub\ch.bfh.bti7054.w2014.p.webshop\src\database\runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'codeshop' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'dsn' => 'mysql:host=localhost;dbname=codeshop',
        'user' => 'codeshop',
        'password' => 'codeshop',
      ),
    ),
    'default' => 'codeshop',
  ),
  'generator_version' => '1.7.1',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'propel-codeshop-classmap.php');
return $conf;