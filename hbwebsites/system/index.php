<?php 
    require('inc/essentials.php');
    require('inc/db_config.php');

    session_start();
    if((isset($_SESSION['systemLogin']) && $_SESSION['systemLogin']==true)){
        echo "<script>Location.href='dashboard.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <style>
        div.login-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>
<body class="bg-light">
<div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <div class="background">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">ADMINISTRATOR</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="system_name" required type="text" class="form-control shadow-none text-center" placeholder="System Name">
                </div>
                <div class="mb-4">
                    <input name="system_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn btn-primary text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
        </div>
    </div>

    <?php 
    
        if(isset($_POST['login']))
        {
            $frm_data = filteration($_POST);
           
            $query = "SELECT * FROM `system_cred` WHERE `system_name`=? AND `system_pass`=?";
            $values = [$frm_data['system_name'],$frm_data['system_pass']];

            $res = select($query,$values,"ss");
            if($res->num_rows==1){
                $row = mysqli_fetch_assoc($res);
                $_SESSION['systemLogin'] = true;
                $_SESSION['systemId'] = $row['sr_no'];
                redirect('dashboard.php');
            }
            else{
                alert('error','Login failed - Invalid Credentials!');
            }
        }

    ?>



<?php require('inc/scripts.php') ?>
</body>
</html>