	<head>
		<!-- Page information -->
		<title><?php echo $this->title;?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="subtitle" content="<?php echo $this->subtitle;?>" />
		<meta name="author" content="<?php echo $this->author;?>" />
		<meta name="contact" content="<?php echo $this->mail;?>" />

		<!-- Additional metadata -->
<?php foreach($this->metadata as $key => $val): ?>
		<meta name="<?php echo $key;?>" content="<?php echo $val;?>" /> 
<?php endforeach; ?>

		<!-- CSS -->
		<meta http-equiv="content-style-type" content="text/css" />
<?php foreach($this->external_css as $css): ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $css;?>" />
<?php endforeach; ?>
<?php foreach($this->css as $css): ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $this->getpath($css);?>" />
<?php endforeach; ?>

		<!-- favicon -->
		<link rel="icon" type="image/gif" href="<?php echo $this->getpath($this->favicon);?>" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
