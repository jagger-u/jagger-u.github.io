<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php
$City_name= $_POST['City_name'];
$City_Lat= $_POST['City_Lat'];
$City_Long= $_POST['City_Long'];
$City_country_id= $_POST['City_country_id'];
$condition_city_form = strlen($City_name) >= $name_length && 
strlen($City_Lat) >= $coord_length &&
strlen($City_Long) >= $coord_length && $City_country_id != "-----";
if ($condition_city_form) {
$sql = "Insert into `city` 
(
  `Name`,
  `Lat`,
  `Long`,
  `Country_Country_ID`
)
values 
(
  '$City_name',
  '$City_Lat',
  '$City_Long',
  '$City_country_id'
)";
QueryCheck($con, $sql);
}
header("refresh:0.5; url=../admin.php");
?>