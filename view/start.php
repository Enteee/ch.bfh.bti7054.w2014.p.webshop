<?php $this->view('header'); ?>
					<p class="lead"><?php echo $pageTitle; ?></p>
					<!-- product details -->			
<?php	foreach($products as $product): ?>
					<div class="list-group-item cs-product-picture thumbnail cs-product-list-item">
						<!--<img class="img-responsive" src="http://soniqdesigns.com/wp/wp-content/uploads/2013/05/MarkupCode.gif" alt="">-->
						<div class="caption-full">
							<div class="cs-product-list-item-clickable">
								<input class="hidden cs-product-list-item-id" type="hidden" name="id" value="<?php echo $product->getId();?>" />
								<h4 class="hidden pull-right cs-product-list-item-price cs-product-list-hideable"></h4>
								<h4 class="list-group-item-heading cs-product-list-item-name"><?php echo $product->getName(); ?></h4>
								<div class="labels hidden cs-product-list-item-tags cs-product-list-hideable"></div>
								<div class="cs-product-list-item-description">
									<p class="list-group-item-text"><?php echo $product->getDescription(); ?></p>
								</div>
							</div>
							<div class="hidden cs-product-list-item-options cs-product-list-hideable">
								<span><?php echo label('programmingLanguage'); ?>:</span>
								<select class="cs-product-list-item-options-programming-language">
								</select>
								<span><?php echo label('version'); ?>:</span>
								<select class="cs-product-list-item-options-version">
								</select>
								<span><?php echo label('withComments'); ?>:</span>
								<input class="" type="checkbox" checked="checked"></input>
								<span><?php echo label('withSupport'); ?>:</span>
								<input class="" type="checkbox"></input>  
							</div>
							<div class="hidden cs-product-list-item-rating cs-product-list-hideable">
								<p class="pull-right"><?php echo label('reviews')?>&nbsp;<span class="badge cs-product-list-item-reviews-count"></span></p>
							</div>
							<!-- reviews -->
							<div class="hidden well well-sm cs-product-list-hideable">
								<div class="cs-product-list-item-reviews">
									<div class="hidden row cs-product-list-item-review cs-product-list-item-review-template cs-product-list-hideable">
										<div class="col-md-12">
											<p class="cs-product-list-item-review-email"></p>
											<div class="cs-product-list-item-review-rating"></div>
											<span class="pull-right cs-product-list-item-review-created-at"></span>
											<p class="cs-product-list-item-review-text"></p>
										</div>
									</div>
								</div>
								<textarea class="form-control cs-product-list-item-review-new-text" rows="5" placeholder="<?php echo label('writeReview') ?>"></textarea>
								<div class="text-right">
								<p>
									<?php echo label('rating'); ?>:
									<span class="glyphicon glyphicon-star cs-product-list-item-review-new-rating-1"></span>
									<span class="glyphicon glyphicon-star cs-product-list-item-review-new-rating-2"></span>
									<span class="glyphicon glyphicon-star cs-product-list-item-review-new-rating-3"></span>
									<span class="glyphicon glyphicon-star cs-product-list-item-review-new-rating-4"></span>
									<span class="glyphicon glyphicon-star-empty cs-product-list-item-review-new-rating-5"></span>
									<input class="hidden cs-product-list-item-review-rating-val" type="hidden" name="id" value="4" />
								</p>
									<button type="button" class="btn btn-default btn-sm cs-product-list-item-review-new-add"><?php echo label('addReview'); ?></a>
								</div>
							</div>
						</div>
					</div>
<?php	endforeach; ?>
<?php $this->view('footer'); ?> 
