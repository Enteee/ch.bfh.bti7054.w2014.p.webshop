<html xmlns="http://www.w3.org/1999/xhtml">
<?php   $this->inc->doinclude($this->head); ?>
    <body>
<?php   $this->inc->doinclude($this->scriptinc); ?>

        <!-- navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- logo -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img class="cs-logo" src="layout/img/logo_small.png" alt="CodeShop Logo" /></a>
                </div>
            </div>
        </nav>
        
		<!-- form -->
		<div class="container">
			<form class="form-register" role="form">
				<h2 class="form-register-heading">Register a new Account</h2>

					<select id="title" class="form-control">
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
					</select>
					
					<input id="name" type="name" class="form-control" placeholder="Name" required autofocus>
					<input id="prename" type="prename" class="form-control" placeholder="Prename" required>
					<input id="street" type="street" class="form-control" placeholder="Street">
					<input id="zip" type="text" class="form-control" placeholder="ZIP">
					<input id="city" type="text" class="form-control" placeholder="City" >
					<label></label>
					<input id="email" type="email" class="form-control" placeholder="Email address" required>
					<input id="pw1" type="password" class="form-control" placeholder="Password" required>
					<input id="pw2" type="password" class="form-control" placeholder="Password" required>
					<label></label>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

		</form>			
		
	</div>
        
        <!-- footer -->
        <footer class="cs-footer">
            <div class="container">
                <p class="cs-copyright text-muted">Copyright &copy; 2014 CodeShop</p>
            </div>
        </footer>
    </body>
</html>
