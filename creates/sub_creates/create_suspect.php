<?php
$sql = "Insert into `suspect` 
(
	`Age_Group_Age_Group_ID`,
	`Person_Person_ID`, 
	`Start_Date`, 
	`End_Date`)
values 
(
	'$Age_Group_Age_Group_ID',
	'$person_id_recent',
	" . ($Role_start_date==NULL ? "NULL" : "'$Role_start_date'") . ",
	" . ($Role_end_date==NULL ? "NULL" : "'$Role_end_date'") . "
)";
$suspect_id_recent = mysqli_insert_id($con);
?>