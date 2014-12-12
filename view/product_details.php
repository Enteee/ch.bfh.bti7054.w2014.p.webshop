<?php $this->view('header'); ?>
	<p class="lead"><?php echo "$pageTitle"; ?></p>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo label('product'); ?>
		</div>
		<div class="panel-body">
			<input class="hidden cs-product-list-item-id" type="hidden" name="id" value="<?php echo $product->getId();?>" />
			<h4 class="list-group-item-heading cs-product-list-item-name"><?php echo $product->getName(); ?></h4>
			<p class="list-group-item-text"><?php echo $product->getDescription(); ?></p>
<?php foreach($product->getCategories() as $category): ?>
				<span class="label label-default"><?php echo $category->getName(); ?></span>
<?php endforeach; ?>
		</div>
	</div>
	<!-- offers -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo label('offers'); ?>
		</div>
		<ul class="list-group">
<?php foreach ($product->getOffers() as $offer):?>
			<li class="list-group-item">
				<div class="row">
					<div class="col-xs-3">
	<?php foreach ($offer->getProgrammingLanguages() as $programmingLanguage):?>
						<span class="label label-default"><?php echo $programmingLanguage->getName(); ?></span>
	<?php endforeach; ?>
					</div>
					<div class="col-xs-5 text-right">
						<span><?php echo label('withComments'); ?>:</span><input type="checkbox" checked="checked"></input>
					</div>
					<div class="col-xs-2 text-right">
						<b><?php echo $offer->getPrice(); ?></b>&cent;
					</div>
					<div class="col-xs-2 text-right">
						<button type="button" class="btn btn-xs btn-default" title="<?php echo label('addToShoppingCart'); ?>">
							<span class="glyphicon glyphicon-shopping-cart"></span>
						</button>
					</div>
				</div>
			</li>
<?php endforeach; ?>
		</ul>
	</div>
	<!-- reviews -->
<?php if ($isLoggedIn): ?>
	<div class="well">
		<div class="cs-product-list-item-reviews">
			<!-- placeholder -->
		</div>
		<!-- template is hidden -->
		<div class="hidden row cs-product-list-item-review-template">
			<div class="col-md-12">
				<div class="cs-product-list-item-review">
					<span class="cs-product-list-item-review-email"></span>
					<span class="pull-right cs-product-list-item-review-created-at"></span>
					<div class="cs-product-list-item-review-rating"></div>
					<p class="cs-product-list-item-review-text"></p>
				</div>
			</div>
		</div>
		<textarea class="form-control cs-product-list-item-review-new-text" rows="5" placeholder="<?php echo label('writeReview') ?>" required></textarea>
		<div class="text-right">
			<p>
				<?php echo label('rating'); ?>:
				<span class="glyphicon glyphicon-star cs-product-list-item-review-new-rating-1"></span>
				<span class="glyphicon glyphicon-star cs-product-list-item-review-new-rating-2"></span>
				<span class="glyphicon glyphicon-star cs-product-list-item-review-new-rating-3"></span>
				<span class="glyphicon glyphicon-star cs-product-list-item-review-new-rating-4"></span>
				<span class="glyphicon glyphicon-star-empty cs-product-list-item-review-new-rating-5"></span>
				<input class="hidden cs-product-list-item-review-new-rating-val" type="hidden" name="id" value="4" />
			</p>
			<button type="button" class="btn btn-default btn-sm cs-product-list-item-review-new-add"><?php echo label('addReview'); ?></a>
		</div>
	</div>
<?php endif; ?>
<?php $this->view('footer'); ?> 
