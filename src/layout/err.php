<html xmlns="http://www.w3.org/1999/xhtml" >
<?php 	$this->inc->doinclude($this->head); ?>
	<body>
<?php 	$this->inc->doinclude($this->scriptinc); ?>
		<div class="Statusbar" id="Message" >
			<p class="Text"><?php echo $this->stringtohtml($this->message);?></p>
		</div>

		<div class="Statusbar" id="Access_Id" >
			<p class="Access_Id"><?php echo $this->stringtohtml($this->access_id);?></p>
		</div>

		<div class="Linkbox">
			<p class="Link">Now..</p>
			<a class="Link" href="index.php">..to start</a>
		</div>
	</body>
</html>
