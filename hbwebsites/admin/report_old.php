<?php

    require('./inc/essentials.php');
    require('./inc/db_config.php');
    adminLogin();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Booking Records</title>
    <!-- Correct path for including CSS -->
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div  class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Booking Records</h3> 

                 <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                    <!-- <div class="text-end mb-4">
                    <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search...">
                    </div> -->

    <div class="text-end mb-4">
    <a href="generate_pdf.php" target="_blank" class='mt-2 btn btn-outline-success btn-sm fw-bold shadow-none'>
        <i class='bi bi-file-earmark-arrow-down-fill'></i> Generate all bookings
    </a>
    <a href="generate_pdf.php?type=booking" target="_blank" class='mt-2 btn btn-outline-primary btn-sm fw-bold shadow-none'>
    <i class='bi bi-file-earmark-arrow-down-fill'></i> Booking Report
</a>
    <a href="generate_pdf.php?type=cancelled" target="_blank" class='mt-2 btn btn-outline-danger btn-sm fw-bold shadow-none'>
        <i class='bi bi-file-earmark-arrow-down-fill'></i> Cancelled Report
    </a>
    </div>

    <!--<button onclick="generateReport('booking')" class='mt-2 btn btn-outline-primary btn-sm fw-bold shadow-none'>
        <i class='bi bi-file-earmark-text'></i> Booking Report
    </button>
    <button onclick="generateReport('cancelled')" class='mt-2 btn btn-outline-danger btn-sm fw-bold shadow-none'>
        <i class='bi bi-file-earmark-text'></i> Canceled Report
    </button>-->
</div>

                      <div class="table-responsive-lg">
                        <table class="table table-hover border" style="min-width: 1200px;">
                          <thead>
                            <tr class="bg-dark text-light">
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Room Type</th>
                              <th scope="col">Checkin</th>
                              <th scope="col">Time-in</th>
                              <th scope="col">Checkout</th>
                              <th scope="col">Time-out</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody id="booking-data">
                          </tbody>
                        </table>
                      </div>

                      

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Correct path for including scripts -->
    <?php require('inc/scripts.php'); ?>

</body>
</html>


<script>
function get_bookings(search='',page=1)
  {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/booking_records.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
      let data = JSON.parse(this.responseText);
      document.getElementById('booking-data').innerHTML = data.booking_data;
      document.getElementById('table-pagination').innerHTML = data.pagination;

    }

    xhr.send('get_bookings&search='+search+'&page='+page);
  }

  function download(id){
    window.location.href = 'generate_pdf.php?gen_pdf&id='+id;
  }
  

  window.onload = function(){
    get_bookings();
  }
</script>











<?php
    if(isset($_POST['get_bookings']))
    {
        $frm_data = filteration($_POST);

        $limit = 1;
        $page = $frm_data['page'];
        $start = ($page-1) * $limit;

        $query = "SELECT * FROM booking_order WHERE booking_status`='booking' OR booking_status`='cancelled'";

        $limit_query = $query ." LIMIT $start,$limit";

        $res = mysqli_query($con,$query);

        $total_rows = mysqli_num_rows($res);

        if($total_rows==0){
            $output = json_encode(["booking_data"=>"<b>No Data Found!</br>", "pagination"=>'']);
            echo $output;
            exit;
        }

        $i=1;
        $booking_data = "";

        while($data = mysqli_fetch_assoc($res))
        {
            $date = date("d-m-Y",strtotime($data['datentime']));

            if($data['booking_status']=='booking'){
                $status_bg = 'bg-success';
            }
            else if($data['booking_status']=='cancelled'){
                $status_bg = 'bg-danger';
            }
            else{
                $status_bg = 'bg-warning text-dark';
            }

            $booking_data .="
            <tr>
                <td>$i</td>
                <td>
                    $data[name]
                    <td>$data[checkin]</td>
                    <td>$data[in]</td>
                    <td>$data[checkout]</td>
                    <td>$data[out]</td>
                <td>
                    <span class='badge $status_bg'>$data[booking_status]</span>
                </td>
                <a href='generate_pdf.php' onclick='download'=[$booking_id]' class='mt-2 btn btn-outline-success btn-sm fw-bold shadow-none'>
                  <i class='bi bi-file-earmark-arrow-down-fill'></i>
                </a>
            </tr>
        ";
        
            $i++;
        }

        $pagination = "";

        if($total_rows>$limit)
        {
            $pagination=$total_rows;
        }

        $output = json_encode(["booking_data"=>$booking_data,"pagination"=>$pagination]);
        
        echo $output;
    }

    if(isset($_POST['cancel_booking']))
    {
        $frm_data = filteration($_POST);

        $query = "UPDATE booking_order SET booking_status`=?, refund`=? WHERE `booking_id`=?";
        $values = ['cancelled',0,$frm_data['booking_id']];
        $res = update($query,$values,'sii');

        echo $res;
    }

?>