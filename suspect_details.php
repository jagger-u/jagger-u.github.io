<?php include "includes/header.php"; ?>


















<div class="container mt-4">



<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">First_name</th>
      <th scope="col">Last_name</th>
      <th scope="col">Gender</th>
      <th scope="col">Data_validity_begin_time</th>
      <!-- <th scope="col">Data_expiry_time</th> -->
      <th scope="col">Description</th>
      <th scope="col">Type_name</th>
      <th scope="col">Street</th>
      <th scope="col">Lat</th>
      <th scope="col">Long</th>
      <th scope="col">Suspect_ID</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Suspect data from this city
    $Suspect_ID = $_POST['Suspect_ID'];
    // $sql = "
    // SELECT a.street, a.Lat, a.area_name, sd.description, 
    // p.First_name, p.Last_name, p.Gender, age.Group_name, sus.Suspect_ID  
    // FROM (SELECT * FROM Suspect WHERE Suspect.Suspect_ID = '$Suspect_ID') as sus 
    // INNER JOIN `suspect data` as sd ON sd.Area_Area_ID = a.Area_ID 
    // INNER JOIN area as a ON a.Area_ID = sd.Area_Area_ID 
    // INNER JOIN person as p ON p.Person_ID = s.Person_Person_ID 
    // INNER JOIN age_group as age ON age.Age_Group_ID = s.Age_Group_Age_Group_ID

    // ";
    $sql = "
      SELECT `person`.First_name, `person`.Last_name, `person`.`Gender`, 
      `suspect data`.`Data_validity_begin_time`, `suspect data`.`Data_expiry_time`, 
      `suspect data`.`Description`, 
      `data information type`.`Type_name`, 
      `area`.`Street`, `area`.`Lat`, `area`.`Long` 
      FROM `suspect data` 
      INNER JOIN `data information type` ON 
      `data information type`.`InfoType_ID` = `suspect data`.`Data information type_InfoType_ID` 
      INNER JOIN `area` ON `area`.`Area_ID` = `suspect data`.`Area_Area_ID` 
      INNER JOIN `suspect` ON `suspect`.`Suspect_ID` = `suspect data`.`Suspect_Suspect_ID` 
      INNER JOIN `person` ON `person`.`Person_ID` = `suspect`.`Person_Person_ID` 
      WHERE `suspect data`.`Suspect_Suspect_ID` = '$Suspect_ID'
      ORDER BY `suspect data`.`Data_validity_begin_time`
    ";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $First_name = $row['First_name'];
      $Last_name = $row['Last_name'];
      $Gender = $row['Gender'];
      $Data_validity_begin_time = $row['Data_validity_begin_time'];
      $Data_expiry_time = $row['Data_expiry_time'];
      $Description = $row['Description'];
      $Type_name = $row['Type_name'];
      $Street = $row['Street'];
      $Lat = $row['Lat'];
      $Long = $row['Long'];
      echo "<tr>";
      echo "<td>$First_name</td>";
      echo "<td>$Last_name</td>";
      echo "<td>$Gender</td>";
      echo "<td>$Data_validity_begin_time</td>";
      // echo "<td>$Data_expiry_time</td>";
      echo "<td>$Description</td>";
      echo "<td>$Type_name</td>";
      echo "<td>$Street</td>";
      echo "<td>$Lat</td>";
      echo "<td>$Long</td>";
      echo "<td>$Suspect_ID</td>";
      ?>
      <?php
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
</div>


<?php include "includes/footer.php"; ?>