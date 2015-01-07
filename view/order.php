<?php $this->view('header'); ?>
	<p class="lead"><?php echo "$pageTitle"; ?></p>
	<ul class="list-group">
	<?php foreach($items as $item):?>
		<li class="list-group-item cs-shopping-cart-item">
			<div class="row">
				<div class="col-xs-8">
					<?php echo $item->getProduct()->getName(); ?>
				</div>
				<div class="col-xs-4 text-right">
					<b class="cs-shopping-cart-item-price"><?php echo $item->getPrice(); ?></b>&cent;
				</div>
			</div>
		</li>
	<?php endforeach; ?>
		<li class="list-group-item list-group-item-info">
			<div class="row">
				<div class="col-xs-8">
					<?php echo label('total'); ?>
				</div>
				<div class="col-xs-4 text-right">
					<b class="cs-shopping-cart-total-price"><?php echo $shoppingCartTotalPrice; ?></b>&cent;
				</div>
			</div>
		</li>
	</ul>
	<?php if ($enoughtCredits): ?>
	<form action="<?php echo lang(); ?>/order/finish" method="post">
		<button class="btn btn-default" type="submit" onclick="return confirm('<?php echo label('orderConfirmText'); ?>');"><?php echo label('completeOrder'); ?></button>
	</form>
	<?php else: ?>
	<div class="alert alert-danger" role="alert"><?php echo label('notEnoughtCredits'); ?></div>
	<?php endif; ?>
<?php $this->view('footer'); ?> 
