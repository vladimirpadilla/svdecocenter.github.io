<?php 
    require('inc/essentials.php');
    require('inc/db_config.php');
    systemLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); 

        $current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
            COUNT(CASE WHEN booking_status='booking' THEN 1 END) AS `bookings`
            FROM `booking_order`"));

        $total_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT
        COUNT(booking_id) AS `total`
        FROM `booking_order`"));

        $active_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(CASE WHEN booking_status='booking' THEN 1 END) AS `active_bookings`
        FROM `booking_order`"));

        $cancelled_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(CASE WHEN booking_status='cancelled' THEN 1 END) AS `cancelled_bookings`
        FROM `booking_order`"));

        $unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS  `count`
        FROM  `user_queries` WHERE  `seen`=0"));

        $current_users = mysqli_fetch_assoc(mysqli_query($con,"SELECT  
        COUNT(id) AS  `total`,
        COUNT(CASE WHEN  `status`=1 THEN 1 END) AS  `active`,
        COUNT(CASE WHEN  `status`=0 THEN 1 END) AS  `inactive`,
        COUNT(CASE WHEN  `is_verified`=0 THEN 1 END) AS  `unverified`
        FROM `user_cred`"));
    
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div  class="col-lg-10 ms-auto p-4 overflow-hidden">
                
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3>DASHBOARD</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 mb-4">
                    <a href="new_bookings.php" class="text-decoration-none">
                        <div class="card text-center text-success p-3">
                            <h6>New Bookings</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_bookings['bookings'] ?></h1>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="user_queries.php" class="text-decoration-none">
                        <div class="card text-center text-info p-3">
                            <h6>User Queries</h6>
                            <h1 class="mt-2 mb-0"><?php echo $unread_queries['count'] ?></h1>
                        </div>
                    </a>
                </div>
                <!-- <div class="col-md-3 mb-4">
                    <a href="" class="text-decoration-none">
                        <div class="card text-center text-info p-3">
                            <h6>Ratings & Review</h6>
                            <h1 class="mt-2 mb-0">0</h1>
                        </div>
                    </a>
                </div>
            </div> -->

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Booking Analytics</h5>
                <!-- <select class="form-select shadow-none bg-light w-auto">
                    <option value="1">Past 30 Days</option>
                    <option value="2">Past 90 Days</option>
                    <option value="3">Past 1 Year</option>
                    <option value="4">All time</option>
                </select> -->
            </div>

            <div class="row mb-3">
                <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary p-3">
                            <h6>Total Bookings</h6>
                            <h1 class="mt-2 mb-0"><?php echo $total_bookings['total']?></h1>
                        </div>
                </div>
                <div class="col-md-3 mb-4">
                        <div class="card text-center text-success p-3">
                            <h6>Active Bookings</h6>
                            <h1 class="mt-2 mb-0"><?php echo $active_bookings['active_bookings']?></h1>
                        </div>
                </div>
                <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary p-3">
                            <h6>Cancelled Bookings</h6>
                            <h1 class="mt-2 mb-0"><?php echo $cancelled_bookings['cancelled_bookings']?></h1>
                        </div>
                </div>
            </div>

            <!-- <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Usser, Queries, Reviews Analytics</h5>
                <select class="form-select shadow-none bg-light w-auto">
                    <option value="1">Past 30 Days</option>
                    <option value="2">Past 90 Days</option>
                    <option value="3">Past 1 Year</option>
                    <option value="4">All time</option>
                </select>
            </div> -->

            <!-- <div class="row mb-3">
                <div class="col-md-3 mb-4">
                        <div class="card text-center text-success p-3">
                            <h6>New Registration</h6>
                            <h1 class="mt-2 mb-0">0</h1>
                        </div>
                </div>
                <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary p-3">
                            <h6>Queries</h6>
                            <h1 class="mt-2 mb-0">0</h1>
                        </div>
                </div>
                <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary p-3">
                            <h6>Reviews</h6>
                            <h1 class="mt-2 mb-0">0</h1>
                        </div>
                </div>
            </div> -->

            <h5>Users</h5>
            <div class="row mb-3">
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-info p-3">
                        <h6>Total</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['total'] ?></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-success p-3">
                        <h6>Active</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['active'] ?></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-warning p-3">
                        <h6>Inactive</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['inactive'] ?></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-danger p-3">
                        <h6>Unverified</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['unverified'] ?></h1>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
</body>
</html>