<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <?php require('links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - HOME</title>
    <style>         
        .availabilty-form{
          margin-top: -50px;
          z-index: 2;
          position: relative;
        }

        @media screen and (max-width: 575px){
          .availability-form{
            margin-top: 25px;
            padding: 0 35px;  
          }
        }
    </style>
    <style>
  .card {
    transition: transform 0.3s ease;
  }

  .card:hover {
    transform: scale(1.05);
  }
</style>
</head>
<body class="bg-light"> 

  <?php require('header.php'); ?>

  <!-- Carousel -->

  <div class="container-fluid">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <?php 
          $res = selectAll('carousel');
          while($row = mysqli_fetch_assoc($res))
          {
              $path = CAROUSEL_IMG_PATH;
              echo  <<<data
                <div class="swiper-slide">
                  <img src="$path$row[image]" class="w-100 d-block">
                </div>
              data;
          }
        ?>
      </div>
    </div>
  </div>


           <!-- Rooms -->

          <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">ROOMS</h2>

            <div class="container">
              <div class="row">
               
                <?php

                    $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

                    while($room_data = mysqli_fetch_assoc($room_res))
                    {
                      // thumbnail

                      $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                      $thumb_q = mysqli_query($con,"SELECT * FROM `room_images`
                        WHERE `room_id` = '$room_data[id]'
                        AND `thumb` = '1'");

                      if(mysqli_num_rows($thumb_q)>0){
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                      }

                      //print room
                      
                      echo <<<data
                        <div class="col-lg-4 col-md-6 my-3">
                          <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                          <img src="$room_thumb" class="img-fluid rounded">
                            <div class="card-body">
                              <h5>$room_data[name]</h5>
                              <h6 class="mb-4">₱$room_data[price]</h6>
                              <div class="features mb-4">
                                <h6 class="mb-1">Components of room</h6>
                                <br>1 Twin Bed</br>
                                <br>1 Double Bed</br>
                                <br>1 Private Toilet & Bath</br>
                              </div>
                            </div>
                          </div>
                        </div>

                      data;
                    }
                  ?>
              </div>
            </div>


        
          <!-- EVENTS -->

          <h2 class="mt-5 pt-4 text-center fw-bold h-font">EVENTS PLACE</h2>

          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                  <img src="images/events/retreat.jpeg" class="card-img-top">
                </div>
              </div>
              <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                  <img src="images/events/svd2.jpg" class="card-img-top">
                </div>
              </div>
              <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                  <p class="text-center mt-3">
                  The Events Place Session feature enhances the versatility of your hotel booking and reservation system by providing a dedicated space for managing event venues within your property. It enables users to explore, book, and manage event spaces for various occasions, such as conferences, weddings, seminars, and corporate events.
                  </p>
                </div>
              </div>
            </div>
          </div>

            <!-- CONTACTS -->

            <h2 class="mt-5 pt-4 text-center fw-bold h-font">CONTACTS</h2>



          <div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 mb-5 px-4">

            <div class="bg-white rounded shadow p-4">
                <iframe class="w-100 rounded MB-4" height="320px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                
                <h5>Address</h5>
                <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                  <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address'] ?>
                </a>

                <h5 class="mt-4">Call us</h5>
                <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                    <i class="bi bi-telephone-inbound-fill"></i> +<?php echo $contact_r['pn1'] ?>
                </a>
                <br>
                <?php 
                  if($contact_r['pn2']!=''){
										echo<<<data
											<a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
												<i class="bi bi-telephone-inbound-fill"></i> +$contact_r[pn2]
											</a>
										data;
									}
                ?>

                <h5 class="mt-4">Email</h5>
                <a href="mailto: <?php echo $contact_r['email'] ?>" class="d-inline-block text-decoration-none text-dark">
                  <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email'] ?>
                </a>

                <h5 class="mt-4">Follow us</h5>
								<?php 
									if($contact_r['tw']!=''){
										echo<<<data
												<a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 me-2">
													<i class="bi bi-twitter me-1"></i>
												</a>
										data;
									}
								?>

                <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark fs-5 me-2">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark fs-5">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 ">
                <form method="POST">
                    <h5>Send a message</h5>
                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Name</label>
                        <input name="name" required type="text" class="form-control shadow-none">
                    </div>
                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Email</label>
                        <input name="email" required type="email" class="form-control shadow-none">
                    </div>
                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Subject</label>
                        <input name="subject" required type="text" class="form-control shadow-none">
                    </div>
                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Message</label>
                        <textarea name="message" required class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                    </div>
                    <button type="submit" name="send" class="btn btn-dark text-white custom-bg mt-3">SEND</button>
                </forM>
            </div>
        </div>
    </div>
  </div>

  <?php 
    
    if(isset($_POST['send']))
    {
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

        $res = insert($q,$values,'ssss');
        if($res==1){
            alert('success','Mail sent!');
        }
        else{
            alert('error', 'Server Down! Try again later.');
        }
    }
  ?>






  <!-- Password Reset -->

  <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="recovery-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-shield-lock fs-3 me-2"></i> Set New Password
            </h5>
          </div>
          <div class="modal-body">
          <div class="mb-4">
              <label class="form-label">New Password</label>
              <input type="password" name="pass" required class="form-control shadow-none">
              <input type="hidden" name="email">
              <input type="hidden" name="token">
            </div>
            <div class="mb-2 text-end">
              <button type="button" class="btn shadow-none p-0 me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-dark shadow-none">SEND LINK</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <?php require('footer.php'); ?>

  <?php 

    if(isset($_GET['account_recovery']))
    {
      $data = filteration($_GET);

      $t_date = date("Y-m-d");

      $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
        [$data['email'],$data['token'],$t_date],'sss');

      if(mysqli_num_rows($query)==1)
      {
        echo<<<showModal
          <script>
            var myModal = document.getElementById('recoveryModal');

            myModal.querySelector("input[name='email']").value = '$data[email]';
            myModal.querySelector("input[name='token']").value = '$data[token]';

            var modal = bootstrap.Modal.getOrCreateInstance(myModal);
            modal.show();
          </script>
        showModal;
      }
      else{
        alert("error","Invalid or Expired Link !");
      }
    }
  ?>
  
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper-container", {
          spaceBetween: 30,
          effect: "fade",
          loop: true,
          autoplay:{
            delay: 3500,
            disableInteraction: false,
          }
        });

        var swiper = new Swiper(".swiper-testimonials", {
          effect: "coverflow",
          grabCursor: true,
          centeredSlides: true,
          slidesPerView: "auto",
          slidesPerView: "3",
          loop: true,
          coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
          },
          pagination: {
            el: ".swiper-pagination",
          },
          breakpoints:{
            320:{
              slidesPerView: 1,
            },
            640:{
              slidesPerView: 1,
            },
            768:{
              slidesPerView: 2,
            },
            1024:{
              slidesPerView: 3,
            },
          }
        });


        // recovery

        let recovery_form = document.getElementById('recovery-form');

        recovery_form.addEventListener('submit', (e)=>{
          e.preventDefault();
          
          let data = new FormData();

          data.append('email',recovery_form.elements['email'].value);
          data.append('token',recovery_form.elements['token'].value);
          data.append('pass',recovery_form.elements['pass'].value);
          data.append('recover_user','');

          var myModal = document.getElementById('recoveryModal');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

          let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/login_register.php",true);

          xhr.onload = function(){
            if(this.reponseText == 'failed'){
              alert('error',"Account reset failed!");
            }
            else{
              alert('success',"Account reset successful!");
              recovery_form.reset();
            }
          }

          xhr.send(data);
        });
    </script>

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


  </body>
</html>