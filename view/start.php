<?php $this->view('header'); ?>
					<p class="lead"><?php echo label('products'); ?></p>
					<!-- item list -->
					<div class="list-group">
<?php foreach($products as $product): ?>
						<div href="#" class="list-group-item">
							<h4 class="list-group-item-heading"><?php $product->setLocale($locale); echo $product->getName(); ?></h4>
							<p class="list-group-item-text"><?php echo $product->getDescription(); ?></p>
						</div>
<?php endforeach; ?>
					</div>
					<!-- product details -->			
					<?php	foreach($products as $product): ?>
					<div class="cs-product-picture thumbnail">
						<!--<img class="img-responsive" src="http://soniqdesigns.com/wp/wp-content/uploads/2013/05/MarkupCode.gif" alt="">-->
						<div class="caption-full">
							<h4 class="pull-right">$24.99</h4>
							<h4><a href="#"><?php echo $product->getName(); ?></a></h4>
							<div class="labels">
<?php foreach($product->getTags() as $tag):?> 
								<span class="label label-default"><?php echo $tag->getName(); ?></span>
<?php endforeach; ?>
							</div>
							<div class="cs-product-description">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
							</div>
							<div class="cs-options">
								<span><?php echo label('programmingLanguage'); ?>:</span>
								<select>
<?php foreach($product->getProgrammingLanguages() as $language): ?>
									<option><?php echo $language ?></option>
<?php endforeach;?>
								</select>
								<span><?php echo label('version'); ?>:</span>
								<select>
<?php foreach($product->getVersions() as $version): ?>
									<option><?php echo $version ?></option>
<?php endforeach;?>
								</select>
								<span><?php echo label('withComments'); ?>:</span>
								<input type="checkbox" checked="checked"></input>
								<span><?php echo label('withSupport'); ?>:</span>
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
					<?php	endforeach; ?>
					<!-- comments -->
					<div class="well well-sm">
						<div class="text-right">
							<a class="btn btn-default btn-sm"><?php echo label('addComment'); ?></a>
						</div>
<?php foreach($reviews as $review): ?>
						<hr />
						<div class="row">
							<div class="col-md-12">
<?php for ($i = 0; $i < $review->getRating(); $i++) { ?>
								<span class="glyphicon glyphicon-star"></span>
<?php } ?>
<?php for ($i = 0; $i < (5 - $review->getRating()); $i++) { ?>
								<span class="glyphicon glyphicon-star-empty"></span>
<?php } ?>
								<?php echo $review->getUser()->getEmail(); ?>
								<span class="pull-right"><?php echo $review->getCreatedAt(); ?></span>
								<p><?php echo $review->getText(); ?></p>
							</div>
						</div>
<?php endforeach;?>
					</div>
<?php $this->view('footer'); ?> 