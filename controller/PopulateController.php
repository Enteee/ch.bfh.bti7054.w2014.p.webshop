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
		
		$this->addProgrammingLanguages($tagTypeProgrammingLanguage);

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
		$reviewHelloTest = (new Review())
			->setUser($userTest)
			->setProduct($helloWorld)
			->setText('Sehr geiles Produkt! Kann ich nur weiterempfehlen.')
			->setRating(1);
		$reviewHelloTest->save();
		$reviewHelloTest = (new Review())
			->setUser($userTest)
			->setProduct($helloWorld)
			->setText('Sehr geiles Produkt! Kann ich nur weiterempfehlen.')
			->setRating(1);
		$reviewHelloTest->save();
		$reviewHelloTest = (new Review())
			->setUser($userTest)
			->setProduct($helloWorld)
			->setText('Sehr geiles Produkt! Kann ich nur weiterempfehlen.')
			->setRating(3);
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
	
	public function addProgrammingLanguages($tagTypeProgrammingLanguage){
		$languages = array(
			'A# .NET',
			'A#',
			'A-0 System',
			'A+',
			'A++',
			'ABAP',
			'ABC',
			'ABC ALGOL',
			'ABLE',
			'ABSET',
			'ABSYS',
			'ACC',
			'Accent',
			'Ace DASL',
			'ACL2',
			'ACT-III',
			'Action!',
			'ActionScript',
			'Ada',
			'Adenine',
			'Agda',
			'Agilent VEE',
			'Agora',
			'AIMMS',
			'Alef',
			'ALF',
			'ALGOL 58',
			'ALGOL 60',
			'ALGOL 68',
			'ALGOL W',
			'Alice',
			'Alma-0',
			'AmbientTalk',
			'Amiga E',
			'AMOS',
			'AMPL',
			'APL',
			'App Inventor for Android\'s visual block language',
			'AppleScript',
			'Arc',
			'ARexx',
			'Argus',
			'AspectJ',
			'Assembly language',
			'ATS',
			'Ateji PX',
			'AutoHotkey',
			'Autocoder',
			'AutoIt',
			'AutoLISP / Visual LISP',
			'Averest',
			'AWK',
			'Axum',
			'B',
			'Babbage',
			'Bash',
			'BASIC',
			'bc',
			'BCPL',
			'BeanShell',
			'Batch (Windows/Dos)',
			'Bertrand',
			'BETA',
			'Bigwig',
			'Bistro',
			'BitC',
			'BLISS',
			'Blue',
			'Bon',
			'Boo',
			'Boomerang',
			'Bourne shell',
			'BREW',
			'BPEL',
			'C',
			'C--',
			'C++',
			'C#',
			'C/AL',
			'Caché ObjectScript',
			'C Shell',
			'Caml',
			'Candle',
			'Cayenne',
			'CDuce',
			'Cecil',
			'Cel',
			'Cesil',
			'Ceylon',
			'CFEngine',
			'CFML',
			'Cg',
			'Ch',
			'Chapel',
			'CHAIN',
			'Charity',
			'Charm',
			'Chef',
			'CHILL',
			'CHIP-8',
			'chomski',
			'ChucK',
			'CICS',
			'Cilk',
			'CL',
			'Claire',
			'Clarion',
			'Clean',
			'Clipper',
			'CLIST',
			'Clojure',
			'CLU',
			'CMS-2',
			'COBOL',
			'Cobra',
			'CODE',
			'CoffeeScript',
			'Cola',
			'ColdC',
			'ColdFusion',
			'COMAL',
			'Combined Programming Language',
			'COMIT',
			'Common Intermediate Language',
			'Common Lisp',
			'COMPASS',
			'Component Pascal',
			'Constraint Handling Rules',
			'Converge',
			'Cool',
			'Coq',
			'Coral 66',
			'Corn',
			'CorVision',
			'COWSEL',
			'CPL',
			'csh',
			'CSP',
			'Csound',
			'CUDA',
			'Curl',
			'Curry',
			'Cyclone',
			'Cython',
			'D',
			'DASL',
			'Dart',
			'DataFlex',
			'Datalog',
			'DATATRIEVE',
			'dBase',
			'dc',
			'DCL',
			'Deesel',
			'Delphi',
			'DCL',
			'DinkC',
			'DIBOL',
			'Dog',
			'Draco',
			'DRAKON',
			'Dylan',
			'DYNAMO',
			'E',
			'E#',
			'Ease',
			'Easy PL/I',
			'Easy Programming Language',
			'EASYTRIEVE PLUS',
			'ECMAScript',
			'Edinburgh IMP',
			'EGL',
			'Eiffel',
			'ELAN',
			'Elixir',
			'Elm',
			'Emacs Lisp',
			'Emerald',
			'Epigram',
			'EPL',
			'Erlang',
			'es',
			'Escapade',
			'Escher',
			'ESPOL',
			'Esterel',
			'Etoys',
			'Euclid',
			'Euler',
			'Euphoria',
			'EusLisp Robot Programming Language',
			'CMS EXEC',
			'EXEC 2',
			'Executable UML',
			'F',
			'F#',
			'Factor',
			'Falcon',
			'Fancy',
			'Fantom',
			'FAUST',
			'Felix',
			'Ferite',
			'FFP',
			'Fjölnir',
			'FL',
			'Flavors',
			'Flex',
			'FLOW-MATIC',
			'FOCAL',
			'FOCUS',
			'FOIL',
			'FORMAC',
			'@Formula',
			'Forth',
			'Fortran',
			'Fortress',
			'FoxBase',
			'FoxPro',
			'FP',
			'FPr',
			'Franz Lisp',
			'F-Script',
			'FSProg',
			'G',
			'Google Apps Script',
			'Game Maker Language',
			'GameMonkey Script',
			'GAMS',
			'GAP',
			'G-code',
			'Genie',
			'GDL',
			'Gibiane',
			'GJ',
			'GEORGE',
			'GLSL',
			'GNU E',
			'GM',
			'Go',
			'Go!',
			'GOAL',
			'Gödel',
			'Godiva',
			'GOM (Good Old Mad)',
			'Goo',
			'Gosu',
			'GOTRAN',
			'GPSS',
			'GraphTalk',
			'GRASS',
			'Groovy',
			'Hack (programming language)',
			'HAL/S',
			'Hamilton C shell',
			'Harbour',
			'Hartmann pipelines',
			'Haskell',
			'Haxe',
			'High Level Assembly',
			'HLSL',
			'Hop',
			'Hope',
			'Hugo',
			'Hume',
			'HyperTalk',
			'IBM Basic assembly language',
			'IBM HAScript',
			'IBM Informix-4GL',
			'IBM RPG',
			'ICI',
			'Icon',
			'Id',
			'IDL',
			'Idris',
			'IMP',
			'Inform',
			'Io',
			'Ioke',
			'IPL',
			'IPTSCRAE',
			'ISLISP',
			'ISPF',
			'ISWIM',
			'J',
			'J#',
			'J++',
			'JADE',
			'Jako',
			'JAL',
			'Janus',
			'JASS',
			'Java',
			'JavaScript',
			'JCL',
			'JEAN',
			'Join Java',
			'JOSS',
			'Joule',
			'JOVIAL',
			'Joy',
			'JScript',
			'JScript .NET',
			'JavaFX Script',
			'Julia',
			'Jython',
			'K',
			'Kaleidoscope',
			'Karel',
			'Karel++',
			'KEE',
			'Kixtart',
			'KIF',
			'Kojo',
			'Kotlin',
			'KRC',
			'KRL',
			'KRYPTON',
			'ksh',
			'L',
			'L# .NET',
			'LabVIEW',
			'Ladder',
			'Lagoona',
			'LANSA',
			'Lasso',
			'LaTeX',
			'Lava',
			'LC-3',
			'Leda',
			'Legoscript',
			'LIL',
			'LilyPond',
			'Limbo',
			'Limnor',
			'LINC',
			'Lingo',
			'Linoleum',
			'LIS',
			'LISA',
			'Lisaac',
			'Lisp',
			'Lite-C',
			'Lithe',
			'Little b',
			'Logo',
			'Logtalk',
			'LPC',
			'LSE',
			'LSL',
			'LiveCode',
			'LiveScript',
			'Lua',
			'Lucid',
			'Lustre',
			'LYaPAS',
			'Lynx',
			'M2001',
			'M4',
			'Machine code',
			'MAD',
			'MAD/I',
			'Magik',
			'Magma',
			'make',
			'Maple',
			'MAPPER',
			'MARK-IV',
			'Mary',
			'MASM Microsoft Assembly x86',
			'Mathematica',
			'MATLAB',
			'Maxima',
			'Max',
			'MaxScript',
			'Maya (MEL)',
			'MDL',
			'Mercury',
			'Mesa',
			'Metacard',
			'Metafont',
			'MetaL',
			'Microcode',
			'MicroScript',
			'MIIS',
			'MillScript',
			'MIMIC',
			'Mirah',
			'Miranda',
			'MIVA Script',
			'ML',
			'Moby',
			'Model 204',
			'Modelica',
			'Modula',
			'Modula-2',
			'Modula-3',
			'Mohol',
			'MOO',
			'Mortran',
			'Mouse',
			'MPD',
			'MSIL',
			'MSL',
			'MUMPS',
			'NASM',
			'NATURAL',
			'Napier88',
			'Neko',
			'Nemerle',
			'nesC',
			'NESL',
			'Net.Data',
			'NetLogo',
			'NetRexx',
			'NewLISP',
			'NEWP',
			'Newspeak',
			'NewtonScript',
			'NGL',
			'Nial',
			'Nice',
			'Nickle',
			'NPL',
			'Not eXactly C',
			'Not Quite C',
			'NSIS',
			'Nu',
			'NWScript',
			'NXT-G',
			'o:XML',
			'Oak',
			'Oberon',
			'Obix',
			'OBJ2',
			'Object Lisp',
			'ObjectLOGO',
			'Object REXX',
			'Object Pascal',
			'Objective-C',
			'Objective-J',
			'Obliq',
			'Obol',
			'OCaml',
			'occam',
			'occam-π',
			'Octave',
			'OmniMark',
			'Onyx',
			'Opa',
			'Opal',
			'OpenCL',
			'OpenEdge ABL',
			'OPL',
			'OPS5',
			'OptimJ',
			'Orc',
			'ORCA/Modula-2',
			'Oriel',
			'Orwell',
			'Oxygene',
			'Oz',
			'P#',
			'ParaSail (programming language)',
			'PARI/GP',
			'Pascal',
			'Pawn',
			'PCASTL',
			'PCF',
			'PEARL',
			'PeopleCode',
			'Perl',
			'PDL',
			'PHP',
			'Phrogram',
			'Pico',
			'Picolisp',
			'Pict',
			'Pike',
			'PIKT',
			'PILOT',
			'Pipelines',
			'Pizza',
			'PL-11',
			'PL/0',
			'PL/B',
			'PL/C',
			'PL/I',
			'PL/M',
			'PL/P',
			'PL/SQL',
			'PL360',
			'PLANC',
			'Plankalkül',
			'Planner',
			'PLEX',
			'PLEXIL',
			'Plus',
			'POP-11',
			'PostScript',
			'PortablE',
			'Powerhouse',
			'PowerBuilder',
			'PowerShell',
			'PPL',
			'Processing',
			'Processing.js',
			'Prograph',
			'PROIV',
			'Prolog',
			'PROMAL',
			'Promela',
			'PROSE modeling language',
			'PROTEL',
			'ProvideX',
			'Pro*C',
			'Pure',
			'Python',
			'Q (equational programming language)',
			'Q (programming language from Kx Systems)',
			'Qalb',
			'Qi',
			'QtScript',
			'QuakeC',
			'QPL',
			'R',
			'R++',
			'Racket',
			'RAPID',
			'Rapira',
			'Ratfiv',
			'Ratfor',
			'rc',
			'REBOL',
			'Red',
			'Redcode',
			'REFAL',
			'Reia',
			'Revolution',
			'rex',
			'REXX',
			'Rlab',
			'RobotC',
			'ROOP',
			'RPG',
			'RPL',
			'RSL',
			'RTL/2',
			'Ruby',
			'RuneScript',
			'Rust',
			'S',
			'S2',
			'S3',
			'S-Lang',
			'S-PLUS',
			'SA-C',
			'SabreTalk',
			'SAIL',
			'SALSA',
			'SAM76',
			'SAS',
			'SASL',
			'Sather',
			'Sawzall',
			'SBL',
			'Scala',
			'Scheme',
			'Scilab',
			'Scratch',
			'Script.NET',
			'Sed',
			'Seed7',
			'Self',
			'SenseTalk',
			'SequenceL',
			'SETL',
			'Shift Script',
			'SIMPOL',
			'SIMSCRIPT',
			'Simula',
			'Simulink',
			'SISAL',
			'SLIP',
			'SMALL',
			'Smalltalk',
			'Small Basic',
			'SML',
			'SNOBOL(SPITBOL)',
			'Snowball',
			'SOL',
			'Span',
			'SPARK',
			'SPIN',
			'SP/k',
			'SPS',
			'Squeak',
			'Squirrel',
			'SR',
			'S/SL',
			'Stackless Python',
			'Starlogo',
			'Strand',
			'Stata',
			'Stateflow',
			'Subtext',
			'SuperCollider',
			'SuperTalk',
			'Swift (Apple programming language)',
			'Swift (parallel scripting language)',
			'SYMPL',
			'SyncCharts',
			'SystemVerilog',
			'T',
			'TACL',
			'TACPOL',
			'TADS',
			'TAL',
			'Tcl',
			'Tea',
			'TECO',
			'TELCOMP',
			'TeX',
			'TEX',
			'TIE',
			'Timber',
			'TMG',
			'Tom',
			'TOM',
			'Topspeed',
			'TPU',
			'Trac',
			'TTM',
			'T-SQL',
			'TTCN',
			'Turing',
			'TUTOR',
			'TXL',
			'TypeScript',
			'Turbo C++',
			'Ubercode',
			'UCSD Pascal',
			'Umple',
			'Unicon',
			'Uniface',
			'UNITY',
			'Unix shell',
			'UnrealScript',
			'Vala',
			'VBA',
			'VBScript',
			'Verilog',
			'VHDL',
			'Visual Basic',
			'Visual Basic .NET',
			'Visual DataFlex',
			'Visual DialogScript',
			'Visual Fortran',
			'Visual FoxPro',
			'Visual J++',
			'Visual J#',
			'Visual Objects',
			'Visual Prolog',
			'VSXu',
			'Vvvv',
			'WATFIV, WATFOR',
			'WebDNA',
			'WebQL',
			'Windows PowerShell',
			'Winbatch',
			'Wolfram',
			'Wyvern',
			'X++',
			'X#',
			'X10',
			'XBL',
			'XC',
			'xHarbour',
			'XL',
			'Xojo',
			'XOTcl',
			'XPL',
			'XPL0',
			'XQuery',
			'XSB',
			'XSLT',
			'Xtend',
			'Yorick',
			'YQL',
			'Z notation',
			'Zeno',
			'ZOPL',
			'ZPL');
		foreach ($languages as $language) {
			$pl = new Tag();
			$pl = (new Tag())
				->setTagType($tagTypeProgrammingLanguage)
				->setLocale('en_US')
					->setName($language) 
				->setLocale('de_CH')
					->setName($language)
				->save();		
		}
	}
}

?>
