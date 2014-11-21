<?php $this->view('header'); ?>
					<p class="lead"><?php echo label('products'); ?></p>
					<!-- product details -->			
<?php	foreach($products as $product): ?>
					<div class="list-group-item cs-product-picture thumbnail">
						<!--<img class="img-responsive" src="http://soniqdesigns.com/wp/wp-content/uploads/2013/05/MarkupCode.gif" alt="">-->
						<div class="caption-full cs-product-list-item">
							<input class="hidden cs-product-list-item-id" type="hidden" name="id" value="<?php echo $product->getId();?>">
							<h4 class="hidden pull-right cs-product-list-item-price"></h4>
							<h4 class="list-group-item-heading cs-product-list-item-name"><?php echo $product->getName(); ?></h4>
							<div class="labels hidden cs-product-list-item-tags"></div>
							<div class="cs-product-list-item-description">
								<p class="list-group-item-text"><?php echo $product->getDescription(); ?></p>
							</div>
							<div class="hidden cs-options cs-product-list-item-options">
								<span><?php echo label('programmingLanguage'); ?>:</span>
								<select class="cs-product-list-item-options-programming-language">
								</select>
								<span><?php echo label('version'); ?>:</span>
								<select class="cs-product-list-item-options-version">
								</select>
								<span><?php echo label('withComments'); ?>:</span>
								<input type="checkbox" checked="checked"></input>
								<span><?php echo label('withSupport'); ?>:</span>
								<input type="checkbox"></input>  
							</div>
						</div>
						<div class="cs-ratings hidden">
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
	<?php for ($i = 0; $i < $review->getRating(); $i++): ?>
								<span class="glyphicon glyphicon-star"></span>
	<?php endfor; ?>
	<?php for ($i = 0; $i < (5 - $review->getRating()); $i++): ?>
								<span class="glyphicon glyphicon-star-empty"></span>
	<?php endfor; ?>
								<?php echo $review->getUser()->getEmail(); ?>
								<span class="pull-right"><?php echo $review->getCreatedAt(); ?></span>
								<p><?php echo $review->getText(); ?></p>
							</div>
						</div>
<?php endforeach;?>
					</div>
<?php $this->view('footer'); ?> 
