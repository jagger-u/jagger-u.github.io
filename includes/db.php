<?php 
$dbhost='localhost';
$username1='derek';
// $username1='root';
// $password='1129171217Li@';
$password='oilderek';
$db='avaxxdb'; // DB name
$con = mysqli_connect("$dbhost","$username1","$password");
if(!$con)
{
	echo'Not Connected To Server.';
}
if(!mysqli_select_db($con, $db))
{
	echo 'Data base not selected.';
}
?>