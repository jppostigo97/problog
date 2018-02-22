<?php
	class User extends Model {

		public $userid;
		public $email;
		public $username;
		public $password;
		public $level;
		public $date_registered;
		public $bio;
		public $twitter_acc;
		public $public_email;
		public $public_twitter;
		
		public function find_by_email($email) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE email='$email';");
			return $result->fetch_object(get_class($this));
		}
		
		public function find_by_username($username) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE username='$username';");
			return $result->fetch_object(get_class($this));
		}
	}
?>
