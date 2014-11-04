<html xmlns="http://www.w3.org/1999/xhtml">
<?php   $this->inc->doinclude($this->head); ?>
    <body>
<?php   $this->inc->doinclude($this->scriptinc); ?>
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
                    <a class="navbar-brand" href="#"><img class="cs-logo" src="layout/img/logo_small.png" alt="CodeShop Logo" /></a>
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
        
        <!-- page content -->
        <div class="container">
            <div class="row">
                <!-- left content -->
                <div class="col-md-3">
                    <!-- login form -->
                    <p class="lead">Login</p>
                    <form class="clearfix">
                        <div class="form-group input-group-sm">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                        <div class="form-group input-group-sm">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-default btn-sm">Register</button>
                            <button type="submit" class="btn btn-default btn-sm">Login</button> 
                        </div>                  
                    <!-- category navigation -->
                    <p class="lead">Categories</p>
                    <nav>
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <span class="badge">123</span>
                                Active category TEST
                            </a>
<?php   							foreach($this->categories as $category):?>
                            <a href="#" class="list-group-item">
                                <span class="badge"><?php echo $category->getProductsCount(); ?></span>
                                <?php echo $category->getTitle(); ?>
                            </a>
<?php   							endforeach; ?>
                        </div>
                    </nav>
                </div>
                <!-- right content -->
                <div class="col-md-9">
                    <p class="lead">Products</p>                
                    <!-- item list -->                  
                    <div class="list-group">
<?php                   foreach($this->products as $product): ?>
                        <div href="#" class="list-group-item">
                            <h4 class="list-group-item-heading"><?php echo $product->getTitle(); ?></h4>
                            <p class="list-group-item-text"><?php echo $product->getDescription(); ?></p>
                        </div>
<?php                   endforeach; ?>
                    </div>
                    <!-- product details -->            
                    <?php   foreach($this->products as $product): ?>
                    <div class="cs-product-picture thumbnail">
                        <img class="img-responsive" src="http://soniqdesigns.com/wp/wp-content/uploads/2013/05/MarkupCode.gif" alt="">
                        <div class="caption-full">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#"><?php echo $product->getTitle(); ?></a></h4>
                            <div class="labels">
<?php                       foreach($product->getTags() as $tag):?> 
                                <span class="label label-default"><?php echo $tag; ?></span>
<?php                       endforeach; ?>
                            </div>
                            <div class="cs-product-description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                            </div>
                            <div class="cs-options">
                                <span>Language:</span>
                                <select>
<?php                           foreach($product->get_languages() as $language): ?>
                                    <option><?php echo $language ?></option>
<?php                           endforeach;?>
                                </select>
                                <span>Version:</span>
                                <select>
<?php                           foreach($product->get_versions() as $version): ?>
                                    <option><?php echo $version ?></option>
<?php                           endforeach;?>
                                </select>
                                <span>Comments:</span>
                                <input type="checkbox" checked="checked"></input>
                                <span>Support:</span>
                                <input type="checkbox"></input>  
                            </div>
                        </div>
                        <div class="cs-ratings">
                            <p class="pull-right">reviews <span class="badge">6</span></p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                4.0 stars
                            </p>
                        </div>
                    </div>
                    <?php   endforeach; ?>
                    <!-- comments -->
                    <div class="well well-sm">
                        <div class="text-right">
                            <a class="btn btn-default btn-sm">Leave a Review</a>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                Anonymous
                                <span class="pull-right">10 days ago</span>
                                <p>This product was great in terms of quality. I would definitely buy another!</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                Anonymous
                                <span class="pull-right">12 days ago</span>
                                <p>I've alredy ordered another one!</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                Anonymous
                                <span class="pull-right">15 days ago</span>
                                <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- footer -->
        <footer class="cs-footer">
            <div class="container">
                <p class="cs-copyright text-muted">Copyright &copy; 2014 CodeShop</p>
            </div>
        </footer>
    </body>
</html>
