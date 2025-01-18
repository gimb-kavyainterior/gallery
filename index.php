<?php
require_once "./config/constant.php";
require_once "./config/database_helper.php";

$conn_obj = establish_connection();

$select_qry = " SELECT project_id, project_name, project_location FROM projects ";
$project_list = get_table_data(
  $conn_obj,
  $select_qry
);


# PREPARING PROJECTS FOR HTML : START
$project_list_html = "";
foreach ($project_list as $project) {

  $project_id = $project[0];
  $project_name = $project[1];
  $project_location = $project[2];

  $project_folder = "./" . PROJECT_FOLDER . "/$project_id";
  $list_images = scandir($project_folder);
  $first_file = $list_images[2];
  $project_image = $project_folder . '/' . $first_file;

  $project_list_html = $project_list_html . "
                <div class='col-xs-12 col-sm-12 col-md-4'>
                <a href='project_details.php?id=$project_id'>
                  <div class='gallery-item project-list'>
                    <img src='$project_image' class='img-fluid project-image-resize'>
                    <div class='gslide-description description-bottom'>
                            <h4 class='custom-text'>$project_name ($project_location)</h4>
                    </div>

                  </div>
                  </a>
                </div><!-- End Gallery Item -->";
}
# PREPARING PROJECTS FOR HTML : END


?>

<?php
require_once "./include/header.php";
require_once "./include/nav.php";
?>


<main class="main">

  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Projects</h1>
          </div>
        </div>
      </div>
    </div>

  </div><!-- End Page Title -->
  <hr>

  <!-- Gallery Section -->
  <section id="gallery" class="gallery section">

    <div class="container">

      <div class="row justify-content-center">
        <?= $project_list_html; ?>
      </div>



    </div>

  </section><!-- /Gallery Section -->

</main>


<?php
require_once "./include/footer.php";
?>