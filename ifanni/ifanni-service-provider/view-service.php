<?php
include 'header.php';

// Include your database connection file
include('db_connection.php');

// Get the service_id from the URL
if (isset($_GET['id'])) {
    $serviceId = $_GET['id'];

    // SQL query to retrieve service details based on service_id
    $sql = "SELECT s.service_title, s.category_id, s.country_id, s.city_id, s.description, c.name AS category_name, co.name AS country_name, ci.service_city AS city_name
            FROM service_provider_service AS s
            LEFT JOIN categories AS c ON s.category_id = c.id
            LEFT JOIN countries AS co ON s.country_id = co.id
            LEFT JOIN service_cities AS ci ON s.city_id = ci.id
            WHERE s.id = $serviceId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data as an associative array
        $row = $result->fetch_assoc();

        // Now you can access the fields from your tables
        $serviceTitle = $row['service_title'];
        $categoryName = $row['category_name'];
        $countryName = $row['country_name'];
        $cityName = $row['city_name'];
        $description = $row['description'];

        // Additional processing and HTML code to display the details
    } else {
        echo "Service not found.";
    }
} else {
    echo "Missing service_id in the URL.";
}

// Close the database connection
$conn->close();
?>


<!-- partial -->
<div class="page-content">


    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5>View Service Details</h5>
                </div>
                
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class=" mb-4">

                            <div class="">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input
                                        
                                            type="text"
                                            class="form-control"
                                            placeholder="Enter Job Title"
                                            disabled
                                            value="<?php echo $serviceTitle; ?>"
                                        />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <input
                                        
                                            type="text"
                                            class="form-control"
                                            placeholder="Enter Job Title"
                                            disabled
                                            value="<?php echo $categoryName; ?>"
                                        />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <input
                                        
                                            type="text"
                                            class="form-control"
                                            placeholder="Enter Job Title"
                                            disabled
                                            value="<?php echo $countryName; ?>"
                                        />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input
                                        
                                            type="text"
                                            class="form-control"
                                            placeholder="Enter Job Title"
                                            disabled
                                            value="<?php echo $cityName; ?>"
                                        />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea
                                                class="form-control"
                                                rows="3"
                                                disabled
                                            ><?php echo $description; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- partial:partials/_footer.html -->
    <footer
        class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small"
    >

    </footer>
    <!-- partial -->
</div>
</div>

<!-- core:js -->
<script src="assets/vendors/core/core.js"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
<script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="assets/vendors/feather-icons/feather.min.js"></script>
<script src="assets/js/template.js"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="assets/js/dashboard-light.js"></script>
<script src="assets/js/sweet-alert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>
</html>





