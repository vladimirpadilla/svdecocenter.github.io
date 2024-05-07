<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <?php require('links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - ABOUT</title>
    <style>
        .box{
            border-top-color: var(--teal) !important;
        }
    </style>
</head>
<body class="bg-light"> 

  <?php require('header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
    The SVD Laudato Si’ Farm, affectionately known as SVD FARM, spans six hectares of lush eco-agricultural land, established by the SVD Tagaytay Community with a vision inspired by Pope Francis' encyclical, Laudato Si’.
    Drawing from this visionary document, we embrace a holistic approach to sustainable development, focusing on farming, energy, water, livelihood, knowledge, and lifestyle.
    Aligned with the fourth dimension of SVD identity—to promote Justice, Peace, and Integrity of Creation—our farm endeavors to create a welcoming environment that nurtures spiritual well-being, community connections, and harmony with nature.
    Beyond being a mere agricultural venture, SVD FARM is envisioned as a sanctuary where individuals can find solace, inspiration, and a sense of belonging. Our goal is to extend this ethos of hospitality and sustainability, encouraging replication and adoption within the Society of the Divine Word. Welcome to SVD FARM, where the beauty of creation and the spirit of compassion converge.
    </p>
  </div>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">MISSION</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
    Strengthen the spiritual welfare of guests and employees through its solemn ambience and liturgical services.
    Help uplift the economic condition of surrounding communities through livelihood and training programs.
    Promote organic farming through optimal and sustainable use of technology, resources, and capability building.
    </p>
  </div>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">VISION</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
    We aspire to become a unique spiritual haven where one can commune with God, others, and nature, while relishing totally organic products.
    </p>
  </div>
  
  <!-- <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>

  <div class="container px-4">
    <div class="swiper-container mySwiper">
      <div class="swiper-wrapper mb-5">
        <?php 
          $about_r = selectAll('team_details');
          $path=ABOUT_IMG_PATH;
          while($row = mysqli_fetch_assoc($about_r)){
            echo<<<data
              <div class="swiper-slide">
                <img src="$path$row[picture]" class="w-75">
                <h5 class="mt-2">$row[name]</h5>
              </div>
            data;
          }
        ?>
        
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div> -->

  <?php require('footer.php'); ?>

  <!-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: -75,
        pagination: {
          el: ".swiper-pagination",
        },
        breakpoints:{
          320:{
            slidesPerView: 1,
          },
          640:{
            slidesPerView: 1,
          },
          768:{
            slidesPerView: 3,
          },
          1024:{
            slidesPerView: 3,
          },
        }
      });
    </script>
   -->



   <script>
    var date = new Date();
    var tdate = date.getDate();
    var month = date.getMonth() + 1; //4
    if(tdate < 10){
      tdate = '0' + tdate;
    }
    if(month < 10){
      month = '0' + month;
    }
    var year = date.getUTCFullYear();
    var minDate = year + "-" + month + "-" + tdate; 
    document.getElementById("checkin").setAttribute('min', minDate)
    document.getElementById("checkout").setAttribute('min', minDate)
  </script>
				
			
    </div>	
  </div>
  </body>
</html>