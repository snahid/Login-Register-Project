<?php 
	include'inc/header.php';
	include'lib/User.php';	
?>
	<!-- User Input as table -->
<?php
	$user = new User();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
		$usrRegi = $user->userRegistration($_POST);
	}
?>
	
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">User Registration</th>
			</tr>
		</thead>
	</table>
	<div style="max-width: 600px;margin:0 auto;">

		<?php
			if(isset($usrRegi)){
				echo $usrRegi;
			}
		?>

		<form action="" method="POST">
			<div class="form_group">
				<label for="name">Full name</label>
				<input type="text" name="name" id="name" class="form-control" >
			</div>
			<div class="form_group">
				<label for="user">User name</label>
				<input type="text" name="user_name" id="user_name" class="form-control" >
			</div>
			<div class="form_group">
				<label for="email">Email Address</label>
				<input type="text" name="email" id="email" class="form-control" >
			</div>
			<div class="form_group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control">
			</div>
			<button type="submit" name="register" class="btn-btn-success" style="cursor: pointer;">Submit</button>
		</form>
	</div>
	

	<?php include'inc/footer.php';?>