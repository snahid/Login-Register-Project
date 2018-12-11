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
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
		$updateUser = $user->updateUserData($id, $_POST);
	}
	
	?>
	
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">User Profile</th>
				<th></th>
				<th></th>
				<th></th>
				<th><span><a class="btn btn-dark" href="index.php">Back</a></span></th>
			</tr>
		</thead>
	</table>
	<div style="max-width: 600px;margin:0 auto;">

		<?php
		if (isset($updateUser)) {
			echo $updateUser;
		}
		?>

		<?php
		$userdata = $user->getUserById($id);
		if ($userdata) {
			
		
		?>
		<form action="" method="POST">
			<div class="form_group">
				<label for="name">Full name</label>
				<input type="text" name="name" id="name" class="form-control" value="<?php echo $userdata-> name;?>">
			</div>
			<div class="form_group">
				<label for="user">User name</label>
				<input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $userdata-> username;?>">
			</div>
			<div class="form_group">
				<label for="email">Email Address</label>
				<input type="text" name="email" id="email" class="form-control" value="<?php echo $userdata-> email;?>">
			</div>

			<?php
			$sesId = Session::get("id");
			if($sesId == $id){

			
			?>

			<button type="submit" name="update" class="btn btn-success" style="cursor: pointer;">Update</button>
			<a class="btn btn-primary" href="changepass.php?id = <?php echo $id;?>">Change Password</a>

		<?php }?>
		</form>
		<?php
	    }
		?>
	</div>
	

	<?php include'inc/footer.php';?>