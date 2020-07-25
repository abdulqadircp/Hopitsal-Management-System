<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<title>Dr. <?php echo $_SESSION['doc_name'];?> | dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-gray w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>  <br>Hospital</b></h3>
  </div>
  <div class="w3-bar-block">
     
  <a href="dr_appointment_view.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">View Appointments</a>  
  <a href="dr_blood_group.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Blood Group Finder</a> 
   
   <br>
   <a href="dr_about.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">About</a> 
   <br> <br><br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
   <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Logout</a>  
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-gray w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-gray w3-margin-right" onclick="w3_open()">☰</a>
  <span>   Hospital</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Header -->
  <div class="w3-container" style="margin-top:80px" id="showcase">
    <h1 class="w3-jumbo"><b>Dr. <?php echo $_SESSION['doc_name'];?></b></h1>
    <h1 class="w3-xxxlarge w3-text-gray"><b>Appointment View</b></h1>
    <hr style="width:50px;border:5px solid gray" class="w3-round">
  </div>
  
  <!-- Photo grid (modal) -->
  <div class="w3-row-padding">
  <table align='center' width='600'  cellpadding='5px' cellspacing='5px' border='#000 solid 3px' style='border:#ddd solid 5px;' id='tabe'>
 <tr>
  <th>Id</th> 
  <th>Doctor Name</th>
  <th>Time</th> 
  <th>Description</th>
 </tr>
 <?php
$conn = mysqli_connect("localhost", "root", "", "hospital");
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $id = $_SESSION['id'];
  $sql = "SELECT appointments.id,patient.name,appointments.time,appointments.descriptions FROM appointments Inner JOIN patient ON appointments.patient_id = patient.id  where appointments.doctor_id= $id";
  
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>". $row["name"]. "</td><td>" . $row["time"]. "</td><td>" . $row["descriptions"] . 
"</td></tr>";
 }
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
  </div>

  <!-- Modal for full size images on click-->
  <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xxlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>

  
  
  
  
  <!-- Contact -->
  <div class="w3-container" id="contact" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-gray"><b>Contact.</b></h1>
    <hr style="width:50px;border:5px solid gray" class="w3-round">
    
    <div class="w3-container w3-padding-large w3-grey">
   
    <div class="w3-row-padding w3-center w3-padding-24" style="margin:0 -16px">
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-envelope w3-xxlarge w3-text-light-grey"></i></p>
        <p><?php echo $_SESSION['email'];?></p>
      </div>
      <div class="w3-third w3-teal">
        <p><i class="fa fa-map-marker w3-xxlarge w3-text-light-grey"></i></p>
        <p><?php echo $_SESSION['address'];?></p>
      </div>
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-phone w3-xxlarge w3-text-light-grey"></i></p>
        <p><?php echo $_SESSION['contact'];?></p>
      </div>
    </div>
    <hr class="w3-opacity">
   
  </div>
      </div>
      
  </div>

<!-- End page content -->
</div>

<!-- W3.CSS Container -->
<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></p></div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>

</body>
</html>
