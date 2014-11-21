<?php $this->view('header'); ?>
					<p class="lead"><?php echo label('products'); ?></p>
					<!-- product details -->			
<?php	foreach($products as $product): ?>
					<div class="list-group-item cs-product-picture thumbnail cs-product-list-item">
						<!--<img class="img-responsive" src="http://soniqdesigns.com/wp/wp-content/uploads/2013/05/MarkupCode.gif" alt="">-->
						<div class="caption-full">
							<input class="hidden cs-product-list-item-id" type="hidden" name="id" value="<?php echo $product->getId();?>" />
							<h4 class="hidden pull-right cs-product-list-item-price cs-product-list-hideable"></h4>
							<h4 class="list-group-item-heading cs-product-list-item-name"><?php echo $product->getName(); ?></h4>
							<div class="labels hidden cs-product-list-item-tags cs-product-list-hideable"></div>
							<div class="cs-product-list-item-description">
								<p class="list-group-item-text"><?php echo $product->getDescription(); ?></p>
							</div>
							<div class="hidden cs-product-list-item-options cs-product-list-hideable">
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
							<div class="hidden cs-product-list-item-ratings cs-product-list-hideable">
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
							<!-- reviews -->
							<div class="hidden well well-sm cs-product-list-hideable">
								<div class="cs-product-list-item-reviews">
									<div class="hidden row cs-product-list-item-review cs-product-list-item-review-template cs-product-list-hideable">
										<div class="col-md-12">
											<div class="cs-product-list-item-review-rating">
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star-empty"></span>
											</div>
											<p class="cs-product-list-item-review-email">gagu@hagu.lol</p>
											<span class="pull-right cs-product-list-item-review-created-at">11.1.1</span>
											<p class="cs-product-list-item-review-text">This sucks!</p>
										</div>
									</div>
								</div>
								<div class="text-right">
									<textarea class="form-control" rows="5"></textarea>
									<a class="btn btn-default btn-sm"><?php echo label('addComment'); ?></a>
								</div>
							</div>
						</div>
					</div>
<?php	endforeach; ?>
<?php $this->view('footer'); ?> 
