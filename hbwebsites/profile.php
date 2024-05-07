<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - PROFILE</title>
</head>
<body class="bg-light"> 

  <?php
   require('header.php'); 

   if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');
   }


    $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],'s');

    if(mysqli_num_rows($u_exist)==0){
      redirect('index.php');
    }

    $u_fetch = mysqli_fetch_assoc($u_exist);
   
   ?>

  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold">PROFILE</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">PROFILE</a>
        </div>
      </div> 

      <div class="col-12 mb-5 px-4">
        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
          <form id="info-form"> 
            <h5 class="mb-3 fw-bold">Basic Information</h5>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Phone Number</label>
                <input name="phonenum" type="number" value="<?php echo $u_fetch['phonenum'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Date of birth</label>
                <input name="dob" type="date" value="<?php echo $u_fetch['dob'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Zipcode</label>
                <input name="pincode" type="number" value="<?php echo $u_fetch['pincode'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-8 mb-4">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none" row="1" required><?php echo $u_fetch['address'] ?></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-dark text-white custom-bg shadow-none">Save Changes</button>
          </form>
        </div>
      </div> 


    </div>	
  </div>


  <?php require('footer.php'); ?>

  <script>
    let info_form = document.getElementById('info-form');

    info_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('info_form','');
      data.append('name',info_form.elements['name'].value);
      data.append('phonenum',info_form.elements['phonenum'].value);
      data.append('address',info_form.elements['address'].value);
      data.append('pincode',info_form.elements['pincode'].value);
      data.append('dob',info_form.elements['dob'].value);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function(){
        if(this.responseText=='phone_already'){
          alert('error',"Phone number is already registered!");
        }
        else if(this.responseText == 0){
          alert('error',"No Changes Made!");
        }
        else{
          alert('success','Changes saved!');
        }
      }

      xhr.send(data);
    })
  </script>

</body>
</html>