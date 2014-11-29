<?php $this->view('header'); ?> 
		<div class="container">
			<div class="col-md-12">
				<div class="row">
					<h1 class="page-header"><?php echo $errorTitle; ?></h1>
<?php if (isset($errorDescription)): ?>
					<p class="lead"><?php echo $errorDescription; ?></p>
<?php endif; ?>
<?php if (isset($errorCode)): ?>
					<pre><?php echo $error; ?></pre>
<?php endif; ?>
				</div>
			</div>
		</div>
<?php $this->view('footer'); ?> 