<?php
namespace Aljdic;

class Db
{
	CONST MY_DB_NAME = 'alj_dic';

	private $conn;

	public function __construct() {

		$this->conn = new \mysqli('localhost', DB_USER , DB_PASSWORD , self::MY_DB_NAME);
		if ($this->conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
	}

	public function execute_query($sql){
		$rows = array();
		$result = $this->conn->query($sql);

		if(mysqli_num_rows($result) > 0){
			while ($row = $result->fetch_assoc()) {
		        $rows[] = $row;
		    }
		    mysqli_free_result($result);
		}

		return $rows;
	}

	public function escape_string($str){
		return $this->conn->real_escape_string($str);
	}

	public function make_unique_list_of($column, $results){
		$list = array();
		foreach($results as $result){
			$list[] = $result[$column];
		}
		$list = array_unique($list);
		return $list;
	}

	public function __destruct(){
		$this->conn->close();
	}

}