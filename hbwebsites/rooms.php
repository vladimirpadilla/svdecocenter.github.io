<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - OUR ROOM DETAILS</title>
</head>
<body class="bg-light"> 

  <?php require('header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR ROOMS DETAILS</h2>
    <div class="h-line bg-dark"></div>
  </div> 

  <div class="container-fluid">
    <div class="row">
  
      <div class="col-lg-10 col-md-10 px-4"> 

        <?php 
          $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?",[1,0],'ii');

          while($room_data = mysqli_fetch_assoc($room_res))
          {
            // get features of room

            $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f
              INNER JOIN `room_features` rfea ON f.id = rfea.features_id
              WHERE rfea.room_id = '$room_data[id]'");

              $features_data = "";
              while($fea_row = mysqli_fetch_assoc($fea_q)){
                $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                  $fea_row[name]
              </span>";
              }

            // get features of room

            $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f
              INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
              WHERE rfac.room_id = '$room_data[id]'");

              $facilities_data = "";
              while($fac_row = mysqli_fetch_assoc($fac_q)){
                $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                  $fac_row[name]
              </span>";
            }

            // get thumbnail of image

            $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
            $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
              WHERE `room_id`='$room_data[id]' 
              AND `thumb`='1'");

            if(mysqli_num_rows($thumb_q)>0){
              $thumb_res = mysqli_fetch_assoc($thumb_q);
              $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
            }

            $book_btn = "";

            if(!$settings_r['shutdown']){
              $login=0;
              if(isset($_SESSION['login']) && $_SESSION['login']==true){
                $login=1;
              }
            }

            // print room card

            echo <<<data
              <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                      <img src="$room_thumb" class="img-fluid rounded">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                    <h5 class="mb-3">Room Type</h5>
                      <h6 class="mb-3">$room_data[name]</h4>
                      <div class="facilities mb-3">
                        <h5 class="mb-1">Components of room</h5>
                          <br>1 Twin Bed</br>
                          <br>1 Double Bed</br>
                          <br>1 Private Toilet & Bath</br>
                    </div>
                      <div  class="quantity">
                        <h5 class="mb-1">Number of Pax.</h5>
                        $room_data[quantity]
                      </div>
                    </div>
                    <div class="col-md-1 text-center">
                      <h4 class="mb-10">₱$room_data[price] per night</h4>
                      $book_btn
                    </div>
                </div>
              </div>

            data;

          }
        ?>
				
			
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