<?php include "./includes/header.php"; ?>









<div class="container mt-4">





<div class="jumbotron">
  <h1 class="display-4">Welcome to the Avaxx Monitor!</h1>
  <p class="lead">Please start by entering the city name.</p>
  <form action="search_results.php" method="POST">
    <div class="form-group">
      <select name="City_City_ID" id="City_City_ID" class="form-control">
        <?php
          $query_count = "
            SELECT 
            `city`.`Name`, `city`.`City_ID`,
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
    </div>
    <div class="form-group">
      <input type="submit" value="Search" class="btn btn-primary">
    </div>
  </form>
</div>




</div>














<?php include "./includes/footer.php"; ?>