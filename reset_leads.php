<?php
ini_set('max_execution_time', '1000');
$host="localhost";
$user="root";
$password="6pNz4E{FIN8@";
$database="anb_crm";
$conn = mysqli_connect("localhost",$user,$password,$database);
$query = "SELECT * FROM anb_crm_record WHERE module_id = 1";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($res))
{
	$query = "DELETE FROM anb_crm_record_meta_value WHERE record_id = ".$row['id'];
	mysqli_query($conn, $query);
}
$query = "DELETE FROM anb_crm_record WHERE module_id = 1";
mysqli_query($conn, $query);
?>