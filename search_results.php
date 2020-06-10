<?php include "includes/header.php"; ?>




<!-- 
  
  Need to understand what these are used for:
  
  
  echo "<td><img src='data:image/jpeg;base64,".base64_encode($row[1])."'/></td>";




 -->










 <section class="map-present">
  <div class="container-fluid padding content-present mt-3">
    <div class="row padding">
      <div class="col-lg-9" id="show_col">
        <div id="show_map"></div>
      </div>
      <div class="col-lg-3" id="data_col">
        <div class="some-wrapper">
          <div id="side_list">
            <?php
              $City_City_ID = $_POST['City_City_ID'];
              $query_count = "
                SELECT 
                `city`.`Name`, `city`.`City_ID`, `city`.`Lat`, `city`.`Long`,
                COUNT(`suspect`.`Suspect_ID`) as Number_Of_Suspects_In_Each_City
                FROM `suspect`
                INNER JOIN `suspect data` ON `suspect data`.`Suspect_Suspect_ID` = `suspect`.`Suspect_ID`
                INNER JOIN `area` ON `area`.`Area_ID` = `suspect data`.`Area_Area_ID`
                INNER JOIN `city`ON `city`.`City_ID` = `area`.`City_City_ID`
                WHERE `city`.`City_ID` = '$City_City_ID'
              ";
              $select_city_query = mysqli_query($con, $query_count);
              $row = mysqli_fetch_assoc($select_city_query);
              $city_name = $row['Name'];
              $Number_Sus = $row['Number_Of_Suspects_In_Each_City'];
              $Lat = $row['Lat'];
              $Long = $row['Long'];
            ?>
            <ul class="list-group">
              <li class="list-group-item">
                <h1><?= $city_name ?></h1>
              </li>
              <li class="list-group-item">
                Number of cases:
                <span class="badge badge-primary badge-pill"><?= $Number_Sus ?></span>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col-6">Coordinates: </div>
                  <div class="col-6">
                    <div class="col-12">
                      <span id="coord-present-lat" class="badge badge-warning badge-pill mb-2"><?= $Lat ?></span>
                    </div>
                    <div class="col-12">
                      <span id="coord-present-long" class="badge badge-warning badge-pill"><?= $Long ?></span>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <br>
          <form id="city-form" action="search_results.php" method="POST" style="padding: 5px;">
            <div class="form-group">
              <label for="city-input">Select city</label>
              <select name="City_City_ID" id="city-input" class="form-control">
                <option value="-----">-----</option>
                <?php
                  $query_count = "
                    SELECT 
                    `city`.`Name`, `city`.`City_ID`, `city`.`Lat`, `city`.`Long`,
                    COUNT(`suspect`.`Suspect_ID`) as Number_Of_Suspects_In_Each_City
                    FROM `suspect`
                    INNER JOIN `suspect data` ON `suspect data`.`Suspect_Suspect_ID` = `suspect`.`Suspect_ID`
                    INNER JOIN `area` ON `area`.`Area_ID` = `suspect data`.`Area_Area_ID`
                    INNER JOIN `city`ON `city`.`City_ID` = `area`.`City_City_ID`
                    GROUP BY `city`.`Name`
                  ";
                  $select_city_query = mysqli_query($con, $query_count);
                  while ($row = mysqli_fetch_assoc($select_city_query)) {
                    $City_City_ID = $row['City_ID'];
                    $city_name = $row['Name'];
                    $Number_Sus = $row['Number_Of_Suspects_In_Each_City'];
                    echo "<option value='$City_City_ID'>$city_name ($Number_Sus)</option>";
                  }
                ?>
              </select>
              <?php 
                $City_City_ID = $_POST['City_City_ID']; // use for page_city_id
                $select_city_query = mysqli_query($con, $query_count);
                while ($row = mysqli_fetch_assoc($select_city_query)) {
                  $city_id = $row['City_ID'];
                  $city_name = $row['Name'];
                  $Lat = $row['Lat'];
                  $Long = $row['Long'];
                  ?>
                  <div class="hidden">
                    <table>
                      <tbody>
                        <tr class="db_city_row">
                          <td class="db_city_id"><?= $city_id ?></td>
                          <td class="db_city_name"><?= $city_name ?></td>
                          <td class="db_city_lat"><?= $Lat ?></td>
                          <td class="db_city_long"><?= $Long ?></td>
                        </tr>
                      </tbody>
                    </table>
                    <div id="page_city_id"><?= $City_City_ID ?></div>                    
                  </div>
                  <?php
                }
              ?>
            </div>
            <input type="submit" value="Search" class="btn btn-primary btn-sm">
            <button id="back-button" type="button" class="btn btn-secondary btn-sm gone">Back</button>            
          </form>
        </div>
      </div>
    </div>
  </div>
</section>




<div class="container mt-4">






<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Street</th>
      <th scope="col">Latitude</th>
      <th scope="col">Longitude</th>
      <!-- <th scope="col">Area name</th> -->
      <!-- <th scope="col">Description</th> -->
      <th scope="col">First name</th>
      <th scope="col">Last name</th>
      <th scope="col">Group name</th>
      <th scope="col">Gender</th>
      <th scope="col">Suspect_ID</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Suspect data from this city
    $City_City_ID = $_POST['City_City_ID'];
    $sql = "
      SELECT a.street, a.Lat, a.Long, a.area_name, sd.description, 
      p.First_name, p.Last_name, p.Gender, age.Group_name, s.Suspect_ID  
      FROM (SELECT * FROM Area WHERE Area.City_City_ID = '$City_City_ID') AS a 
      INNER JOIN `suspect data` AS sd ON sd.Area_Area_ID = a.Area_ID 
      INNER JOIN suspect AS s ON s.Suspect_ID = sd.Suspect_Suspect_ID 
      INNER JOIN person AS p ON p.Person_ID = s.Person_Person_ID 
      INNER JOIN age_group AS age ON age.Age_Group_ID = s.Age_Group_Age_Group_ID
      ORDER BY p.First_name
    ";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $Street = $row['Street'];
      $Lat = $row['Lat'];
      $Long = $row['Long'];
      $Area_name = $row['Area_name'];
      $Description = $row['description'];
      $First_name = $row['First_name'];
      $Last_name = $row['Last_name'];
      $Group_name = $row['Group_name'];
      $Gender = $row['Gender'];
      $Suspect_ID = $row['Suspect_ID'];

      ?>
      <tr class="db_data_marker">
        <td class="db_data_marker_street"><?= $Street ?></td>
        <td class="db_data_marker_lat"><?= $Lat ?></td>
        <td class="db_data_marker_long"><?= $Long ?></td>
        <td class="db_data_marker_first"><?= $First_name ?></td>
        <td class="db_data_marker_last"><?= $Last_name ?></td>
        <td class="db_data_marker_group"><?= $Group_name ?></td>
        <td class="db_data_marker_gender"><?= $Gender ?></td>
        <td class="db_data_marker_suspect_id"><?= $Suspect_ID ?></td>
        <th>
          <form action="suspect_details.php" method="POST">
            <input type="text" class="hidden" name="Suspect_ID" value="<?= $Suspect_ID ?>">
            <input type="submit" class="btn btn-info btn-sm" value="See">
          </form>
        </th>
      </tr>
      <?php

    }
    ?>
  </tbody>
</table>
</div>













<script src="./static/javascript/map/setup.js"></script>
<script src="./static/javascript/map/global.js"></script>
<script src="./static/javascript/map/displaymap.js"></script>
<script>


// document.querySelector('#city-form').addEventListener('submit', (e) => {
//   e.preventDefault();
//   const name = document.querySelector('#city-input').value;
//   refreshMap(name);
// });
// document.querySelector('#back-button').addEventListener('click', (e) => {
//   e.preventDefault();
//   document.querySelector('#show_col').className = "col-lg-9";
//   document.querySelector('#data_col').className = "col-lg-3";
//   const name = document.querySelector('#city-input').value;
//   refreshMap(name);
//   document.querySelector('#back-button').classList.add('gone');
//   document.querySelector('#side_list > ul').classList.remove('gone');
//   document.querySelector('.specific').remove();
// });


let pageCity = document.querySelector('#page_city_id');
const matches = cities.filter(city => city.city_id === pageCity.textContent);
let mymap = setup('show_map', [matches[0].latitude, matches[0].longitude], 11);
mymap.on('mousemove', mapUI.showCoords);
mapUI.displayMarkers(mymap, pageCity.textContent, pageCity.textContent);






</script>










<?php include "includes/footer.php"; ?>