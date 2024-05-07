<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - ROOM DETAILS</title>
</head>
<body class="bg-light"> 

  <?php require('header.php'); ?>

  <?php 
    if(!isset($_GET['id'])){
      redirect('rooms.php');
    }
  
    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0){
      redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);
  ?>


  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold"><?php echo $room_data['name'] ?></h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
        </div>
      </div> 


      <div class="col-lg-7 col-md-12 px-4">
        <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <?php 
                $room_img = ROOMS_IMG_PATH."thumbnail.jpg";
                $img_q = mysqli_query($con,"SELECT * FROM `room_images` 
                  WHERE `room_id`='$room_data[id]'");

                if(mysqli_num_rows($img_q)>0)
                {
                  $active_class = 'active';

                  while($img_res = mysqli_fetch_assoc($img_q))
                  {
                    echo"
                      <div class='carousel-item $active_class'>
                        <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded'>
                      </div>
                    ";
                    $active_class='';
                  }

                }
                else{
                  echo"<div class='carousel-item active'>
                    <img src='images/rooms/IMG_12892.jpg' class='d-block w-100'>
                  </div>";
                }
            
              ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>

      
      <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
          <div class="card-body">
            <?php 
            
                echo<<<price
                  <h4>₱$room_data[price] per night</h4>
                price;

                $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f
                  INNER JOIN `room_features` rfea ON f.id = rfea.features_id
                  WHERE rfea.room_id = '$room_data[id]'");
      
                $features_data = "";
                while($fea_row = mysqli_fetch_assoc($fea_q)){
                  $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                    $fea_row[name]
                  </span>";
                }
            
                $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f
                  INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                  WHERE rfac.room_id = '$room_data[id]'");

                $facilities_data = "";
                while($fac_row = mysqli_fetch_assoc($fac_q)){
                  $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                    $fac_row[name]
                  </span>";
                }
                echo<<<facilities
                  <div class="mb-3">
                    <h6 class="mb-1">Facilities</h6>
                      wifi
                      television
                      heater
                  </div>
                facilities;

                echo<<<quantity
                  <div  class="guest">
                    <h6 class="mb-1">Guest</h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                      $room_data[quantity]
                    </span>
                  </div>
                quantity;

                echo<<<area
                  <div class="mb-3">
                    <h6 class="mb-1">Area</h6>
                    <span class='badge rounded-pill bg-light text-dark text-wrap me-1'>
                      $room_data[area] sq. ft.
                    </span>
                  </div>
                area;

                if(!$settings_r['shutdown']){
                  $login=0;
                  if(isset($_SESSION['login']) && $_SESSION['login']==true){
                    $login=1;
                  }   
              } 
            ?>
                  <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                      <!-- <button type="button"  class="btn btn-primary w-100 text-white custom-bg shadow-none mb-1" data-bs-toggle="modal"  data-bs-target="#bookModal">
                        Book Now
                      </button> -->
                    </div>
                  </div>
                  <h5>Description</h5>
                  <p>
                    <?php echo $room_data['description'] ?>
                  </p>
              </div>	
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="bookModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="book-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-person-lines-fill fs-3 me-2"></i> Booking Details
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Name</label>
                  <input name="name" type="text" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Email</label>
                  <input name="email" type="email" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input name="phonenum" type="number" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Checkin</label>
                  <input type="date" class="form-control shadow-none" id="checkin" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Checkout</label>
                  <input type="date" class="form-control shadow-none" id="checkout"  required>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                </div>
                </div>
              </div>
            </div>
            <!-- <div class="text-center my-1">
              <button type="submit" class="btn btn-dark shadow-none">BOOK NOW</button>
            </div> -->
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <script>
    var date = new Date();
    var tdate = date.getDate();
    var month = date.getMonth() + 1; //4
    if(tdate < 10){
      tdate = '0' + tdate;
    }
    if(month < 10){
      month = '0' + month;
    }
    var year = date.getUTCFullYear();
    var minDate = year + "-" + month + "-" + tdate; 
    document.getElementById("checkin").setAttribute('min', minDate)
    document.getElementById("checkout").setAttribute('min', minDate)
  </script>
				
			
    </div>	
  </div>


  <?php require('footer.php'); ?>
  
  
  </body>
</html>