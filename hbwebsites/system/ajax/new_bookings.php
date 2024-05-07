<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    systemLogin();

    if(isset($_POST['get_bookings']))
    {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `booking_order` WHERE `booking_status`='pending'";

        $res = mysqli_query($con,$query);
        $i=1;
        $booking_data = "";

        if(mysqli_num_rows($res)==0){
            echo"<b>No Data Found!</b>";
            exit;
        }

        while($data = mysqli_fetch_assoc($res))
        {
            $date = date("d-m-Y",strtotime($data['datentime']));

            $booking_data .="
            <tr>
                <td>$i</td>
                <td>
                    $data[name]
                    <td>$data[room_name]</td>
                    <td>$data[checkin]</td>
                    <td>$data[in]</td>
                    <td>$data[checkout]</td>
                    <td>$data[out]</td>
                <td>
                    <button type='button' onclick='confirm_booking($data[booking_id])' class='mt-2 btn btn-outline-success btn-sm fw-bold shadow-none'>
                        <i class='bi bi-trash'></i> Approve Booking
                    </button>
                <br>
                    <button type='button' onclick='cancel_booking($data[booking_id])' class='mt-2 btn btn-outline-danger btn-sm fw-bold shadow-none'>
                        <i class='bi bi-trash'></i> Cancel Booking
                    </button>
                </td>
            </tr>
        ";
            $i++;
        }
        echo $booking_data;
    }

    if(isset($_POST['confirm_booking']))
    {
        $frm_data = filteration($_POST);

        $query = "UPDATE `booking_order` SET `booking_status`=? WHERE `booking_id`=?";
        $values = ['booking',$frm_data['booking_id']];
        $res = update($query,$values,'si');

        echo $res;
    }


    if(isset($_POST['cancel_booking']))
    {
        $frm_data = filteration($_POST);

        $query = "UPDATE `booking_order` SET `booking_status`=?, `refund`=? WHERE `booking_id`=?";
        $values = ['cancelled',0,$frm_data['booking_id']];
        $res = update($query,$values,'sii');

        echo $res;
    }

   
    
?>