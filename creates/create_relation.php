<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php
$Relation_name= $_POST['Relation_name'];
$Relation_description= $_POST['Relation_description'];
$condition_relation_form = strlen($Relation_name) >= $string_length && 
strlen($Relation_description) >= $string_length;
if ($condition_relation_form) {
$sql = "Insert into Relation 
(
  `Relation_name`,
  `Description`
)
values 
(
  '$Relation_name',
  '$Relation_description'
)";
QueryCheck($con, $sql);
}
header("refresh:0.5; url=../admin.php");
?>