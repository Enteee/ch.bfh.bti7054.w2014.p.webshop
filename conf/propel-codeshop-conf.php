<?php
// This file generated by Propel 1.7.1 convert-conf target
// from XML runtime conf file /srv/http/webshop/propel/conf/runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'codeshop' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'dsn' => 'mysql:host=127.0.0.1;dbname=codeshop',
        'user' => 'codeshop',
        'password' => 'gggggg',
      ),
    ),
    'default' => 'codeshop',
  ),
  'generator_version' => '1.7.1',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'propel-codeshop-classmap.php');
return $conf;