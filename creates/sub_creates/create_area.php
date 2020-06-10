<?php
$sql = "Insert into `area` 
(
  `Area_name`,
  `City_City_ID`,
  `Lat`,
  `Long`,
  `ZIP`,
  `Street`,
  `Building_number`,
  `Floor`,
  `Door_number`
)
values 
(
  '$Area_name',
  '$Area_city_id',
  '$Area_Lat',
  '$Area_Long',
  " . ($Zip==NULL ? "NULL" : "'$Zip'") . ",
  '$Street',
  " . ($Building_number==NULL ? "NULL" : "'$Building_number'") . ",
  " . ($Floor==NULL ? "NULL" : "'$Floor'") . ",
  " . ($Door_number==NULL ? "NULL" : "'$Door_number'") . "
)";
?>