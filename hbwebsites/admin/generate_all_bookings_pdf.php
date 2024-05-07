<?php 

require('inc/essentials.php');
require('inc/db_config.php');
require('inc/mpdf/vendor/autoload.php');
adminLogin();

$query = "SELECT * FROM `booking_order` WHERE `booking_status`='booking' OR `booking_status`='cancelled'";

$res = mysqli_query($con, $query);

$html = '
<style>
* {
    font-family: Arial, Helvetica, sans-serif;
}
</style>
<h1 style="margin-left:195px;">ALL BOOKINGS </h1>';

foreach ($res as $data) {
    $html .= '
<table style="text-align:center; border-collapse: collapse; border: 1.5px solid black; margin-left:100px; margin-top: 15px;"> 
<tr style="   font-size:12pt; text-align:center; ">
    <td style=" font-weight:bold; text-align: left; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:100px;"> Name:</td>
    <td style=" text-align: left; border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:150px;">' . $data['name'] . '</td>
    <td style=" font-weight:bold; text-align: left; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:100px;"> Room Type:</td>
    <td style=" text-align: left; border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:150px;">' . $data['room_name'] . '</td>
</tr>
<tr style="   font-size:12pt; text-align:center; ">
    <td style=" font-weight:bold; text-align: left; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; "> Check-in:</td>
    <td style=" text-align: left; border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:150px;">' . $data['checkin'] . '</td>
    <td style="font-weight:bold; text-align: left; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:70px;"> Time-in:</td>
    <td style=" text-align: left; border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:150px;">' . $data['in'] . '</td>
</tr>
<tr style="   font-size:12pt; text-align:center; ">
    <td style=" font-weight:bold; text-align: left; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; "> Check-out: </td>
    <td style=" text-align: left; border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:150px;">' . $data['checkout'] . '</td>
    <td style="  font-weight:bold; text-align: left; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:70px;"> Time-out:</td>
    <td style=" text-align: left; border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:150px;">' . $data['out'] . '</td>
</tr>
<tr style="   font-size:12pt; text-align:center; ">
    <td colspan="1"  style=" font-weight:bold; text-align: left; border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; "> Status: </td>
    <td colspan="3" style=" text-align: left; border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black; Height:20px; width:150px;">' . $data['booking_status'] . '</td>
</tr>
</table>';
}

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);

$mpdf->Output();
?>
