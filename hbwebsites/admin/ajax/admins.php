<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['add_admin']))
    {
        $frm_data = filteration($_POST);
        $flag = 0; 

        $q1 = "INSERT INTO `system_cred` (`system_name`,`phonenum`,`system_pass`) VALUES (?,?,?)";
        $values = [$frm_data['system_name'],$frm_data['phonenum'],$frm_data['system_pass']];

        if(insert($q1,$values,'sis')){
            $flag = 1;
        }
    }

    if(isset($_POST['get_all_admin']))
    {
        $res = select("SELECT * FROM `system_cred` WHERE `removed`=?",[0],'i');
        $i=1;

        $data = "";

        while($row = mysqli_fetch_assoc($res))
        {
            $data.="
                <tr class='align-middle'>
                    <td>$row[system_name]</td>
                    <td>$row[phonenum]</td>
                </tr>
            ";
            $i++;
        }

        echo $data;
    }

    if(isset($_POST['get_admin']))
    {
        $frm_data = filteration($_POST);

        $res1 = select("SELECT * FROM `system_cred` WHERE `id`=?",[$frm_data['get_admin']],'i');

        $admindata = mysqli_fetch_assoc($res1);

        $data =["admindata" => $admindata];

        $data = json_encode($data);

        echo $data;
    }

    if(isset($_POST['toggle_status']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `admin` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'],$frm_data['toggle_status']];

        if(update($q,$v,'ii')){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if(isset($_POST['removed_admin']))
    {
        $frm_data = filteration($_POST);

        $res1 = delete("DELETE FROM `system_cred` WHERE `system_name`=?",[$frm_data['system_name'],0],'i');

        if($res1){
            echo 1;
        }
        else{
            echo 0;
        }
    }
    
?>