<?php 

    require('../admin/inc/db_config.php');
    require('../admin/inc/essentials.php');
    require("../sendgrid/sendgrid-php.php");

    function send_mail($uemail,$token,$type)
    {
        if($type == "email_confirmation"){
            $page = 'email_confirm.php';
            $subject = "Account Verification Link";
            $content = "confirm your email";
        }
        else{
            $page = 'index.php';
            $subject = "Account Reset Link";
            $content = "Reset your account";
        }

        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom(SENDGRID_EMAIL,SENDGRID_NAME);
        $email->setSubject("Confirmation Booking");
        
        $email->addTo($uemail,);

        $email->addContent(
            "text/html",   
            "
                Please downpayment atlest half before i confirm your booking
            "
        );
        
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try{
            $sendgrid->send($email);
            return 1;
        }
        catch (Exception $e){
            return 0;
        }
    }


    if(isset($_POST['Book Now']))
    {
        $data = filteration($_POST);

        $u_exist = select("SELECT * FROM `booking_order` WHERE `email` = ? LIMIT 1",
            [$data['email']],"s");
    }

?>