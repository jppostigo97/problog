<?php
	class Post extends Model {

		public $postid;
		public $title;
		public $content;
		public $author;
		public $category;
		public $date_posted;
		
		public function find_by_author($author) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE author=$author ORDER BY postid DESC;");
			return $result;
		}

		public function find_by_category($category) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE category=$category ORDER BY postid DESC;");
			return $result;
		}
		
		public function load_page($p_) {
			$p = $p_-1;
			$query = "SELECT * FROM $this->table ORDER BY postid DESC LIMIT " . $p*10 . ", 10;";
			$result = $this->connection->query($query);
			return $result;
		}
	}
?>
