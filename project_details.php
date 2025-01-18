<?php

require_once "./config/constant.php";
require_once "./config/database_helper.php";


require "vendor/autoload.php";
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
$project_id = $_GET['id'];

#Qr generating code
$text = "http://kavya-gallery.myartsonline.com/project_details.php?id=$project_id";
$qr_code = new QrCode($text);
$writer = new PngWriter();
$temp = "qr/";
$file_name = "$project_id.png";
$file_path = $temp . $file_name;
$result = $writer->write($qr_code);
$result->saveToFile($file_path);

$image_code = "<img src='".$file_path."' />";

$conn_obj = establish_connection();

$project_folder_path = PROJECT_FOLDER . "/" . $project_id;

$select_qry = " SELECT * FROM projects WHERE project_id = $project_id ";
$project_details = get_table_data(
    $conn_obj,
    $select_qry
);
$project_details = $project_details[0];
$list_image = scandir($project_folder_path);

?>



<?php
require_once "./include/header.php";
require_once "./include/nav.php";
?>

<main class="main">
    <section id="gallery-details" class="gallery-details section">
        <div class="container" data-aos="fade-up">
            <h2 class="text-center"> <?= $project_details['project_name']; ?>'s details</h2>
            <br>
            <div class="row justify-content gy-3 mt-3">
                <div class="col-lg-4">
                    <div class="portfolio-info">

                        <ul>
                            <li><strong>Location</strong> <?= $project_details['project_location']; ?></li>
                            <li><strong>Address</strong> <?= $project_details['project_address']; ?></li>

                            <!-- <li><strong>Google Map</strong> <?= $project_details['google_map']; ?></li> -->

                            <li><strong>Type</strong> <?= $project_details['project_type']; ?></li>

                            <li><strong>Details</strong> <?= $project_details['project_details']; ?></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="portfolio-info">

                        <ul>
                            <!-- <li><strong>Project Plan</strong> <?= $project_details['project_plan']; ?></li> -->
                            <!-- <li><strong>3D walkthrough </strong> <?= $project_details['3D_walkthrough']; ?></li> -->
                            <li><strong>Team size</strong> <?= $project_details['project_teamsize']; ?></li>
                            <li><strong>Timeline</strong> <?= $project_details['project_timeline']; ?></li>
                            <li><strong>Cuurent state</strong> <?= $project_details['project_cuurent_state']; ?></li>
                            <li><strong>Budget</strong> <?= $project_details['project_budget']; ?></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="portfolio-info">
                        <ul>
                            <li><a href="https://www.youtube.com/watch?v=dOUQiRifTHw&t=1s"
                                    class="btn-visit  glightbox align-self-start">Project Walkthrough</a></li>
                            <li>
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3670.828820587801!2d70.13410297594304!3d23.066736514677494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3950b98def573eaf%3A0xcdb2a71b5bea626f!2sKavya%20Interior!5e0!3m2!1sen!2sin!4v1737177107563!5m2!1sen!2sin"
                                    width="350" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Title -->
    <!-- End Page Title -->

    <div class="container">
        <hr>
    </div>

    <section id="gallery" class="gallery section">

        <div class="container">

            <div class="row gy-4 justify-content-center">
                <?php
                // style='min-height:200px;max-height:200px;min-width:300px;max-width:300px;'
                foreach ($list_image as $image) {
                    if ($image != "." && $image != "..") {
                        echo "
                            <div class='col-xs-12 col-sm-12 col-md-3'>
                            <div class='gallery-item'>
                                <img src='$project_folder_path/$image' class='img-fluid image-resize'>
                            
                                <div class='gallery-links d-flex align-items-center justify-content-center'>
                                    <a href='$project_folder_path/$image' class='glightbox preview-link'><i class='bi bi-arrows-angle-expand'></i></a>
                                </div>
                            </div>
                            
                            </div><!-- End Gallery Item -->
                            ";
                    }
                }
                ?>
            </div>

        </div>

    </section><!-- /Gallery Section -->


</main>




<?php
require_once "./include/footer.php";
?>