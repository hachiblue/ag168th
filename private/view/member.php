<?php 
extract($params);
$this->import('/template/top-navbar'); 
?>


<section id="memberContainer" class="a_container">

<div class="container">

	<div class="mem-form mgt50">
		<div class="col-sm-5">
                        	
			<div class="form-box">
				<div class="form-top">
					<div class="form-top-left">
						<h3>Log in</h3>
					</div>
					<div class="form-top-right">
						<i class="fa fa-key"></i>
					</div>
				</div>
				<div class="form-bottom">
					<form role="form" id="form-login" method="post" class="login-form">
						<div class="form-group">
							<label class="sr-only" for="form-username">Username</label>
							<input type="text" name="form-username" placeholder="Username / Email" class="form-username form-control" id="form-username" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-password">Password</label>
							<input type="password" name="form-password" placeholder="Password" class="form-password form-control" id="form-password" required>
						</div>
						<button type="submit" id="btn-login" class="btn btn-searchred">Sign in!</button>
					</form>
				</div>
			</div>
		
			<!-- <div class="social-login">
				<h3>...or login with:</h3>
				<div class="social-login-buttons">
					<a class="btn btn-link-1 btn-link-1-facebook" href="#">
						<i class="fa fa-facebook"></i> Facebook
					</a>
					<a class="btn btn-link-1 btn-link-1-twitter" href="#">
						<i class="fa fa-twitter"></i> Twitter
					</a>
					<a class="btn btn-link-1 btn-link-1-google-plus" href="#">
						<i class="fa fa-google-plus"></i> Google Plus
					</a>
				</div>
			</div> -->
			
		</div>
		<div class="col-sm-1 middle-border hidden-xs"></div>
		<div class="col-sm-1 hidden-xs"></div>
		<div class="col-sm-5">
                        	
			<div class="form-box">
				<div class="form-top">
					<div class="form-top-left">
						<h3>Sign up now</h3>
					</div>
					<div class="form-top-right">
						<i class="fa fa-pencil"></i>
					</div>
				</div>
				<div class="form-bottom">
					<form role="form" method="post" id="form-regis" class="registration-form">
						<div class="form-group">
							<label class="sr-only" for="form-reg-email">Email</label>
							<input type="email" name="form-reg-email" placeholder="Email" class="form-reg-email form-control" id="form-reg-email" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-reg-password">Password</label>
							<input type="password" name="form-reg-password" placeholder="Password" class="form-reg-password form-control" id="form-reg-password" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-reg-rpassword">Re-Password</label>
							<input type="password" name="form-reg-rpassword" placeholder="Re-Password" class="form-reg-rpassword form-control" id="form-reg-rpassword" required>
						</div>
						<button type="submit" id="btn-regis" class="btn btn-searchred">Sign me up!</button>
					</form>
				</div>
			</div>
			
		</div>
	</div>

</div>

</section>








<?php $this->import('/template/footer'); ?>