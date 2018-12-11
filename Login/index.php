<?php
	include'lib/User.php'; 
	include'inc/header.php';
	Session::checkSession();
		
?>
<?php
	$loginmsg = Session::get("loginmsg");
	if($loginmsg){
		echo $loginmsg;
	}
	Session::set("loginmsg", "");
?>

<div class="cotainer">
	<div class="row">
		<div class="col-sm-6">
			<h2>User List</h2>
		</div>
		<div class="row">
			<h2>Welcome! <span>
				<?php 
					$loginUser = Session::get("username");
					if($loginUser){
						echo $loginUser;
					}
				?>
				
			</span></h2>
		</div>
	</div>
</div>
	<!-- User Input as table -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Serial</th>
				<th scope="col">Name</th>
				<th scope="col">Username</th>
				<th scope="col">Email</th>
				<th scope="col">Action</th>
			</tr>
		</thead>

		<?php
			$user     = new User();
			$userData = $user->getUserData();
			if ($userData) {
				$i = 0;
				foreach ($userData as $sdata) {
			 	$i++;
		?>

		<tbody>
			<tr>
				<th scope="row"><?php echo $i;?></th>
				<td><?php echo $sdata['name'];?></td>
				<td><?php echo $sdata['username'];?></td>
				<td><?php echo $sdata['email'];?></td>
				<td><a class="btn-btn-primary" href="profile.php?id=<?php echo $sdata['id'];?>">View</a></td>
			</tr>
		</tbody>

		<?php
			}
		}else{
			?>
			<tr>
				<td colspan="5">
					<h2>
					Data is not found......
					</h2>
				</td>
			</tr>
		<?php
	}
		?>

	</table>


	<?php include'inc/footer.php';?>