<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - BOOKINGS</title>
</head>
<body class="bg-light"> 

  <?php
   require('header.php'); 
   if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');
  }
   
   ?>

  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold">BOOKINGS</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">BOOKINGS</a>
        </div>
      </div> 

      <?php 

        $query = "SELECT * FROM `booking_order` WHERE `booking_status`='booking' OR `booking_status`='cancelled'";

        $res = mysqli_query($con, $query);

        while($data = mysqli_fetch_assoc($res))
        {
          $status_bg = "";
          $btn = "";

          if($data['booking_status']=='booking')
          {
            $status_bg = "bg-success";
            {
              $btn="<a href='generate_pdf.php&gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>
                <button type='button' class='btn btn-dark btn-sm shadow-none'>Rate & Review</button>
              ";
            }
          }
          else if($data['booking_status']=='cancelled')
          {
            $status_bg = "bg-danger";
          }

          echo<<<bookings
            <div class='col-md-4 px-4 mb-4'>
              <div class='bg-white p-3 rounded shadow-sm'>
                <h5>$data[name]</h5>
                <p>
                  Checkin: </b> $data[checkin] <br>
                  Checkout: </b> $data[checkout] <br>
                </p>
                <p>
                  number: </b> $data[phonenum] <br>
                  place: </b> $data[address] <br>
                </p>
                <p>
                  <span class='badge $status_bg'>$data[booking_status]</span>
              </div>
            </div>
          bookings;
        }
      
      ?>


    </div>	
  </div>


  <?php require('footer.php'); ?>

</body>
</html>