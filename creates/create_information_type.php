<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php
$Information_type_name= $_POST['Information_type_name'];
$Information_type_description= $_POST['Information_type_description'];
$condition_info_form = strlen($Information_type_name) >= $string_length && strlen($Information_type_description) >= $string_length;
if ($condition_info_form) {
// need to use backticks. when the table has space
$sql = "Insert into `data information type` 
(
	`Type_name`, 
	`Type_description`
)
values (
	'$Information_type_name',
	'$Information_type_description'
)";
QueryCheck($con, $sql);
}
header("refresh:0.5; url=../admin.php");
?>