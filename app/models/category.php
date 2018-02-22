<?php
	class Category extends Model {

		public $categoryid;
		public $label;
		
		public function find_by_label($label) {
			$result = $this->connection->query(
				"SELECT * FROM $this->table WHERE label='$label';");
			return $result->fetch_object(get_class($this));
		}
	}
?>
