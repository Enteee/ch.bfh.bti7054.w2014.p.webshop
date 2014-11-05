<?php
/*	start_inc.php
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0
*
*	start page
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

if(!defined('INCLUDED')){
	exit('Go away!');
}

/* Load relevant GET's */
$searchstring = NULL;
if($this->save->save_global('searchstring',SaveVars::T_STRING,SaveVars::G_GET)){
	$searchstring = $this->save->searchstring;
}
$category_id = NULL;
if($this->save->save_global('category_id',SaveVars::T_STRING,SaveVars::G_GET)){
	$category_id = $this->save->category_id;
}

/* Load data */
//$categories = $this->repos->get_all_categories();
$categories = array();

$products = array();
if(isset($category_id)){
//	$products = $this->repos->get_products_by_tag_id($category_id,$searchstring);
}else{
//	$products = $this->repos->get_products($searchstring);
}

/* Initialize template */
$this->page->init('start.php',
	array( 
		'categories' => $categories,
		'products' => $products,
		'active_category' => $category_id
	),
	array(
	)
);
?>
