<?php 

    require('inc/essentials.php');
    require('inc/db_config.php');
    require('inc/mpdf/vendor/autoload.php');
    adminLogin();

    if(isset($_GET['gen_pdf']) && isset($_GET['id']))
    {
        $frm_data = filteration($_GET);

        $query = "SELECT * FROM `booking_order` WHERE `booking_status`='booking' OR `booking_status`='cancelled' 
        AND `booking_id` = '$frm_data[id]'";

        $res = mysqli_query($con,$query);
        $total_rows = mysqli_num_rows($res);

        if($total_rows==0){
            header('location: dashboard.php');
            exit;
        }

        $data = mysqli_fetch_assoc($res);

        $booking_data = "
        <h2>BOOKING RECEIPT</h2>
        <table border='1'>
        <tr>
        <td>Name: $data[name]</td>
        </tr>
        <tr>
            <td>Checkin: $data[checkin]</td>
            <td>Time-in $data[in]</td>
        </tr>
        <tr>
            <td>Checkout: $data[checkout]</td>
            <td>Time-out: $data[out]</td>
        </tr>
        <tr>
        <td colspan='2'>Status: $data[booking_status]</td>
        </tr>
    </tr>
    </table>

        ";
        
        echo $booking_data;

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->WriteHTML($booking_data);

        $mpdf->Output($data['order_id'],'D');

    }

    else{
        header('location: dashboard.php');
    }
?>