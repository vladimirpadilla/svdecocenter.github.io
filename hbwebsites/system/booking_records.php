<?php 
    // Error handling for require statements
    require_once('./inc/essentials.php');
    require_once('./inc/db_config.php');
    
    // Assuming adminLogin() is defined in essentials.php
    systemLogin();
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

                      <div class="table-responsive-lg">
                        <table class="table table-hover border" style="min-width: 1200px;">
                          <thead>
                            <tr class="bg-dark text-light">
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Checkin</th>
                              <th scope="col">Time-in</th>
                              <th scope="col">Checkout</th>
                              <th scope="col">Time-out</th>
                              <th scope="col">Status</th>
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

    <!-- Correct path for including JavaScript -->
    <script src="scripts/booking_records.js"></script>
</body>
</html>
