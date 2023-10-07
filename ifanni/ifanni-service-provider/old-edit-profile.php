<?php
include 'header.php';

// Include your database connection file
include('db_connection.php');

$id = $_SESSION['service-provider_id'];

// Define variables to store updated data
$serviceproviderName = $serviceproviderEmail = $serviceproviderPhone = $serviceproviderAddress = $serviceproviderAbout = '';
$companyName = ''; // Only the company name is needed

// Fetch service provider data from the database
$sql = "SELECT sp.*, c.name AS category_name, c.id AS category_id, comp.name AS company_name, comp.id AS company_id
        FROM service_provider sp
        INNER JOIN categories c ON sp.category_id = c.id
        LEFT JOIN company comp ON sp.company_id = comp.id
        WHERE sp.id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the service provider data as an associative array
    $row = $result->fetch_assoc();
    $serviceproviderName = $row['service_provider_name'];
    $serviceproviderEmail = $row['service_provider_email'];
    $serviceproviderPhone = $row['service_provider_phone'];
    $serviceproviderAddress = $row['service_provider_address'];
    $serviceproviderAbout = $row['service_provider_about'];
    $categoryName = $row['category_name'];
    $companyId = $row['company_id'];
    $companyName = $row['company_name'];
} else {
    echo "Service Provider not found.";
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated data from the form
    $serviceproviderName = $_POST['service_provider_name'];
    $serviceproviderEmail = $_POST['service_provider_email'];
    $serviceproviderPhone = $_POST['service_provider_phone'];
    $serviceproviderAddress = $_POST['service_provider_address'];
    $serviceproviderAbout = $_POST['service_provider_about'];
    $selectedCompanyId = $_POST['company_id']; // Use the name attribute 'company_id' from your HTML form

    // Update the service provider data, including the 'company_id'
    $updateServiceproviderSQL = "UPDATE service_provider SET
        service_provider_name = '$serviceproviderName',
        service_provider_email = '$serviceproviderEmail',
        service_provider_phone = '$serviceproviderPhone',
        service_provider_address = '$serviceproviderAddress',
        service_provider_about = '$serviceproviderAbout',
        company_id = '$selectedCompanyId' -- Update the 'company_id' with the selected 'company_id'
        WHERE id = $id";

    // Attempt to execute the service provider update query
    if ($conn->query($updateServiceproviderSQL) === TRUE) {
        echo "Service provider data updated successfully.";
    } else {
        echo "Error updating service provider data: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>



<!-- Add the HTML form for updating service provider and company details -->
<div class="page-content">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h4 class="mt-3 mb-3">Update Profile</h4>
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <!-- Service Provider Details -->
                        <div class="mb-3">
                            <label class="form-label">Service Provider Name</label>
                            <input type="text" class="form-control" name="service_provider_name" value="<?php echo $serviceproviderName; ?>">
                        </div>
                        <!--<div class="mb-3">
                            <label class="form-label">Service Provider Email</label>
                            <input type="text" class="form-control" name="service_provider_email" value="<?php echo $serviceproviderEmail; ?>">
                        </div>-->
                        <div class="mb-3">
                            <label class="form-label">Service Provider Phone</label>
                            <input type="text" class="form-control" name="service_provider_phone" value="<?php echo $serviceproviderPhone; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service Provider Address</label>
                            <input type="text" class="form-control" name="service_provider_address" value="<?php echo $serviceproviderAddress; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Service Provider About</label>
                            <textarea class="form-control" name="service_provider_about"><?php echo $serviceproviderAbout; ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <select
                                id="company_id"
                                name="company_id"
                                class="js-example-basic-single form-select"
                                data-width="100%"
                                required
                            >
                                <option value="">Select a company</option>
                                                                <?php
                                        // Fetch company names from the database and populate the options
                                        $companies = DB::query("SELECT * FROM company");
                                        foreach ($companies as $company) {
                                            $companyId = $company['id'];
                                            $companyName = $company['name'];
                                            $selected = ($companyId == $selectedCompanyId) ? "selected" : ""; // Replace $selectedCompanyId with the selected company's ID
                                            echo '<option value="' . $companyId . '" ' . $selected . '>' . $companyName . '</option>';
                                        }
                                        ?>
                            </select>
                        </div>
                       
                           
                           
                           
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update Profile</button>
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
    <!-- endinject -->
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
