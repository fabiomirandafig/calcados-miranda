<?php
class Database {
	private $con;
	public function connect(){
		$this->con = new pg_connect("localhost", "5432", "calcadosmiranda", "postgres", "9579");
		return $this->con;
	}
}
?>