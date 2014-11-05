		<noscript>
			<div class="noscript">
				<p class="noscript">This page works better with enabled Javascript</p>
			</div>
		</noscript>
		<!-- Javascript -->
		<!-- Microsoft READ THIS: http://www.rfc-editor.org/rfc/rfc4329.txt  !! You are obsolete !! -->
<?php foreach($this->external_js as $jinc){ ?>
		<script type="application/javascript" src="<?php echo $jinc;?>"></script>
<?php } ?>
<?php foreach($this->js as $jinc){ ?>
		<script type="application/javascript" src="<?php echo $this->getpath($jinc);?>"></script>
<?php } ?>
