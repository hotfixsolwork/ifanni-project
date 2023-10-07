<?php
session_start();
include 'header.php';
// Include your database connection file
include('db_connection.php');

// Ensure that the session is started

// Check if the service-provider_id session variable is set
if (isset($_SESSION['service-provider_id'])) {
    $id = $_SESSION['service-provider_id'];

    // Fetch service provider data from the database, including the company name and ID
    $sql = "SELECT sp.*, c.id AS company_id, c.name AS company_name
            FROM service_provider sp
            INNER JOIN company c ON sp.company_id = c.id
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
        $companyName = $row['company_name'];
        $company_id = $row['company_id']; // This will be used to preselect the company in the select input
    } else {
        echo "Service Provider not found.";
    }

    // Fetch the list of companies from the database
    $sqlCompanies = "SELECT * FROM company";
    $resultCompanies = $conn->query($sqlCompanies);

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the session variable is not set or the user is not logged in
    // You can redirect the user to the login page or take appropriate action here
    // For now, let's assume service-provider_id is not set
    $id = null;
}
?> <!-- partial -->

        <div class="page-content">
          
          <div class="row">
            <div class="col-md-6 mx-auto">
            <h4 class="mt-3 mb-3">Profile</h4>
           
             <div class="card">
              <div class="card-body">
                  <?php if (isset($successMessage)) : ?>
                        <div class="alert alert-success"><?php echo $successMessage; ?></div>
                    <?php endif; ?>
                    <?php if (isset($errorMessage)) : ?>
                        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                    <?php endif; ?>
                  <form method="post" id="update-profile-form" action="update_profile.php">
                      <div class="row">
                        <div class="col-md-12 mx-auto">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="mb-3">
                                <label class="form-label">Your Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Your Name"
                                    id="service_provider_name"
                                    name="service_provider_name"
                                    value="<?php echo $serviceproviderName; ?>"
                                />
                                <div class="validation-message" id="name-error" style="display: none">
                                    Name is required and must be at least 5 characters.
                                </div>
                              </div>
                              
                              <div class="mb-3">
                                <label class="form-label">Phone </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Phone Number"
                                    id="service_provider_phone"
                                    name="service_provider_phone"
                                    value="<?php echo $serviceproviderPhone; ?>"
                                    
                                />
                                <div class="validation-message" id="phone-error" style="display: none">
                                    Please enter a valid phone number.
                                </div>
                              </div>
                              <div class="mb-3">
                              <label for="company_id">Company:</label>
                                <select id="company_id" name="company_id"  class="js-example-basic-single form-select"
                                        data-width="100%">
                                    <?php
                                    // Loop through the list of companies and create options
                                    if ($resultCompanies->num_rows > 0) {
                                        while ($rowCompany = $resultCompanies->fetch_assoc()) {
                                            $selected = ($rowCompany['id'] == $company_id) ? 'selected' : '';
                                            echo '<option value="' . $rowCompany['id'] . '" ' . $selected . '>' . $rowCompany['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select><br>
                                
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Address </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Your Address"
                                    id="service_provider_address"
                                    name="service_provider_address"
                                    value="<?php echo $serviceproviderAddress; ?>"
                                    
                                />
                                <div class="validation-message" id="address-error" style="display: none">
                                    Address is required and must be between 5 and 100 characters.
                                </div>
                              </div>
                              
                              <div class="col-sm-12">
                                <div class="mb-3">
                                  <label class="form-label">Description</label>
                                  <textarea
                                      class="form-control"
                                      rows="3"
                                      id="service_provider_about"
                                      name="service_provider_about"
                                  ><?php echo $serviceproviderAbout; ?></textarea>
                                  <div class="validation-message" id="about-error" style="display: none">
                                      Description must be between 25 and 500 characters.
                                  </div>
                                </div>
                              </div>


                            </div>

                          </div>
                        </div> 
                        <div id="submit-now">
                          <button type="submit" class="btn btn-primary submit">
                            Update Profile
                          </button>
                          <div style="display:none" id="loading">
                            <img style="width: 50px" src="loader.gif" alt="Loading..." />
                          </div>
                        </div>
                      </div>
                      
                      
                      
                      
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
    <!-- Add this JavaScript code to your edit_profile.php page -->
  <!-- Add this JavaScript code to your edit_profile.php page, just before the closing </body> tag -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Form element
        var form = document.getElementById('update-profile-form');

        // Input elements
        var serviceproviderNameInput = document.getElementById('service_provider_name');
        var serviceproviderPhoneInput = document.getElementById('service_provider_phone');
        var serviceproviderAddressInput = document.getElementById('service_provider_address');
        var serviceproviderAboutInput = document.getElementById('service_provider_about');

        // Validation messages
        var nameErrorMessage = document.getElementById('name-error');
        var phoneErrorMessage = document.getElementById('phone-error');
        var addressErrorMessage = document.getElementById('address-error');
        var aboutErrorMessage = document.getElementById('about-error');

        // Event listener for form submission
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Clear previous validation messages
            clearValidationMessages();

            // Validate client name
            var serviceproviderName = serviceproviderNameInput.value.trim();
            if (serviceproviderName.length < 5) {
                displayValidationMessage(nameErrorMessage, 'Name is required and must be at least 5 characters.');
                serviceproviderNameInput.focus();
                return false;
            }
            // Validate client address
            var serviceproviderAddress = serviceproviderAddressInput.value.trim();
            if (serviceproviderAddress.length < 20 || serviceproviderAddress.length > 300) {
                displayValidationMessage(addressErrorMessage, 'Address must be between 20 and 300 characters.');
                clientAddressInput.focus();
                return false;
            }
             // Validate client about
            var serviceproviderAbout = serviceproviderAboutInput.value.trim();
            if (serviceproviderAbout.length < 25 || serviceproviderAbout.length > 500) {
                displayValidationMessage(aboutErrorMessage, 'About must be between 25 and 500 characters.');
                serviceproviderAboutInput.focus();
                return false;
            }

            
            // For example, you can validate client phone, address, and about fields.

            // Disable the submit button and change its text while submitting
            var submitButton = document.querySelector('.submit');
            var loadingIndicator = document.getElementById('loading');
            submitButton.disabled = true;
            submitButton.textContent = 'Updating...';

            // Display the loading indicator
            loadingIndicator.style.display = 'block'; // Show the loading indicator

            // Submit the form
            form.submit();
        });

        function displayValidationMessage(element, message) {
            element.textContent = message;
            element.style.color = 'red';
            element.style.display = 'block';
        }

        function clearValidationMessages() {
            var validationMessages = [nameErrorMessage, phoneErrorMessage, addressErrorMessage, aboutErrorMessage];
            validationMessages.forEach(function (element) {
                if (element) {
                    element.textContent = '';
                    element.style.display = 'none';
                }
            });
        }
    });
</script>



    <!-- End custom js for this page -->
  </body>
</html>
