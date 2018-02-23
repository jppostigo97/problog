<?php
	/**
	 * Model class.
	 */
	abstract class Model {
		
		/** Database connection. */
		public $connection;
		/** ID field. */
		public $id;
		/** Table name. */
		public $table;
		
		public function __construct () {
			$this->connection = new mysqli(Config::db_host, Config::db_user,
				Config::db_pass, Config::db_name);
			$this->connection->set_charset("UTF8");
			$this->table = strtolower(get_class($this));
			$this->id    = strtolower(get_class($this))."id";
		}
		
		public function __destruct () {
			$this->connection->close();
		}
		
		/**
		 * Create a new object inside the database.
		 * 
		 * @param array $new New object (as array).
		 * @return bool If the query went ok or not.
		 */
		public function add ($new) {
			$first  = true;
			$fields = "";
			$values = "";
			foreach ($new as $key => $value) {
				if (!$first) {
					$fields .= ", ";
					$values .= ", ";
				}
				$fields .= $key;
				$values .= "'" . $value . "'";
				$first   = false;
			}
			$query  = "INSERT INTO $this->table ($fields) VALUES ($values);";
			$result = $this->connection->query($query);
			return $result;
		}
		
		/**
		 * Delete an object in the database wich has the specified ID.
		 * 
		 * @param int $id Object ID.
		 * @return bool If the query went ok or not.
		 */
		public function delete ($id) {
			$result = $this->connection->query("DELETE FROM $this->table WHERE $this->id=$id;");
			return $result;
		}
		
		/**
		 * Search an object inside the database.
		 * 
		 * @param int $id Object ID.
		 * @return Model|bool Found object or *false* if it hasn't been found.
		 */
		public function find ($id) {
 			$result = $this->connection->query("SELECT * FROM $this->table WHERE $this->id=$id;");
			return ($result)? $result->fetch_object(get_class($this)) : $result;
		}
		
		/**
		 * Search all abjects inside the database.
		 * 
		 * @return mysqli_result Object list.
		 */
		public function get_all () {
			return $this->connection->query("SELECT * FROM $this->table ORDER BY $this->id;");
		}
		
		/**
		 * Update an object inside the database.
		 * 
		 * @param int $id Object ID.
		 * @param array $new Updated object fields (as array).
		 * @return bool If the query went okay or not.
		 */
		public function update ($id, $new) {
			$first  = true;
			$values = "";
			foreach ($new as $key => $value) {
				if (!$first) $values .= ", ";
				$values .= "$key='" . $value . "'";
				$first   = false;
			}
			$query  = "UPDATE $this->table SET $values WHERE $this->id=$id;";
			$result = $this->connection->query($query);
			return $result;
		}
		
		/**
		 * Encode a string.
		 * 
		 * @param string $string String to encode.
		 * @return string Encoded string.
		 */
		static public function encode ($string) {
			$tc = new mysqli(Config::db_host, Config::db_user,
				Config::db_pass, Config::db_name);
			$encoded_string = $tc->real_escape_string($string);
			$tc->close();
			return $encoded_string;
		}
		
		/**
		 * Decode a string.
		 * 
		 * @param string $string String to decode.
		 * @return string Decoded string.
		 */
		static public function decode ($string) {
			return stripcslashes(htmlspecialchars($string));
		}
	}
?>
