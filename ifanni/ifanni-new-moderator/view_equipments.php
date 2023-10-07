<?php
include 'header.php';
require_once("ajax/db_connection.php");

if (isset($_GET['id'])) {
    $service_provider_id = $_GET['id'];
    // Now you have the service provider's ID, and you can use it in your queries or logic.
} else {
    echo "Service provider ID is missing in the URL.";
}

// Define the folder path where equipment images are stored
$imageFolderPath = "../ifanni-service-provider/equipment_uploads/";

?>
<!-- partial -->
<div class="page-content">
    <h4 class="mt-3 mb-3 mx-3">Service Provider and Equipment</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Service Provider Name</th>
                                <th class="text-center">Service Provider Email</th>
                                <th class="text-center">Service Provider Phone</th>
                                <th class="text-center">View Equipment Images </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Check if service_provider_id is set in the GET data
                            if (isset($service_provider_id)) {
                                // Fetch service provider data
                                $sql_provider = "SELECT * FROM service_provider WHERE id = $service_provider_id";
                                $result_provider = $conn->query($sql_provider);

                                if ($result_provider->num_rows > 0) {
                                    $row_provider = $result_provider->fetch_assoc();
                                    $service_provider_name = $row_provider['service_provider_name'];
                                    $service_provider_email = $row_provider['service_provider_email'];
                                    $service_provider_phone = $row_provider['service_provider_phone'];

                                    // Fetch equipment images for the specified service provider
                                    $sql_images = "SELECT * FROM service_provider_equipment_images WHERE service_provider_id = $service_provider_id";
                                    $result_images = $conn->query($sql_images);

                                    if ($result_images->num_rows > 0) {
                                        while ($row_images = $result_images->fetch_assoc()) {
                                            $image_id = $row_images['id'];
                                            $image_url = $imageFolderPath . $row_images['images'];

                                            echo "<tr>";
                                            echo "<td class='text-center'>$service_provider_id</td>";
                                            echo "<td class='text-center'>$service_provider_name</td>";
                                            echo "<td class='text-center'>$service_provider_email</td>";
                                            echo "<td class='text-center'>$service_provider_phone</td>";
                                            echo "<td class='text-center'>";
                                                if (file_exists($image_url)) {
                                                   // echo "<img src='$image_url' alt='Equipment Image' width='100'><br>";
                                                    echo "<a href='view_equipment_images.php?image_url=$image_url' class='btn btn-primary'>View Images</a>";
                                                } else {
                                                    echo "<p>Image not found</p>";
                                                }
                                                echo "</td>";

                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td class='text-center'>$service_provider_id</td>";
                                        echo "<td class='text-center'>$service_provider_name</td>";
                                        echo "<td class='text-center'>$service_provider_email</td>";
                                        echo "<td class='text-center'>$service_provider_phone</td>";
                                        echo "<td class='text-center'>No images found</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>Service Provider not found.</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>Service provider ID is missing in the request.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- partial:partials/_footer.html -->
<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
    <p class="text-muted mb-1 mb-md-0">
        Copyright © 2022
        <a href="https://www.ifanni" target="_blank">Ifanni.sa</a>.
    </p>
</footer>
<!-- partial -->
<script src="assets/vendors/core/core.js"></script>
<script src="assets/vendors/feather-icons/feather.min.js"></script>
	<script src="assets/js/template.js"></script>
<script src="assets/vendors/prismjs/prism.js"></script>
	<script src="assets/vendors/clipboard/clipboard.min.js"></script>
    


</div>
</div>
</html>
