  <nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $settings_r['site_title'] ?></a>
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link me-2" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="rooms.php">Rooms</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link me-2" href="facilities.php">Facilities</a>
          </li> -->
          <li class="nav-item">
          <a class="nav-link me-2" href="contact.php">Contact us</a>
          </li>
          <li class="nav-item">
          <a class="nav-link me-2" href="about.php">About</a>
          </li>
        </ul>
        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3" data-bs-toggle="modal" data-bs-target="#bookModal">
        Book Now
      </button> 

        <div class="d-flex">
          <?php 
            if(isset($_SESSION['login']) && $_SESSION['login']==true)

            {
              $path = USERS_IMG_PATH;
              echo<<<data
                <div class="btn-group">
                  <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <img src="$path$_SESSION[uPic]" style="width: 25px; height: 25px;" class="me-1">
                    $_SESSION[uName]
                  </button>
                  <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
                </div>
              data;
            }
            else{
              echo<<<data
                <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                  Login
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                  Register
                </button>
              data;
            }
          ?>
        </div>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="login-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-person-circle fs-3 me-2"></i> Guest Login
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="mb-3">
              <label class="form-label">Email / Mobile</label>
              <input type="text" name="email_mob" required class="form-control shadow-none">
            </div>
            <div class="mb-4">
              <label class="form-label">Password</label>
              <input type="password" name="pass" required class="form-control shadow-none">
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
              <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
              <button type="button" class="btn text-secondary text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">
                Forgot Password?
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="register-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-person-lines-fill fs-3 me-2"></i> Guest Registration
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span class="badge rounded-pill text-dark mb-3 text-wrap lh-base">
              Note: Please provide the following details to complete your registration:
            </span>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Name:</label>
                  <input name="name" type="text" class="form-control shadow-none" placeholder="Your Full name" required>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Email:</label>
                  <input name="email" type="email" class="form-control shadow-none" placeholder="Your Email Address">
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Phone Number:*</label>
                  <input name="phonenum" type="number" class="form-control shadow-none" placeholder="Contact Number" required>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Picture(Optional)</label>
                  <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none">
                </div>
                <div class="col-md-12 p-0 mb-3">
                  <label class="form-label">Address:</label>
                  <textarea name="address" class="form-control shadow-none" placeholder="Your resedential address" rows="1" required></textarea>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Zipcode:</label>
                  <input name="pincode" type="number" class="form-control shadow-none" placeholder="Zipcode" required>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Date of birth:</label>
                  <input name="dob" type="date" class="form-control shadow-none" placeholder="Date of birth" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Password:</label>
                  <input name="pass" type="password" class="form-control shadow-none" placeholder="Password" required>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Confirm Password:</label>
                  <input name="cpass" type="password" class="form-control shadow-none" placeholder="Confirm password" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center my-1">
              <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="forgot-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-person-circle fs-3 me-2"></i> Forgot Password
            </h5>
          </div>
          <div class="modal-body">
            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
              Note: A link  will be sent your sent to your email to reset your password!
            </span>
          <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="text" name="email" required class="form-control shadow-none">
            </div>
            <div class="mb-2 text-end">
              <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                CANCEL
              </button>
              <button type="submit" class="btn btn-dark shadow-none">SEND LINK</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Booking Modal -->
  <div class="modal fade" id="bookModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="book-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> Booking Details
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php 
                    // Check if the user is logged in
                    if(isset($_SESSION['login']) && $_SESSION['login']==true) {
                        // If logged in, show booking form
                        echo '
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name*</label>
                                    <input name="name" type="text" class="form-control shadow-none" placeholder="Enter your name" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Room Name*</label>
                                <select name="room_name" class="form-select shadow-none" required>
                                <option value="">Select Room</option>
                                <!-- Add options dynamically here -->
                                <option value="Earth-View Cabins">Earth-View Cabins</option>
                                <option value="Treehouse Retreats">Treehouse Retreats</option>
                                <option value="Riverfront Cottages">Riverfront Cottages</option>
                                <!-- Add more options as needed -->
                                </select>
                              </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control shadow-none" placeholder="Enter your email" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input name="phonenum" type="number" class="form-control shadow-none" placeholder="Enter your phone number" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Checkin</label>
                                    <input type="date" class="form-control shadow-none" id="checkin" placeholder="Select check-in date" required>
                                </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">TIME-IN</label>
                                    <input type="time" class="form-control shadow-none" id="in" placeholder="Select time-in" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Checkout</label>
                                    <input type="date" class="form-control shadow-none" id="checkout" placeholder="Select check-out date" required>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">TIME-OUT</label>
                                    <input type="time" class="form-control shadow-none" id="out" placeholder="Select time-out" required>
                                </div>
                            </div>
                        </div>';
                    } else {
                        // If not logged in, prompt user to log in
                        echo '
                        <p class="text-danger">You need to be logged in to book a room.</p>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <?php 
                    // Check if the user is logged in
                    if(isset($_SESSION['login']) && $_SESSION['login']==true) {
                        // If logged in, show book now button
                        echo '
                        <div class="text-center my-1">
                            <button type="submit" class="btn btn-dark shadow-none">BOOK NOW</button>
                        </div>';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

