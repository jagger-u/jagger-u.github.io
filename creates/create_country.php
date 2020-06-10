<?php include "../includes/db.php";  ?>
<?php include "../includes/functions.php"; ?>
<?php
$Country_name= $_POST['Country_name'];
$Country_Lat= $_POST['Country_Lat'];
$Country_Long= $_POST['Country_Long'];
$condition_country_form = strlen($Country_name) >= $name_length && 
strlen($Country_Lat) >= $coord_length && strlen($Country_Long) >= $coord_length;
if ($condition_country_form) {
$sql = "Insert into `country` 
(
  `Name`,
  `Lat`,
  `Long`
)
values 
(
  '$Country_name',
  '$Country_Lat',
  '$Country_Long'
)";
QueryCheck($con, $sql);
}
header("refresh:0.5; url=../admin.php");
?>