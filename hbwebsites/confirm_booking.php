<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - CONFIRM BOOKING</title>
</head>
<body class="bg-light"> 

  <?php require('header.php'); ?>

  <?php 
    /*
      Check room id from url is present or not
      Shutdown mode is active or not
      User is logged in or not
    */

    if(!isset($_GET['id']) || $settings_r['shutdown']==true){
      redirect('rooms.php');
    }
    else if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
      redirect('rooms.php');
    }

    // filter and get room and user data
  
    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0){
      redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    $_SESSION['room'] = [
      "id" => $room_data['id'],
      "name" => $room_data['name'],
      "price" => $room_data['price'],
      "payment" =>  null,
      "available" => false,
    ];

    $user_res = select("SELECT * FROM `user_cred` WHERE `id` =? LIMIT 1", [$_SESSION['uId']],"i");
    $user_data = mysqli_fetch_assoc($user_res);
  ?>


  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold">CONFIRM BOOKING</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>
        </div>
      </div> 


      <div class="col-lg-7 col-md-12 px-2">
        
        <?php 
          $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
          $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
            WHERE `room_id`='$room_data[id]' 
            AND `thumb`='1'");

          if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
          }

          echo<<<data
            <div class="card p-3 shadow-sm rounded">
              <img src="$room_thumb" class="img-fluid rounded mb-3">
              <h5>$room_data[name]</h5>
              <h6>₱$room_data[price] per night</h6>
            </div>
          data;
        ?>

      </div>
           
      <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
          <div class="card-body">
            <button type="button"  class="btn btn-primary w-100 text-white custom-bg shadow-none mb-1" data-bs-toggle="modal"  data-bs-target="#bookModal">
              Book Now
            </button>
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
                <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Room Name*</label>
                    <input name="room_name" type="text" class="form-control shadow-none" placeholder="Enter your room name" required>
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
                  <label class="form-label">TIME-IN</label>
                  <input type="time" class="form-control shadow-none" id="in" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">TIME-OUT</label>
                  <input type="time" class="form-control shadow-none" id="out" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Checkout</label>
                  <input type="date" class="form-control shadow-none" id="checkout"  required>
                </div>
                </div>
              </div>
            </div>
            <div class="text-center my-1">
              <button type="submit" class="btn btn-dark shadow-none">BOOK NOW</button>
            </div>
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


  <?php require('footer.php'); ?>
  
</body>
</html>