<?php 
$sql = "Insert into `suspect data` 
(
  `Media_file`,
  `Data_validity_begin_time`, 
  `Data_expiry_time`, 
  `Description`,
  `Area_Area_ID`, 
  `Data information type_InfoType_ID`, 
  `Suspect_Suspect_ID`, 
  `User_User_ID`
)
values 
(
  NULL,
  " . ($Data_validity_begin_time==NULL ? "NULL" : "'$Data_validity_begin_time'") . ",
  " . ($Data_expiry_time==NULL ? "NULL" : "'$Data_expiry_time'") . ",
  '$Information_description',
  " . ($area_id_recent==NULL ? "NULL" : "'$area_id_recent'") . ",
  '$Information_type_id',
  '$suspect_id_recent',
  '$user_id'
)";
?>