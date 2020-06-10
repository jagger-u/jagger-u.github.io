<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php
$Connection_Start_Date= $_POST['Connection_Start_Date'];
$Connection_End_Date= $_POST['Connection_End_Date'];
$Suspect_Suspect_ID1= $_POST['Suspect_Suspect_ID1'];
$Suspect_Suspect_ID2= $_POST['Suspect_Suspect_ID2'];
$Relation_Relation_ID= $_POST['Relation_Relation_ID'];
$condition_connection_form = $Suspect_Suspect_ID1 != "-----" && $Suspect_Suspect_ID2 != "-----" &&
$Relation_Relation_ID != "-----";
if ($condition_connection_form) {
$sql = "Insert into `Suspect_Connection` 
(
  `Start_Date`,
  `End_Date`,
  `Suspect_Suspect_ID1`,
  `Suspect_Suspect_ID2`,
  `Relation_Relation_ID`
)
values 
(
  " . ($Connection_Start_Date==NULL ? "NULL" : "'$Connection_Start_Date'") . ",
  " . ($Connection_End_Date==NULL ? "NULL" : "'$Connection_End_Date'") . ",
  '$Suspect_Suspect_ID1',
  '$Suspect_Suspect_ID2',
  '$Relation_Relation_ID',
)";
QueryCheck($con, $sql);
}
header("refresh:0.5; url=../admin.php");
?>