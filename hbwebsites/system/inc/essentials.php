<?php 

    //frotend purpose data

    define('SITE_URL','http://127.0.0.1/hbwebsites/');
    define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
    define('CAROUSEL_IMG_PATH',SITE_URL.'images/carousel/');
    define('FEATURES_IMG_PATH',SITE_URL.'images/features/');
    define('ROOMS_IMG_PATH',SITE_URL.'images/rooms/');
    define('USERS_IMG_PATH',SITE_URL.'images/users/');
    
    // sendgrid api key
    define('SENDGRID_API_KEY',"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");
    define('SENDGRID_EMAIL',"garducejhon@gmail.com");
    define('SENDGRID_NAME',"ECO CENTER");


    //backend upload process

    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/hbwebsites/images/');
    define('ABOUT_FOLDER','about/');
    define('CAROUSEL_FOLDER','carousel/');
    define('FEATURES_FOLDER','features/');
    define('ROOMS_FOLDER','rooms/');
    define('USERS_FOLDER','users/');


    function systemLogin()
    {
        session_start();
        if(!(isset($_SESSION['systemLogin']) && $_SESSION['systemLogin']==true)){
            echo"<script>
                window.location.href='index.php';
            </script>";
            exit;
        }
    }

    function redirect($url){
        echo"<script>
            window.location.href='$url';
        </script>";
        exit;
    }

    function alert($type,$msg){

        $bs_class = ($type == "success") ? "alert-success" : "alert-danger";

        echo <<<alert
            <div class="alert alert-warning $bs_class alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">$msg</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        alert;
    }

    function uploadImage($image,$folder)
    {
        $valid_mime = ['image/jpeg','image/png','image/webp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img'; //invalid image mime or format    
        }
        else if(($image['size']/(1024*1024))>2){
            return 'inv_size'; //invalid size greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }

    function uploadSVGImage($image,$folder)
    {
        $valid_mime = ['image/svg+xml'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img'; //invalid image mime or format    
        }
        else if(($image['size']/(1024*1024))>1){
            return 'inv_size'; //invalid size greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }

    function deleteImage($image,$folder)
    {
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        }
        else{
            return false;
        }
    }

    function uploadUserImage($image)
    {
        $valid_mime = ['image/jpeg','image/png','image/webp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img'; //invalid image mime or format    
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".jpeg";

            $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

            if($ext == 'png' || $ext == 'PNG') {
                $img = imagecreatefrompng($image['tmp_name']);
            }
            else if($ext == 'webp' || $ext == 'WEBP') {
                $img = imagecreatefromwebp($image['tmp_name']);
            }
            else{
                $img = imagecreatefromjpeg($image['tmp_name']);
            }

            if(imagejpeg($img,$img_path,75)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }

?>