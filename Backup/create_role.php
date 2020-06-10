<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php
$Suspect_role_type= $_POST['Suspect_role_type'];
$Suspect_role_description= $_POST['Suspect_role_description'];
$condition_role_form = strlen($Suspect_role_type) >= $string_length &&
strlen($Suspect_role_description) >= $string_length;
if ($condition_role_form) {
$sql = "Insert into `suspect role` 
(
  Type, 
  Description
)
values 
(
  '$Suspect_role_type',
  '$Suspect_role_description'
)";
QueryCheck($con, $sql);
}
header("refresh:0.5; url=../admin.php");
?>