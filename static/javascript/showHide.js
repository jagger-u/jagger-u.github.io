

function checkIfEmpty_AgeGroup(e) {
  let input = document.querySelector('#Age_Group_Age_Group_ID').value;
  let option = document.querySelector('#list-age_group-list');
  if (input != "-----") {
    option.classList.add('weAreDone');
  } else {
    option.classList.remove('weAreDone');
  }
}

function checkIfEmpty_person(e) {
  let firstname = document.querySelector('#First_name').value;
  let lastname = document.querySelector('#Last_name').value;
  let gender = document.querySelector('#Gender').value;
  let option = document.querySelector('#list-personal_info-list');
  if (firstname.length >= 2 && lastname.length >= 2 && gender != "-----") {
    option.classList.add('weAreDone');
  } else {
    option.classList.remove('weAreDone');
  }
}

function checkIfEmpty_area(e) {
  let area = document.querySelector('#Area_city_id').value;
  let option = document.querySelector('#list-area_related-list');
  let nextoption = document.querySelector('#list-info_details-list');

  let begintime = document.querySelector('#Data_validity_begin_time');
  let expirytime = document.querySelector('#Data_expiry_time');
  let infotype = document.querySelector('#Information_type_id');
  let infoDesc = document.querySelector('#Information_description');
  begintime.value = "";
  expirytime.value = "";
  infotype.value = "-----";
  infoDesc.value = "";
  if (area != "-----") {
    option.classList.add('weAreDone');
    nextoption.classList.add('weAreNotDoneYet');
    nextoption.classList.remove('weAreDone');
  } else {
    option.classList.remove('weAreDone');
    nextoption.classList.remove('weAreDone');
    nextoption.classList.remove('weAreNotDoneYet');
  }
}

function checkIfEmpty_info(e) {
  let area = document.querySelector('#Area_city_id').value;

  let begintime = document.querySelector('#Data_validity_begin_time').value;
  let infotype = document.querySelector('#Information_type_id').value;
  let option = document.querySelector('#list-info_details-list');
  if (begintime != "" && infotype != "-----") {
    option.classList.remove('weAreNotDoneYet');
    option.classList.add('weAreDone');
  } else if (area != "-----") {
    option.classList.remove('weAreDone');
    option.classList.add('weAreNotDoneYet');
  } else {
    option.classList.remove('weAreDone');
  }
}