<?php 
session_start();

if(isset($_SESSION['uname'])){
    session_destroy();
    echo "<script>Location.href='logon_page.php'</script>";
}
else{
    echo "<script>Location.href='login_page.php'<script>";
}
?>