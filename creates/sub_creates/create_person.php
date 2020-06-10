<?php
$sql = "Insert into `person` 
(
	`First_name`, 
	`Middle_name`, 
	`Last_name`, 
	`First_name_at_birth`, 
	`Middle_name_at_birth`, 
	`Last_name_at_birth`, 
	`Gender_at_birth`, 
	`Gender`, 
	`Place_of_birth`, 
	`Date_of_birth`, 
	`Date_of_death`
)
values 
(
	'$First_name',
	'$Middle_name',
	'$Last_name',
	'$First_name_at_birth',
	'$Middle_name_at_birth',
	'$Last_name_at_birth',
	'$Gender_at_birth',
	'$Gender',
	'$Place_of_birth_city_id',
	" . ($Date_of_birth==NULL ? "NULL" : "'$Date_of_birth'") . ",
	" . ($Date_of_death==NULL ? "NULL" : "'$Date_of_death'") . "
)";
$person_id_recent = mysqli_insert_id($con);
?>