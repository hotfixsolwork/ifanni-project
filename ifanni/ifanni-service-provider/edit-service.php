<?php
include 'header.php';
require_once("ajax/db_connection.php");

if (isset($_GET['id'])) {
    $serviceId = $_GET['id'];

    // Query to retrieve service details by ID
    $sql = "SELECT * FROM service_provider_service WHERE id = $serviceId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign retrieved data to variables
        $category_id = $row['category_id'];
        $country_id = $row['country_id'];
        $city_id = $row['city_id'];
        $service_name = $row["service_title"];
        $service_details = $row["description"];
        

        
    }
} else {
    echo "Service ID not provided.";
}

// Close the database connection
$conn->close();
?>

<!-- Rest of your HTML code for the edit-service.php page -->



<!-- Your HTML form for updating service data -->
<div class="page-content">
    <h4 class="mt-3 mb-3">Update Service</h4>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                <form id="update-service-form" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Service Name</label>
                                    <input
                                        id="service_title"
                                        name="service_title"
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter Service Title"
                                        value="<?php echo $service_name; ?>"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <!-- Row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea
                                        class="form-control"
                                        name="description"
                                        id="description"
                                        rows="10"
                                    ><?php echo $service_details; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <select
                                        id="country_id"
                                        name="country_id"
                                        class="js-example-basic-single form-select"
                                        data-width="100%"
                                        required
                                    >
                                        <?php
                                        // Fetch countries from the database and populate the options
                                        $sql_countries = "SELECT * FROM countries";
                                        $result_countries = $conn->query($sql_countries);

                                        if ($result_countries->num_rows > 0) {
                                            while ($row_country = $result_countries->fetch_assoc()) {
                                                $selected = ($row_country['id'] == $country_id) ? 'selected' : '';
                                                echo '<option value="' . $row_country['id'] . '" ' . $selected . '>' . $row_country['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select
                                        id="category_id"
                                        name="category_id"
                                        class="js-example-basic-single form-select"
                                        data-width="100%"
                                        required
                                    >
                                        <?php
                                        // Fetch categories from the database and populate the options
                                        $sql_categories = "SELECT * FROM categories";
                                        $result_categories = $conn->query($sql_categories);

                                        if ($result_categories->num_rows > 0) {
                                            while ($row_category = $result_categories->fetch_assoc()) {
                                                $selected = ($row_category['id'] == $category_id) ? 'selected' : '';
                                                echo '<option value="' . $row_category['id'] . '" ' . $selected . '>' . $row_category['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <select
                                        id="city_id"
                                        name="city_id"
                                        class="js-example-basic-single form-select"
                                        data-width="100%"
                                        required
                                    >
                                        <?php
                                        // Fetch cities from the database and populate the options
                                        $sql_cities = "SELECT * FROM service_cities";
                                        $result_cities = $conn->query($sql_cities);

                                        if ($result_cities->num_rows > 0) {
                                            while ($row_city = $result_cities->fetch_assoc()) {
                                                $selected = ($row_city['id'] == $city_id) ? 'selected' : '';
                                                echo '<option value="' . $row_city['id'] . '" ' . $selected . '>' . $row_city['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Row -->
                        <button type="submit" class="btn btn-primary submit">
                            Update Service
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

 

        <!-- partial:partials/_footer.html -->
        <footer
          class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small"
        >
          <p class="text-muted mb-1 mb-md-0">
            Copyright © 2022
            <a href="https://www.ifanni" target="_blank">Ifanni.sa</a>.
          </p>
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
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- <script src="assets/js/pickr.js"></script> -->
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/vendors/easymde/easymde.min.js"></script>
    <script src="assets/js/easymde.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->
    <!-- <script src="job_validation.js"></script> -->
    <!-- JavaScript to dynamically display image previews -->
<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
  </body>
</html>
