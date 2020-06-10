<?php 
function QueryCheck($con, $sql) {
	if(!mysqli_query($con, $sql))
	{
		?>
		<h1><?= $sql ?></h1>
		<h1 style="width: 100%; display: flex; justify-content: center;"><span style="color: red; text-transform: uppercase; font-size: 50px;">failed</span></h1>
		<?php
	}
	else
	{
		?>
		<h1><?= $sql ?></h1>
		<h1 style="width: 100%; display: flex; justify-content: center;"><span style="color: green; text-transform: uppercase; font-size: 50px;">success</span></h1>
		<?php
	}
}







$name_length = 2;
$string_length = 5;
$coord_length = 7;


?>