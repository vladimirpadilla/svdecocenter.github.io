<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['get_bookings']))
    {
        $frm_data = filteration($_POST);

        $limit = 1;
        $page = $frm_data['page'];
        $start = ($page-1) * $limit;

        $query = "SELECT * FROM `booking_order` WHERE `booking_status`='booking' OR `booking_status`='cancelled'";

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
                    <td>
                    $data[room_name]
                    </td>
                    <td>$data[checkin]</td>
                    <td>$data[in]</td>
                    <td>$data[checkout]</td>
                    <td>$data[out]</td>
                <td>
                    <span class='badge $status_bg'>$data[booking_status]</span>
                </td>
                <td>
                    <button type='button' onclick='download($data[booking_id])' class='mt-2 btn btn-outline-success btn-sm fw-bold shadow-none'>
                        <i class='bi bi-file-earmark-arrow-down-fill'></i>
                    </button>
                </td>
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

        $query = "UPDATE `booking_order` SET `booking_status`=?, `refund`=? WHERE `booking_id`=?";
        $values = ['cancelled',0,$frm_data['booking_id']];
        $res = update($query,$values,'sii');

        echo $res;
    }

?>
