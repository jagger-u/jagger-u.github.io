

<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>



<html>
<head>
  <meta charset="utf-8">
  <meta class="form-control" name="viewport" content="width=device-width, initial-scale=1">
  <title>Avaxx Monitor</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kalam:700&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Pangolin&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
  crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	crossorigin=""/>
	






  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>









  <link rel="stylesheet" href="static/css/style.css">
</head>










<style>
	.hidden {
		display: none;
	}
	.dropdown-pack {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
	}
	.dropdown-pack label {
		width: 100%;
	}
	.inline-80 {
		flex-grow: 1;
    flex-shrink: 1;
    flex-basis: 50%;
    margin-right: 10px;
	}
	.required-field:after {
		content: "*";
		margin-left: 5px;
		color: red;
	}
	.weAreNotDone:after {
		content: "";
    color: #fff;
    position: absolute;
    right: 10px;
    top: calc(50% - 16px);
    border-radius: 5px;
    font-size: 15px;
    padding: 5px 7px;
    background: #efefefde;
		height: 30px;
		width: 50px;
		display: flex;
    justify-content: center;
    align-items: center;
	}
	.weAreNotDoneYet:after {
		content: "";
		background: #dc3545;
	}
	.weAreDone:after {
		content: "Done";
		background: #33c533;
	}
	.marker-wrapper {
		width: 250px;
		display: flex;
		justify-content: space-between;
	}
</style>




<header>
	<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
		<div class="container">
			<a href="./index.php" class="navbar-brand"><img src="./static/images/logo.png" alt=""></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a href="./index.php" class="nav-link">Intro</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">Map</a>
					</li>
					<li class="nav-item">
						<a href="./admin.php" class="nav-link">Admin</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">Research</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">Communities</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">Contact</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
<body>


