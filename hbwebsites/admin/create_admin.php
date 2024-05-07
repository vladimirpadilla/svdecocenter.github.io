 <?php 
    require('./inc/essentials.php');
    require('./inc/db_config.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ADMINS</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div  class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">ADMINS</h3> 

                 <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                    <div class="text-end mb-4">
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"  data-bs-target="#adminModal">
                          <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                      <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                        <table class="table table-hover border text-center">
                          <thead class="sticky-top">
                            <tr class="bg-dark text-light">
                              <th scope="col">Name</th>
                              <!-- <th scope="col">Email</th> -->
                              <th scope="col">Phone No.</th>
                            </tr>
                          </thead>
                          <tbody id="admin-data">
                          </tbody>
                        </table>
                      </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    
          <!-- Add room modal -->

          <div class="modal fade" id="adminModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <form id="admin_form" autocomplete="off">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Administrator</h5>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold">Name</label>
                      <input type="text" name="system_name" class="form-control shadow-none" required placeholder="Enter name">
                   </div>
                      <!-- <div class="col-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input name="email" type="email" class="form-control shadow-none" required> 
                      </div> -->
                      <div class="col-6 mb-3">
                        <label class="form-label fw-bold">Phone No.</label>
                        <input name="phonenum" type="text" class="form-control shadow-none" required pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number" placeholder="Enter phone number">
                     </div>
                     <div class="col-6 mb-3">
                       <label class="form-label fw-bold">Password</label>
                       <input name="system_pass" type="password" class="form-control shadow-none" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Password must contain at least one number, one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long" placeholder="Enter password">
                     </div>
                      <!-- <div class="col-12 mb-2">
                        <label class="form-label fw-bold">Confirm Password</label>
                        <input name="cpass" type="password" class="form-control shaodw-none" required>
                      </div> -->
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" min="1" class="btn btn-dark custom-bg text-white shadow-none">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>


    <?php require('inc/scripts.php'); ?>

    <script src="scripts/admins.js"></script>
</body>
</html>