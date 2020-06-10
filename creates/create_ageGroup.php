<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php
$Age_Group_Name= $_POST['Age_Group_Name'];
$Age_Group_Description= $_POST['Age_Group_Description'];
$Upper_Boundary= $_POST['Upper_Boundary'];
$Lower_Boundary= $_POST['Lower_Boundary'];

$condition_ageGroup_form = strlen($Age_Group_Name) >= $string_length;
if ($condition_ageGroup_form) {
$sql = "Insert into `Age_Group` 
(
  `Group_name`,
  `Group_Description`,
  `Upper_Boundary`,
  `Lower_Boundary`
)
values 
(
  '$Age_Group_Name',
  '$Age_Group_Description',
  " . ($Upper_Boundary==NULL ? "NULL" : "'$Upper_Boundary'") . ",
  " . ($Lower_Boundary==NULL ? "NULL" : "'$Lower_Boundary'") . "
)";
QueryCheck($con, $sql);
}
header("refresh:0.5; url=../admin.php");
?>