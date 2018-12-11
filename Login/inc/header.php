<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/Session.php';
	Session::init();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Register System PHP</title>
	<link rel="stylesheet" type="text/css" href="inc/bootstrap.min.css ">
	<script type="text/javascript"
	src="inc/jquery.min.js"></script>
	<script type="text/javascript" src="inc/bootstrap.min.js"></script>
</head>
<?php
	if (isset($_GET['action']) && $_GET['action'] == "logout") {
		Session::destroy();
	}
?>

<body>
<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="index.php">Login Register System PHP & PDO</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	    <ul class="navbar-nav ml-auto">
	    	
	      
	      <?php
	      	$id = Session::get("id");
	      	$logedIn = Session::get("login");
	      	if ($logedIn ==true) {
	      		?>
	      		
	      	<li class="nav-item ">
	          <a class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a>
	       </li>
	       <li class="nav-item">
	          <a class="nav-link" href="?action=logout">Logout</a>
	       </li>
	       <?php
	      	}else{
	      	?>	
	      	<li class="nav-item">
	    		<a class="nav-link" href="index.php">Home</a>
	    	</li>	
	      	<li class="nav-item">
	        <a class="nav-link" href="login.php">Login</a>
	      </li>
	      <li class="nav-item dropdown">
	       <a class="nav-link" href="register.php">Register</a>
	      </li>
	      <?php	
	      	}
	      ?>
	      
	    </ul>
	  </div>
	</nav>