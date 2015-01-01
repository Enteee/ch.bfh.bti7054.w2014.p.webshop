<?php $this->view('header'); ?>
	<p class="lead"><?php echo "$pageTitle"; ?></p>
	<!-- product details -->
	<div class="list-group">
<?php foreach($products as $product): ?>
		<a href="product/show/<?php echo $product->getId(); ?>" class="list-group-item">
			<div class="row">
				<div class="col-xs-7">
					<input class="hidden cs-product-list-item-id" type="hidden" name="id" value="<?php echo $product->getId();?>" />
					<h4 class="list-group-item-heading cs-product-list-item-name"><?php echo $product->getName(); ?></h4>
					<p class="list-group-item-text"><?php echo $product->getDescription(); ?></p>
	<?php foreach($product->getCategories() as $category): ?>
					<span class="label label-default"><?php echo $category->getName(); ?></span>
	<?php endforeach; ?>
				</div>
				<div class="col-xs-3 text-right">
					<p><?php echo label('startingFrom'); ?> <b><?php echo $product->getStartingFromPrice(); ?>&cent;</b></p>
				</div>
				<div class="col-xs-2 text-right">
					<p>
	<?php for ($i = 0; $i < $product->getAvgRating(); $i++): ?>
						<span class="glyphicon glyphicon-star cs-product-list-item-review-new-rating-1"></span>
	<?php endfor; ?>
	<?php for ($i = 0; $i < 5 - $product->getAvgRating(); $i++): ?>
						<span class="glyphicon glyphicon-star-empty cs-product-list-item-review-new-rating-5"></span>
	<?php endfor; ?>
					</p>
					<p>
						<span class="badge cs-product-list-item-reviews-count"><?php echo count($product->getReviews()); ?> <?php echo label('reviews'); ?></span>
					</p>
				</div>
			</div>
			
		</a>
<?php endforeach; ?>
	</div>
<?php $this->view('footer'); ?> 
