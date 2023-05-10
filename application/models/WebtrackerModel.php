<?php
require_once 'BaseModel.php';
class WebtrackerModel extends BaseModel
{
	private $conn;
	public function __construct()
	{
		parent::__construct();
		$servername = "166.62.28.110";
		$username = "anbruch_wp4";
		$password = "A[3*7kWm&f~ueYScLb.03@[8";
		$dbname = "anbruch_wp4";

		$this->conn = new mysqli($servername, $username, $password, $dbname);

		if ($this->conn->connect_error) {
		    die("Connection failed: " . $this->conn->connect_error);
		} 

	}
	public function getAll($test = '')
	{
		if($test == 'CCD')
		{
			$sql = "select Count(*) from wp_test_tracker where test_name = 'test-CCD'";
		}
		else if($test == 'CST')
		{
			$sql = "select Count(*) from wp_test_tracker where test_name = 'test-CST'";
		}
		else if($test == 'CGI')
		{
			$sql = "select Count(*) from wp_test_tracker where test_name = 'test-CGI'";
		}
		else
		{
			$sql = "select Count(*) from wp_test_tracker";
		}
    	$result = $this->conn->query($sql);
    	$total = 0;
    	if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$total =$row['Count(*)'];
		    }
		}
		return $total;
	}
	public function countNotFinished()
	{
		$sql = "select Count(*) from wp_test_tracker where total < 10";
    	$result = $this->conn->query($sql);
    	$notFinished = 0;
    	if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$notFinished =$row['Count(*)'];
		    }
		}
		return $notFinished;
	}
	public function countFinished()
	{
		$sql = "select Count(*) from wp_test_tracker where total = 10 AND target = 0";
    	$result = $this->conn->query($sql);
    	$Finished = 0;
    	if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$Finished =$row['Count(*)'];
		    }
		}
		return $Finished;
	}
	public function countBook()
	{
		$sql = "select Count(*) from wp_test_tracker where target = 1";
    	$result = $this->conn->query($sql);
    	$book = 0;
    	if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$book =$row['Count(*)'];
		    }
		}
		return $book;
	}
	public function getCCDData()
	{
		$canvas_two = array();
		for ($i=1; $i <= 10; $i++) { 
			$sql = "select Count(*) from wp_test_tracker where test_name = 'test-CCD' AND total = ".$i;
	    	$result = $this->conn->query($sql);

	    	$notFinished = 0;
	    	if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$notFinished =$row['Count(*)'];
			 	}
			 	$canvas_two[] = $notFinished;
			}
		}
		return $canvas_two;
	}
	public function getCSTData()
	{
		$canvas_three = array();
		for ($i=1; $i <= 10; $i++) { 
			$sql = "select Count(*) from wp_test_tracker where test_name = 'test-CST' AND total = ".$i;
	    	$result = $this->conn->query($sql);

	    	$notFinished = 0;
	    	if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$notFinished =$row['Count(*)'];
			 	}
			 	$canvas_three[] = $notFinished;
			}
		}
		return $canvas_three;
	}
	public function getCGIData()
	{
		$canvas_four = array();
		for ($i=1; $i <= 10; $i++) { 
			$sql = "select Count(*) from wp_test_tracker where test_name = 'test-CGI' AND total = ".$i;
	    	$result = $this->conn->query($sql);

	    	$notFinished = 0;
	    	if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$notFinished =$row['Count(*)'];
			 	}
			 	$canvas_four[] = $notFinished;
			}
		}
		return $canvas_four;
	}
}