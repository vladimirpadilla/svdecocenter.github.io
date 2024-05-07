<?php 
    require('admin/inc/db_config.php');
    require('admin/inc/essentials.php');

    date_default_timezone_set("Asia/Manila");

    session_start();

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
      redirect('index.php');
    }

    if(isset($_POST['pay_now']))
    {
      $CUST_ID = $_SESSION['uId'];

      $frm_data = filteration($_POST);
  
      $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`,`check_in`,`check_out`) VALUES (?,?,?,?)";

      insert($query1,[$CUST_ID,$_SESSION['room']['id'],$frm_data['checkin'],
        $frm_data['checkout']],'issss');

      $booking_id = mysqli_insert_id($con);
    }
?>