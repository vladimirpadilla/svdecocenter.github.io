<?php 

require('inc/essentials.php');
require('inc/db_config.php');
require('inc/mpdf/vendor/autoload.php');
adminLogin();

$frm_data = filteration($_GET);

if (isset($_GET['type'])) {
    $reportType = $_GET['type'];

    // Depending on the report type, adjust the query accordingly
    if ($reportType === 'booking') {
        $query = "SELECT * FROM `booking_order` WHERE `booking_status` = 'booking'";
        $reportTitle = 'Booking';
    } elseif ($reportType === 'cancelled') {
        $query = "SELECT * FROM `booking_order` WHERE `booking_status` = 'cancelled'";
        $reportTitle = 'Cancelled';
    }

    $res = mysqli_query($con, $query);

    // Styling for the report
    $html = '
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .report-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>';

    $html .= '<div class="report-container">';
    $html .= '<h1>' . ucfirst($reportTitle) . ' Report</h1>';

    $html .= '<table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Room Type</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';

    while ($data = mysqli_fetch_assoc($res)) {
        $html .= '<tr>
                    <td>' . $data['booking_id'] . '</td>
                    <td>' . $data['name'] . '</td>
                    <td>' . $data['room_name'] . '</td>
                    <td>' . $data['checkin'] . '</td>
                    <td>' . $data['checkout'] . '</td>
                    <td>' . $data['booking_status'] . '</td>
                </tr>';
    }

    $html .= '</tbody>
            </table>';

    $html .= '<div class="footer"><p>Thank you for using our service!</p></div>';
    $html .= '</div>'; // Close report-container div

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output();
}

if (isset($frm_data['id'])) {
    // If booking ID is provided, fetch details for a single booking
    $query = "SELECT * FROM `booking_order` WHERE `booking_id` = '$frm_data[id]'";
    $res = mysqli_query($con, $query);

    $html = '
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #000;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details table th,
        .details table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .footer {
            text-align: center;
        }
        .logo img {
            width: 100px; /* Adjust the size as needed */
            height: auto;
        }
    </style>';

    $html .= '<div class="container">';
    $html .= '<div class="logo"><img src="http://localhost/hbwebsites/assets/logo2.jpg" alt="Logo" style="width: 100px; height: auto;"></div>';


    $html .= '<div class="header"><h1>Booking Receipt</h1></div>';

    foreach ($res as $data) {
        $html .= '<div class="details">';
        $html .= '<table>
                    <tr>
                        <th>Booking ID:</th>
                        <td>' . $data['booking_id'] . '</td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td>' . $data['name'] . '</td>
                    </tr>
                    <tr>
                        <th>Room Type:</th>
                        <td>' . $data['room_name'] . '</td>
                    </tr>
                    <tr>
                        <th>Check-in:</th>
                        <td>' . $data['checkin'] . '</td>
                    </tr>
                    <tr>
                        <th>Check-out:</th>
                        <td>' . $data['checkout'] . '</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>' . $data['booking_status'] . '</td>
                    </tr>
                  </table>';
        $html .= '</div>';
    }

    $html .= '<div class="footer"><p>Thank you for choosing our service!</p></div>';
    $html .= '</div>';

    $mpdf = new \Mpdf\Mpdf();

    $mpdf->WriteHTML($html);

    $mpdf->Output();
} else {
    // If booking ID is not provided, generate a summary report
    $query = "SELECT * FROM `booking_order` WHERE `booking_status`='booking' OR `booking_status`='cancelled'";
    $res = mysqli_query($con, $query);

    $html = '
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .logo img {
            width: 100px; /* Adjust the size as needed */
            height: auto;
        }
    </style>';

    $html .= '<div class="logo"><img src="http://localhost/hbwebsites/assets/logo2.jpg" alt="Logo" style="width: 100px; height: auto;"></div>';


    $html .= '<h1>All Bookings Summary</h1>';

    $html .= '<table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Room Type</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($res as $data) {
        $html .= '<tr>
                    <td>' . $data['booking_id'] . '</td>
                    <td>' . $data['name'] . '</td>
                    <td>' . $data['room_name'] . '</td>
                    <td>' . $data['checkin'] . '</td>
                    <td>' . $data['checkout'] . '</td>
                    <td>' . $data['booking_status'] . '</td>
                </tr>';
    }

    $html .= '</tbody>
            </table>';

    $mpdf = new \Mpdf\Mpdf();

    $mpdf->WriteHTML($html);

    $mpdf->Output();
}
?>
