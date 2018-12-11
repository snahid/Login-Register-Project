<?php 
	include'inc/header.php';
	include'lib/User.php';
	Session::checklogin();	
?>
	<!-- User Input as table -->
<?php
	$user = new User();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
		$usrLogin = $user->userLogin($_POST);
	}
?>
	<!-- User Input as table -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">User Login</th>
			</tr>
		</thead>
	</table>
	<div style="max-width: 600px;margin:0 auto;">

		<?php
			if(isset($usrLogin)){
				echo $usrLogin;
			}
		?>

		<form action="" method="POST">
			<div class="form_group">
				<label for="email">Email Address</label>
				<input type="text" name="email" id="email" class="form-control">
			</div>
			<div class="form_group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control">
			</div>
			<button type="submit" name="login" class="btn-btn-success" style="cursor: pointer;">Login</button>
		</form>
	</div>
	

	<?php include'inc/footer.php';?>