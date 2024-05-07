<?php 

    require('../admin/inc/db_config.php');
    require('../admin/inc/essentials.php');
    require("../sendgrid/sendgrid-php.php");

    date_default_timezone_set("Asia/Manila");

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
            '
                Hello! We kindly request your payment through 
                GCash using the number 09********* (jhon billy Garduce). 
                Your support as a GCash member is appreciated. 
                
                Please send your receipt after paying. 
                
                
                Thank you!
            '
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

    if(isset($_POST['book']))
    {
        $data = filteration($_POST);
        

        // match password and confirm password field

        if($data['pass'] != $data['cpass']) {
            echo 'pass_mismatch';
            exit;
        }

        // check user exist or not

        $u_exist = select("SELECT * FROM `booking_order` WHERE `email` = ?",
            [$data['email']],"s");

        // send confirmation link to user's email

        $token = bin2hex(random_bytes(16));

        if(!send_mail($data['email'],$token,"email_confirmation")){
            echo 'mail_failed';
            exit;
        }

        $query = "INSERT INTO `booking_order`(`name`,`room_name`,`email`, `phonenum`,`checkin`,`in`,`checkout`,`out`) VALUES (?,?,?,?,?,?,?,?)";

        $values = [$data['name'],$data['room_name'],$data['email'],$data['phonenum'],$data['checkin'],$data['in'],$data['checkout'],$data['out']];

        if(insert($query,$values,'ssssssss')){
            echo 1;
        }
        else{
            echo 'ins_failed';
        }

    }

?>