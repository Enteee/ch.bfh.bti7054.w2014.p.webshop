<?php $this->view('header'); ?> 
		<div class="container">
			<div class="col-md-12">
				<div class="row">
					<h1 class="page-header"><?php echo $errorTitle; ?></h1>
					<p class="lead"><?php echo $errorDescription; ?></p>
				</div>
			</div>
		</div>
<?php $this->view('footer'); ?> 