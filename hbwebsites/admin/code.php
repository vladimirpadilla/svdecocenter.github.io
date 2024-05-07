<?php 

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    if($password === $cpassword)
    {
        $query = "INSERT INTO  register (username,password) VALUES ('$username', '$password')";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            $_SESSION['success'] = "Admin Added";
            header('Location: create_admin.php');
        }
        else
        {
            $_SESSION['status'] = "Admin Not Added";
            header('Location: create_admin.php');
        }
    }
    else
    {
        $_SESSION['status'] = "Password and Confirm Password Does not Match";
        header('Location: create_admin.php');
    }
}

?>