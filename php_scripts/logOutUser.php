<?php
//
session_start();


unset ($_SESSION['login']);

// remove all session variables
//session_unset(); 

// destroy the session 
//session_destroy(); 
echo '<div class="btn-group">
				<a href="page-signup" class="btn btn-default btn-sm"><i class="fa fa-user pr-10"></i> Sign Up</a>
			</div>
			<div class="btn-group dropdown">
				<button type="button" class="btn dropdown-toggle btn-default btn-sm" data-toggle="dropdown"><i class="fa fa-lock pr-10"></i> Login</button>
				<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
					<li>
						<form class="login-form margin-clear" method="POST">
							<div class="form-group has-feedback">
								<label class="control-label">Email</label>
								<input type="email" id="email" name="email" class="form-control" placeholder="">
								<i class="fa fa-envelope form-control-feedback"></i>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label">Parola</label>
								<input type="password" id="parola" name="parola" class="form-control" placeholder="">
								<i class="fa fa-lock form-control-feedback"></i>
							</div>

							<div id="errorUser" style="padding-bottom:10px;padding-top:10px;display:none">
								<font color="#eea236"><i class="fa fa-warning pr-10"></i>Emailul sau parola sunt incorecte!</font>
							</div>

							<button type="button" onclick="verifica_Login()" class="btn btn-animated btn-gray btn-sm">Log In <i class="fa fa-group"></i></button>
							<ul>
								<li><a href="/reset-password">Reseteaza parola!?</a></li>
							</ul>
						</form>
					</li>
				</ul>
			</div>';
?>