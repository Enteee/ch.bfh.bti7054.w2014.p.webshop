<?php

/*
 * Populate db
 */
class PopulateController extends Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		if($this->config['debug'] == false){
			die('go away!');
		}

		/* Tag types */
		$tagTypeUser = (new TagType())
			->setLocale('en_US')
				->setName('User tag') 
			->setLocale('de_CH')
				->setName('Benutzertag'); 
		$tagTypeUser->save();

		$tagTypeCategory = (new TagType())
			->setLocale('en_US')
				->setName('Category') 
			->setLocale('de_CH')
				->setName('Kategorie');
		$tagTypeCategory->save();

		$tagTypeProgrammingLanguage = (new TagType())
			->setLocale('en_US')
				->setName('Programming language') 
			->setLocale('de_CH')
				->setName('Programmiersprache');
		$tagTypeProgrammingLanguage->save();

		/* Tags */
		$tagSnippets = (new Tag())
			->setTagType($tagTypeCategory)
			->setLocale('en_US')
				->setName('Snippets') 
			->setLocale('de_CH')
				->setName('Snippets');
		$tagSnippets->save();

		$tagScripts = (new Tag())
			->setTagType($tagTypeCategory)
			->setLocale('en_US')
				->setName('Scripts') 
			->setLocale('de_CH')
				->setName('Skripte');
		$tagScripts->save();

		$tagFullSoftware = (new Tag())
			->setTagType($tagTypeCategory)
			->setLocale('en_US')
				->setName('Full software') 
			->setLocale('de_CH')
				->setName('Komplette Software');
		$tagFullSoftware->save();

		$tagClasses = (new Tag())
			->setTagType($tagTypeCategory)
			->setLocale('en_US')
				->setName('Classes') 
			->setLocale('de_CH')
				->setName('Klassen');
		$tagClasses->save();

		$tagFramework = (new Tag())
			->setTagType($tagTypeCategory)
			->setLocale('en_US')
				->setName('Framework') 
			->setLocale('de_CH')
				->setName('Framework');
		$tagSnippets->save();

		$tagC = (new Tag())
			->setTagType($tagTypeProgrammingLanguage)
			->setLocale('en_US')
				->setName('C') 
			->setLocale('de_CH')
				->setName('C');
		$tagC->save();

		$tagJava = (new Tag())
			->setTagType($tagTypeProgrammingLanguage)
			->setLocale('en_US')
				->setName('Java') 
			->setLocale('de_CH')
				->setName('Java');
		$tagJava->save();

		$tagPhp = (new Tag())
			->setTagType($tagTypeProgrammingLanguage)
			->setLocale('en_US')
				->setName('PHP') 
			->setLocale('de_CH')
				->setName('PHP');
		$tagPhp->save();

		$tagLisp = (new Tag())
			->setTagType($tagTypeProgrammingLanguage)
			->setLocale('en_US')
				->setName('Lisp') 
			->setLocale('de_CH')
				->setName('Lisp');
		$tagLisp->save();

		/* Products */
		$helloWorld = (new Product())
			->addTag($tagSnippets)
			->addTag($tagScripts)
			->addTag($tagClasses)
			->addTag($tagFullSoftware)
			->addTag($tagFramework)
			->setLocale('en_US')
				->setName('Hello world') 
				->setDescription('The famous hello world snippets')
			->setLocale('de_CH')
				->setName('HAllo Welt')
				->setDescription('Das berühmte Hallo Welt Snippet');
		$helloWorld->save();
		
		$bubbleSort = (new Product())
			->addTag($tagSnippets)
			->addTag($tagScripts)
			->setLocale('en_US')
				->setName('Bubble sort') 
				->setDescription('Basic sort method')
			->setLocale('de_CH')
				->setName('Blasen sort')
				->setDescription('Standard Sortieralgorithmus');
		$bubbleSort->save();

		$quickSort = (new Product())
			->addTag($tagSnippets)
			->addTag($tagScripts)
			->addTag($tagClasses)
			->addTag($tagFullSoftware)
			->setLocale('en_US')
				->setName('Quick sort') 
				->setDescription('Fast sort method')
			->setLocale('de_CH')
				->setName('Schnell sort')
				->setDescription('Schneller Sortieralgorithmus');
		$quickSort->save();

		/* Users */
		$userTest = (new User())
			->setEmail('testuser@gmail.com')
			->setCredits('1000');
		$userTest->save();

		/*Reviews*/
		$reviewHelloTest = (new Review())
			->setUser($userTest)
			->setProduct($helloWorld)
			->setText('Sehr geiles Produkt! Kann ich nur weiterempfehlen.')
			->setRating(5);
		$reviewHelloTest->save();

		/*Offers*/
		$offer1 = (new Offer())
			->setProduct($helloWorld)
			->setPrice(100);
		$offer1->save();
		
		$offer2 = (new Offer())
			->setProduct($bubbleSort)
			->setPrice(1000);
		$offer2->save();

		$offer3 = (new Offer())
			->setProduct($quickSort)
			->setPrice(250);
		$offer3->save();
	}
	
}

?>
