<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!-- Page information -->
		<base href="http://codeshop.ch">
		<title><?php echo $title; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="subtitle" content="<?php echo $subtitle; ?>" />
		<meta name="author" content="<?php echo $author; ?>" />
		<meta name="contact" content="<?php echo $contact; ?>" />

		<!-- Additional metadata -->
<?php foreach($metadata as $key => $val): ?>
		<meta name="<?php echo $key;?>" content="<?php echo $val;?>" /> 
<?php endforeach; ?>

		<!-- CSS -->
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="css/layout.main.css">
		<link rel="stylesheet" type="text/css" href="css/style.main.css">
		<!-- External CSS -->
		
		<!-- favicon -->
		<link rel="icon" type="image/gif" href="img/favicon.gif" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<noscript>
			<div class="noscript">
				<p class="noscript">This page works better with enabled Javascript</p>
			</div>
		</noscript>
		<!-- Javascript -->
		<!-- Microsoft READ THIS: http://www.rfc-editor.org/rfc/rfc4329.txt  !! You are obsolete !! -->
		<script type="application/javascript" src="bootstrap/js/jquery-1.11.0.js"></script>
		<script type="application/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<script type="application/javascript" src="//www.gstatic.com/authtoolkit/js/gitkit.js"></script>
		<script type="application/javascript" src="js/signin.js"></script>

		<!-- navigation -->
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- logo -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><img class="cs-logo" src="img/logo_small.png" alt="CodeShop Logo" /></a>
				</div>
				<!-- navigation, search form, login form -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="#"><span class="glyphicon glyphicon-user" title="My items"></span> <span class="cs-nav-text">My items</span></a>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-shopping-cart" title="Shopping cart"></span> <span class="cs-nav-text">Shopping cart</span></a>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-folder-open" title="My products"></span> <span class="cs-nav-text">My products</span></a>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-plus" title="Add product"></span> <span class="cs-nav-text">Add product</span></a>
						</li>
					</ul>
					<!-- search form -->					
					<form class="navbar-form navbar-right" role="form">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</nav>