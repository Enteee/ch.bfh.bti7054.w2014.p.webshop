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
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<!-- Additional metadata -->
<?php foreach($metadata as $key => $val): ?>
		<meta name="<?php echo $key;?>" content="<?php echo $val;?>" /> 
<?php endforeach; ?>

		<!-- CSS -->
		<!-- External CSS -->
		<link rel="stylesheet" type="text/css" href="//www.gstatic.com/authtoolkit/css/gitkit.css" />
		<!-- jQuery UI -->
		<link rel="stylesheet" type="text/css" href="plugin/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="plugin/jquery/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="plugin/jquery/jquery-ui.structure.min.css" />
		<link rel="stylesheet" type="text/css" href="plugin/jquery/jquery-ui.theme.min.css" />
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="plugin/bootstrap/css/bootstrap.min.css" />
		<!-- Libraries -->
		<link rel="stylesheet" type="text/css" href="plugin/select2/select2.css" />
		<link rel="stylesheet" type="text/css" href="plugin/select2/select2-bootstrap.css" />
		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="css/layout.main.css" />
		<link rel="stylesheet" type="text/css" href="css/style.main.css" />		
		
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
		<script type="application/javascript" src="plugin/bootstrap/js/jquery-1.11.0.js"></script>
		<script type="application/javascript" src="plugin/jquery/jquery-ui-1.11.2.min.js"></script>
		<script type="application/javascript" src="plugin/bootstrap/js/bootstrap.min.js"></script>
		<script type="application/javascript" src="plugin/select2/select2.min.js"></script>
		<script type="application/javascript" src="//www.gstatic.com/authtoolkit/js/gitkit.js"></script>
		<script type="application/javascript" src="js/signin.js"></script>
		<script type="application/javascript" src="js/application.js"></script>

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
					<a class="navbar-brand" href="/"><img class="cs-logo" src="img/logo_small.png" alt="CodeShop Logo" /></a>
				</div>
				<!-- navigation, search form, login form -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
<?php foreach ($navItems as $navItem): ?>
						<li>
							<a href="<?php echo $navItem['url']; ?>"><span class="glyphicon <?php echo $navItem['icon']; ?>" title="<?php echo $navItem['text']; ?>"></span> <span class="cs-nav-text"><?php echo $navItem['text']; ?></span></a>
						</li>
<?php endforeach; ?>
					</ul>
					<!-- search form -->
					<form class="navbar-form navbar-right" role="form" action="product/search" method="get">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" name="search" placeholder="<?php echo label('search'); ?>">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="row">
				<!-- left content -->
				<div class="col-md-3">
					<!-- login form -->
					<div class="form-group">
						<p class="lead"><?php echo label('userPanel'); ?></p>
						
						<ul class="list-group">
							<li class="list-group-item no-padding">
								<div id="signin"></div>
							</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-xs-8">
										<?php echo label('credits') ?>
									</div>
									<div class="col-xs-4 text-right">
										<b><?php echo $userCredits; ?></b>&cent;
									</div>
								</div>
							</li>
						</ul>
					</div>
					<!-- category navigation -->
					<p class="lead"><?php echo label('categories'); ?></p>
					<nav>
						<div class="list-group">
<?php foreach($categories as $category):?>
							<a href="<?php echo lang(); ?>/product/show?categoryId=<?php echo $category->getId(); ?>" class="list-group-item<?php echo ($category->getId() == $activeCategoryId) ? ' active' : ''; ?>">
								<span class="badge"><?php echo $category->getProductsCount(); ?></span>
								<?php $category->setLocale($locale); echo $category->getName(); ?>
							</a>
<?php endforeach; ?>
						</div>
					</nav>
<?php if (count($shoppingCartItems) > 0):?>
					<!-- shopping cart -->
					<p class="lead"><?php echo label('shoppingCart'); ?></p>
					<ul class="list-group">
	<?php foreach($shoppingCartItems as $shoppingCartItem):?>
						<li class="list-group-item">
							<div class="row">
								<div class="col-xs-2 text-right">
									<button type="button" class="btn btn-xs btn-default">
										<span class="glyphicon glyphicon-remove"></span>
									</button>
								</div>
								<div class="col-xs-6">
									<?php echo $shoppingCartItem->getProduct()->getName(); ?>
								</div>
								<div class="col-xs-4 text-right">
									<b><?php echo $shoppingCartItem->getPrice(); ?></b>&cent;
								</div>
							</div>
						</li>
	<?php endforeach; ?>
						<li class="list-group-item list-group-item-info">
							<div class="row">
								<div class="col-xs-6 col-xs-offset-2">
									Total
								</div>
								<div class="col-xs-4 text-right">
									<b><?php echo $shoppingCartTotalPrice; ?></b>&cent;
								</div>
							</div>
						</li>
					</ul>
					<div>
						<form action="product/buy" method="post">
							<button type="submit" class="btn btn-default btn-block"><?php echo label('buy'); ?></button>
						</form>
						<br />
					</div>
<?php endif; ?>
				</div>
				<!-- right content -->
				<div class="col-md-9">
