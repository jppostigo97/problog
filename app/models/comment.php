<?php
	class Comment extends Model {

		public $commentid;
		public $author;
		public $post;
		public $content;
		public $date_commented;
		public $flagged;
				
		public function find_by_author($author) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE author=$author ORDER BY commentid DESC;");
			return $result;
		}
		
		public function find_by_post($post) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE post=$post ORDER BY commentid DESC;");
			return $result;
		}
		
		public function find_flagged() {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE flagged=1;");
			return $result;
		}
	}
?>
