<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php


$First_name  = $_POST['First_name'];
$Middle_name  = $_POST['Middle_name'];
$Last_name   = $_POST['Last_name'];
$First_name_at_birth = $_POST['First_name_at_birth'];
$Middle_name_at_birth   = $_POST['Middle_name_at_birth'];
$Last_name_at_birth  = $_POST['Last_name_at_birth'];
$Gender_at_birth  = $_POST['Gender_at_birth'];
$Gender   = $_POST['Gender'];
$Place_of_birth_city_id = $_POST['Place_of_birth_city_id'];
$Date_of_birth  = $_POST['Date_of_birth'];
$Date_of_death   = $_POST['Date_of_death'];






$Age_Group_Age_Group_ID = $_POST['Age_Group_Age_Group_ID'];
$Role_start_date = $_POST['Role_start_date'];
$Role_end_date = $_POST['Role_end_date'];




$Area_name  = $_POST['Area_name'];
$Area_city_id  = $_POST['Area_city_id'];
$Area_Lat  = $_POST['Area_Lat'];
$Area_Long  = $_POST['Area_Long'];
$Zip   = $_POST['Zip'];
$Street = $_POST['Street'];
$Building_number   = $_POST['Building_number'];
$Floor  = $_POST['Floor'];
$Door_number  = $_POST['Door_number'];





$Data_validity_begin_time = $_POST['Data_validity_begin_time'];
$Data_expiry_time = $_POST['Data_expiry_time'];
$area_id_recent;
$Information_type_id = $_POST['Information_type_id']; //mandatory
$Information_description = $_POST['Information_description'];
$suspect_id_recent; //mandatory
$user_id = 445577; //mandatory WARNING: you need to have it already in the database!












$condition_main_form = $Age_Group_Age_Group_ID != "-----" && 
strlen($First_name) >= $name_length && 
strlen($Last_name) >= $name_length && $Gender != "-----";

$condition_suspectData_form = $Data_validity_begin_time != NULL && 
$Information_type_id != "-----";

$condition_area_form = $Area_city_id != "-----" && 
$condition_suspectData_form;








if ($condition_main_form) {



// 1. Create new "Person"
include "./sub_creates/create_person.php";
QueryCheck($con, $sql);
$person_id_recent = mysqli_fetch_array(mysqli_query($con, "SELECT LAST_INSERT_ID()"))[0];

// 2. Create new "Suspect"
include "./sub_creates/create_suspect.php";
QueryCheck($con, $sql);
$suspect_id_recent = mysqli_fetch_array(mysqli_query($con, "SELECT LAST_INSERT_ID()"))[0];











// 3. Create new "Area"
if ($condition_area_form) {
	include "./sub_creates/create_area.php";
	QueryCheck($con, $sql);
	$area_id_recent = mysqli_fetch_array(mysqli_query($con, "SELECT LAST_INSERT_ID()"))[0];
} else {
	echo '<h1 style="color: aqua;">NO AREA WILL BE ADDED</h1>';
	$area_id_recent = '';
}

// 4. Create new "Suspect Data"
if ($condition_suspectData_form) {
	include "./sub_creates/create_suspect_data.php";
	QueryCheck($con, $sql);
} else {
	echo '<h1 style="color: aqua;">NO Additional Info WILL BE ADDED</h1>';
}












echo "<h1>Person: $person_id_recent</h1>";
echo "<h1>Suspect: $suspect_id_recent</h1>";
echo "<h1>Area: $area_id_recent</h1>";


} else {
	// sth to do?? Nah..
}
header("refresh:0.5; url=../admin.php");
?>