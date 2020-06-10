

<?php include "./includes/header.php"; ?>



<div class="container mt-4">
	<h1>Add suspect</h1>
	<form action="./creates/create_main.php" method="POST">
		<div class="row">
			<!-- Column for Suspect data -->
			<div class="col-9">
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="list-age_group" role="tabpanel" aria-labelledby="list-age_group-list">
						<div class="row">
							<div class="col-12">
								<div class="form-group dropdown-pack">
									<label class="required-field" for="Age_Group_Age_Group_ID">Suspect Age Group</label>
									<select onchange="checkIfEmpty_AgeGroup(this)" name="Age_Group_Age_Group_ID" id="Age_Group_Age_Group_ID" class="form-control inline-80">
										<option value="-----">-----</option>
										<?php
											$query = "SELECT * FROM `Age_Group`";
											$select_all_AgeGroups_query = mysqli_query($con, $query);
											while ($row = mysqli_fetch_assoc($select_all_AgeGroups_query)) {
												$Age_Group_ID = $row['Age_Group_ID'];
												$Age_Group_Name = $row['Group_name'];
												$Upper_boundary = $row['Upper_boundary'];
												$Lower_boundary = $row['Lower_boundary'];
												echo "<option value='$Age_Group_ID'>$Age_Group_Name ($Lower_boundary - $Upper_boundary)</option>";
											}
										?>
									</select>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showCreateAgeGroup">New Age Group</button>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="Role_start_date">Role start date</label>
									<input type="date" id="Role_start_date" class="form-control" name="Role_start_date">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="Role_end_date">Role end date</label>
									<input type="date" id="Role_end_date" class="form-control" name="Role_end_date">
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="list-personal_info" role="tabpanel" aria-labelledby="list-personal_info-list">
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label class="required-field" for="First_name">First name</label>
									<input onchange="checkIfEmpty_person(this)" type="text" id="First_name" class="form-control" name="First_name" placeholder="Minimum <?= $name_length ?> characters">
								</div>
								<div class="form-group">
									<label for="Middle_name">Middle name</label>
									<input type="text" id="Middle_name" class="form-control" name="Middle_name">
								</div>
								<div class="form-group">
									<label class="required-field" for="Last_name">Last name</label>
									<input onchange="checkIfEmpty_person(this)" type="text" id="Last_name" class="form-control" name="Last_name" placeholder="Minimum <?= $name_length ?> characters">
								</div>
								<div class="form-group">
									<label class="required-field" for="Gender">Gender</label>
									<select onchange="checkIfEmpty_person(this)" name="Gender" id="Gender" class="form-control">
										<option value="-----">-----</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
										<option value="Other">Other</option>
									</select>
								</div>
								<div class="form-group dropdown-pack">
									<label for="Place_of_birth_city_id">Place of birth</label>
									<select name="Place_of_birth_city_id" id="Place_of_birth_city_id" class="form-control inline-80">
										<option value="-----">-----</option>
										<?php
											$query = "SELECT * FROM `city`";
											$select_all_city_query = mysqli_query($con, $query);
											while ($row = mysqli_fetch_assoc($select_all_city_query)) {
												$city_id = $row['City_ID'];
												$city_name = $row['Name'];
												echo "<option value='$city_id'>$city_name</option>";
											}
										?>
									</select>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showCreateCity">New City</button>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="First_name_at_birth">First name at birth</label>
									<input type="text" id="First_name_at_birth" class="form-control" name="First_name_at_birth">
								</div>
								<div class="form-group">
									<label for="Middle_name_at_birth">Middle name at birth</label>
									<input type="text" id="Middle_name_at_birth" class="form-control" name="Middle_name_at_birth">
								</div>
								<div class="form-group">
									<label for="Last_name_at_birth">Last name at birth</label>
									<input type="text" id="Last_name_at_birth" class="form-control" name="Last_name_at_birth">
								</div>
								<div class="form-group">
									<label for="Gender_at_birth">Gender at birth</label>
									<select name="Gender_at_birth" id="Gender_at_birth" class="form-control">
										<option value="-----">-----</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
										<option value="Other">Other</option>
									</select>
								</div>
								<div class="form-group">
									<label for="Date_of_birth">Date of birth</label>
									<input type="date" id="Date_of_birth" class="form-control" name="Date_of_birth">
								</div>
								<div class="form-group">
									<label for="Date_of_death">Date of death</label>
									<input type="date" id="Date_of_death" class="form-control" name="Date_of_death">
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="list-area_related" role="tabpanel" aria-labelledby="list-area_related-list">
						<div id="area_info_wrapper" class="col-12 row">
							<div class="form-group col-8 dropdown-pack">
								<label class="required-field" for="Area_city_id">City</label>
								<select onchange="checkIfEmpty_area(this)" name="Area_city_id" id="Area_city_id" class="form-control inline-80">
									<option value="-----">-----</option>
									<?php
										$query = "SELECT * FROM `city`";
										$select_all_city_query = mysqli_query($con, $query);
										while ($row = mysqli_fetch_assoc($select_all_city_query)) {
											$city_id = $row['City_ID'];
											$city_name = $row['Name'];
											echo "<option value='$city_id'>$city_name</option>";
										}
									?>
								</select>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showCreateCity">New City</button>
							</div>
							<div class="form-group col-6">
								<label for="Area_Lat">Latitude</label>
								<input type="text" id="Area_Lat" class="form-control" name="Area_Lat" placeholder="Minimum <?= $coord_length ?> characters">
							</div>
							<div class="form-group col-6">
								<label for="Area_Long">Longitude</label>
								<input type="text" id="Area_Long" class="form-control" name="Area_Long" placeholder="Minimum <?= $coord_length ?> characters">
							</div>
							<div class="form-group col-8">
								<label for="Area_name">Area Name</label>
								<!-- <select name="Area_name" id="Area_name" class="form-control">
										<option value="-----">-----</option>
										<option value="JM primary school">JM primary school</option>
										<option value="PTE grammar school">PTE grammar school</option>
										<option value="ABC company">ABC company</option>
										<option value="DEF company">DEF company</option>
								</select> -->
								<input type="text" id="Area_name" class="form-control" name="Area_name">
							</div>
							<div class="form-group col-4">
								<label for="Zip">Zip code</label>
								<input type="text" id="Zip" class="form-control" name="Zip">
							</div>
							<div class="form-group col-4">
								<label for="Street">Street</label>
								<input type="text" id="Street" class="form-control" name="Street">
							</div>
							<div class="form-group col-4">
								<label for="Building_number">Building number</label>
								<input type="text" id="Building_number" class="form-control" name="Building_number">
							</div>
							<div class="form-group col-4">
								<label for="Floor">Floor</label>
								<input type="text" id="Floor" class="form-control" name="Floor">
							</div>
							<div class="form-group col-4">
								<label for="Door_number">Door number</label>
								<input type="text" id="Door_number" class="form-control" name="Door_number">
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="list-media_stuff" role="tabpanel" aria-labelledby="list-media_stuff-list">
						<div class="col-12 row" id="media_info_wrapper">
							<div class="input-group mb-3">
								<div class="custom-file col-8">
									<!-- Temporarily disabled. Not necessary for our presentation -->
									<input type="file" class="custom-file-input" name="Media_file" id="Media_file" disabled>
									<label class="custom-file-label" for="Media_file">Media file</label>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="list-info_details" role="tabpanel" aria-labelledby="list-info_details-list">
						<h5 class="mt-4 col-12">Details</h5>	
						<div class="col-12">
							<div class="form-group">
								<label class="required-field" for="Data_validity_begin_time">Validity begin time</label>
								<input onchange="checkIfEmpty_info(this)" type="date" id="Data_validity_begin_time" class="form-control" name="Data_validity_begin_time">
							</div>
							<div class="form-group">
								<label for="Data_expiry_time">Expiry time</label>
								<input type="date" id="Data_expiry_time" class="form-control" name="Data_expiry_time">
							</div>
							<div class="form-group dropdown-pack">
								<label class="required-field" for="Information_type_id">Type of information</label>
								<select onchange="checkIfEmpty_info(this)" name="Information_type_id" id="Information_type_id" class="form-control inline-80">
									<option value="-----">-----</option>
									<?php
										$query = "SELECT * FROM `data information type`";
										$select_all_infoType_query = mysqli_query($con, $query);
										while ($row = mysqli_fetch_assoc($select_all_infoType_query)) {
											$InfoType_ID = $row['InfoType_ID'];
											$infoType_name = $row['Type_name'];
											echo "<option value='$InfoType_ID'>$infoType_name</option>";
										}
									?>
								</select>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showCreateInfoType">New InfoType</button>
							</div>
							<div class="form-group">
								<label for="Information_description">Description</label>
								<textarea name="Information_description" id="Information_description" class="form-control" style="height: 200px;"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="list-group" id="list-tab" role="tablist">
					<a class="list-group-item list-group-item-action active weAreNotDone" id="list-age_group-list" data-toggle="list" href="#list-age_group" role="tab" aria-controls="age_group">Suspect Age Group</a>
					<a class="list-group-item list-group-item-action weAreNotDone" id="list-personal_info-list" data-toggle="list" href="#list-personal_info" role="tab" aria-controls="personal_info">Personal info</a>
					<br>
					<a class="list-group-item list-group-item-action weAreNotDone" id="list-area_related-list" data-toggle="list" href="#list-area_related" role="tab" aria-controls="area_related">Area related</a>
					<a class="list-group-item list-group-item-action weAreNotDone" id="list-media_stuff-list" data-toggle="list" href="#list-media_stuff" role="tab" aria-controls="media_stuff">Media</a>
					<a class="list-group-item list-group-item-action weAreNotDone" id="list-info_details-list" data-toggle="list" href="#list-info_details" role="tab" aria-controls="info_details">Info details</a>
				</div>
			</div>
		</div>
		<input type="submit" class="btn btn-primary btn-lg" style="width: 70%; margin: 20px 15%;" value="Insert">
	</form>
</div>





<!-- Modals START -->
<div class="modal fade" id="showCreateAgeGroup" tabindex="-1" role="dialog" aria-labelledby="showCreateAgeGroupLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showCreateAgeGroupLabel">Create Suspect Age Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form id="ageGroupForm" action="./creates/create_ageGroup.php" method="POST">
					<div class="form-group">
						<label class="required-field" for="Age_Group_Name">Age Group name</label>
						<input type="text" id="Age_Group_Name" class="form-control" name="Age_Group_Name" placeholder="Minimum <?= $string_length ?> characters">
					</div>
					<div class="form-group">
						<label class="required-field" for="Age_Group_Description">Description</label>
						<input type="text" id="Age_Group_Description" class="form-control" name="Age_Group_Description">
					</div>
					<div class="form-group">
						<label class="required-field" for="Lower_Boundary">Lower Boundary</label>
						<input type="text" id="Lower_Boundary" class="form-control" name="Lower_Boundary">
					</div>
					<div class="form-group">
						<label class="required-field" for="Upper_Boundary">Upper Boundary</label>
						<input type="text" id="Upper_Boundary" class="form-control" name="Upper_Boundary">
					</div>
				</form>
      </div>
      <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input form="ageGroupForm" type="submit" class="btn btn-success" value="Save">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="showCreateCountry" tabindex="-1" role="dialog" aria-labelledby="showCreateCountryLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showCreateCountryLabel">Create Country</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form id="countryForm" action="./creates/create_country.php" method="POST">
					<div class="form-group">
						<label class="required-field" for="Country_name">Country name</label>
						<input type="text" id="Country_name" class="form-control" name="Country_name" placeholder="Minimum <?= $name_length ?> characters">
					</div>
					<div class="form-group">
						<label class="required-field" for="Country_Lat">Latitude</label>
						<input type="text" id="Country_Lat" class="form-control" name="Country_Lat" placeholder="Minimum <?= $coord_length ?> characters">
					</div>
					<div class="form-group">
						<label class="required-field" for="Country_Long">Longitude</label>
						<input type="text" id="Country_Long" class="form-control" name="Country_Long" placeholder="Minimum <?= $coord_length ?> characters">
					</div>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input form="countryForm" type="submit" class="btn btn-success" value="Save">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="showCreateCity" tabindex="-1" role="dialog" aria-labelledby="showCreateCityLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showCreateCityLabel">Create City</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form id="cityForm" action="./creates/create_city.php" method="POST">
					<div class="form-group">
						<label class="required-field" for="City_name">City name</label>
						<input type="text" id="City_name" class="form-control" name="City_name" placeholder="Minimum <?= $name_length ?> characters">
					</div>
					<div class="form-group">
						<label class="required-field" for="City_Lat">Latitude</label>
						<input type="text" id="City_Lat" class="form-control" name="City_Lat" placeholder="Minimum <?= $coord_length ?> characters">
					</div>
					<div class="form-group">
						<label class="required-field" for="City_Long">Longitude</label>
						<input type="text" id="City_Long" class="form-control" name="City_Long" placeholder="Minimum <?= $coord_length ?> characters">
					</div>
					<div class="form-group dropdown-pack">
						<label class="required-field" for="City_country_id">Country</label>
						<select name="City_country_id" id="City_country_id" class="form-control inline-80">
								<option value="-----">-----</option>
								<?php
									$query = "SELECT * FROM country";
									$select_all_country_query = mysqli_query($con, $query);
									while ($row = mysqli_fetch_assoc($select_all_country_query)) {
										$country_id = $row['Country_ID'];
										$country_name = $row['Name'];
										echo "<option value='$country_id'>$country_name</option>";
									}
								?>
						</select>
						<button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#showCreateCountry">
							New Country
						</button>
					</div>
				</form>
      </div>
      <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input form="cityForm" type="submit" class="btn btn-success" value="Save">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="showCreateInfoType" tabindex="-1" role="dialog" aria-labelledby="showCreateInfoTypeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showCreateInfoTypeLabel">Create Information type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form id="infoTypeForm" action="./creates/create_information_type.php" method="POST">
					<div class="form-group">
						<label class="required-field" for="Information_type_name">Information type name</label>
						<input type="text" id="Information_type_name" class="form-control" name="Information_type_name" placeholder="Minimum <?= $string_length ?> characters">
					</div>
					<div class="form-group">
						<label class="required-field" for="Information_type_description">Information type description</label>
						<input type="text" id="Information_type_description" class="form-control" name="Information_type_description" placeholder="Minimum <?= $string_length ?> characters">
					</div>
				</form>
      </div>
      <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input form="infoTypeForm" type="submit" class="btn btn-success" value="Save">
      </div>
    </div>
  </div>
</div>
<!-- Modals END -->







<?php include "./includes/footer.php"; ?>