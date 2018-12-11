<?php
	include'lib/User.php'; 
	include'inc/header.php';
	Session::checkSession();
?>
	<!-- User Input as table -->

	<?php
	if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];
	}
	$user = new User();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])){
		$updatepass = $user->updatePassword($id, $_POST);
	}
	
	?>
	
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col"><h2>Change Password</h2></th>
				<th></th>
				<th></th>
				<th></th>
				<th><span><a class="btn btn-dark" href="profile.php?id = <?php echo $id;?>">Back</a></span></th>
			</tr>
		</thead>
	</table>
	<div style="max-width: 600px;margin:0 auto;">

		<?php
		if (isset($updatepass)) {
			echo $updatepass;
		}
		?>

		
		<form action="" method="POST">
			<div class="form_group">
				<label for="old_pass">Old Password</label>
				<input type="password" name="old_pass" id="old_pass" class="form-control">
			</div>
			<div class="form_group">
				<label for="password">New Password</label>
				<input type="password" name="password" id="password" class="form-control" >
			</div>


			<button type="submit" name="updatepass" class="btn btn-success" style="cursor: pointer;">Update</button>
			
		</form>
	</div>
	

	<?php include'inc/footer.php';?>