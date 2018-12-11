<?php 
	include_once'Session.php';
	include 'Database.php';
	class User{
		private $db;
		public function __construct(){
			$this->db = new Database();
		}

        public function userRegistration($data){
	$name      = $data['name'];
	$user_name = $data['user_name'];
	$email     = $data['email'];
	$password  = $data['password'];

	$chk_email = $this->checkEmail($email);

	if($name == "" OR $user_name == "" OR $email == "" OR $password ==""){
		$msg = "<div class='alert alert-danger'><strong>Error!</strong>field must not be empty.</div>";
		return $msg;
	}

	if(strlen($user_name) < 3){
		$msg = "<div class='alert alert-danger'><strong>Error!</strong>username is too short.</div>";
		return $msg;
	}

	if(preg_match('/[^a-z0-9_-]+/i', $user_name)){
		$msg = "<div class='alert alert-danger'><strong>Error!</strong>username must only contain alphanumerical, dashes and underscores.</div>";
		return $msg;
	}

	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
		$msg = "<div class='alert alert-danger'><strong>Error!</strong>invalid email address.</div>";
		return $msg;
	}

	if($chk_email == true){
		$msg = "<div class='alert alert-danger'><strong>Error!</strong>email address is already exist.</div>";
		return $msg;
	}
	$password  = md5($data['password']);

	$sql = "INSERT INTO tbl_user(name, username, email, password) VALUES(:name, :username, :email, :password)";
	$query = $this->db->pdo->prepare($sql);
	$query->bindValue(':name', $name);
	$query->bindValue(':username', $user_name);
	$query->bindValue(':email', $email);
	$query->bindValue(':password', $password);
	$result = $query->execute();
	if($result){
		$msg = "<div class='alert alert-success'><strong></strong>successfully inserted.</div>";
		return $msg;
	}else{
		$msg = "<div class='alert alert-danger'><strong>Data is not inserted!</strong></div>";
		return $msg;
	}
        }

		public function checkEmail($email){
			$sql   = "SELECT email FROM tbl_user WHERE email = :email";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email', $email);
			$query->execute();

			if($query->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function getLoginUser($email, $password){
			$sql   = "SELECT * FROM tbl_user WHERE email = :email AND password = :password LIMIT 1";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email', $email);
			$query->bindValue(':password', $password);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;

		}

		public function userLogin($data){
			$email     = $data['email'];
			$password  = md5($data['password']);

			$chk_email = $this->checkEmail($email);

			if($email == "" OR $password ==""){
				$msg = "<div class='alert alert-danger'><strong>Error!</strong>field must not be empty.</div>";
				return $msg;
			}

			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				$msg = "<div class='alert alert-danger'><strong>Error!</strong>invalid email address.</div>";
				return $msg;
			}

			if($chk_email == false){
				$msg = "<div class='alert alert-danger'><strong>Error!</strong>email address is Not exist.</div>";
				return $msg;
			}

			$result = $this->getLoginUser($email, $password);
			if($result){
				Session::init();
				Session::set("login", true);
				Session::set("id", $result->id);
				Session::set("name", $result->name);
				Session::set("username", $result->username);
				Session::set("loginmsg", "<div class='alert alert-success'><strong>Success!</strong>You are logedIn.</div>");
				header("Location: index.php");

			}else{
				$msg = "<div class='alert alert-danger'><strong>Error!</strong>Data not found.</div>";
				return $msg;
			}
		}

		public function getUserData(){
			$sql   = "SELECT * FROM tbl_user ORDER BY id DESC";
			$query = $this->db->pdo->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			return $result;
		}

		public function getUserById($userid){
			$sql   = "SELECT * FROM tbl_user WHERE id = :id LIMIT 1";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':id', $userid);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}

		public function updateUserData($userid, $data){
			$name      = $data['name'];
			$user_name = $data['user_name'];
			$email     = $data['email'];
			

			

			if($name == "" OR $user_name == "" OR $email == ""){
				$msg = "<div class='alert alert-danger'><strong>Error!</strong>field must not be empty.</div>";
				return $msg;
			}


			$sql = "UPDATE tbl_user set
					name     = :name,
					username = :username,
					email    = :email
					WHERE id = :id;
			";
			$query = $this->db->pdo->prepare($sql);

			$query->bindValue(':name', $name);
			$query->bindValue(':username', $user_name);
			$query->bindValue(':email', $email);
			$query->bindValue(':id', $userid);
			$result = $query->execute();
			if($result){
				$msg = "<div class='alert alert-success'><strong></strong>Data Updated successfully.</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Data is not Updated.!</strong></div>";
				return $msg;
			}
		}

		private function checkPassword($id, $old_pass){
			$password = md5($old_pass);
			$sql   = "SELECT password FROM tbl_user WHERE id = :id AND password = :password";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':id', $id);
			$query->bindValue(':password', $password);
			$query->execute();

			if($query->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}


		public function updatePassword($id, $data){
			$old_pass = $data['old_pass'];
			$new_pass = $data['password'];
			$chk_pass = $this->checkPassword($id, $old_pass);
			if ($old_pass == "" OR $new_pass == "") {
				$msg = "<div class='alert alert-danger'><strong>Field must not be Empty.!</strong></div>";
				return $msg;
			}
			
			if ($chk_pass == false) {
				$msg = "<div class='alert alert-danger'><strong>Old password dose not Exist.!</strong></div>";
				return $msg;
			}

			$password = md5($new_pass);

			$sql = "UPDATE tbl_user set
					password = :password
					WHERE id = :id";

			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':id', $id);
			$query->bindValue(':password', $password);
			$result = $query->execute();
			if($result){
				$msg = "<div class='alert alert-success'><strong></strong>Password Updated successfully.</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Password is not Updated.!</strong></div>";
				return $msg;
			}
		}

}
	
?>