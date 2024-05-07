<?php 
    // Error handling for require statements
    require_once('./inc/essentials.php');
    require_once('./inc/db_config.php');
    
    // Assuming adminLogin() is defined in essentials.php
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div  class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">GUEST</h3> 

                 <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                    <!-- <div class="text-end mb-4">
                      <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search...">
                    </div> -->

                      <div class="table-responsive">
                        <table class="table table-hover border text-center" style="min-width: 1300px;">
                          <thead>
                            <tr class="bg-dark text-light">
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone no.</th>
                              <th scope="col">Location</th>
                              <th scope="col">DOB</th>
                              <th scope="col">Verified</th>
                              <th scope="col">Status</th>
                              <th scope="col">Date</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody id="users-data">
                          </tbody>
                        </table>
                      </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Proper path for including scripts -->
    <?php require('inc/scripts.php'); ?>

    <!-- Proper path for including JavaScript -->
    <script src="scripts/users.js"></script>
</body>
</html>
