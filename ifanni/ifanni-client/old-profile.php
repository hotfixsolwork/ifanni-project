<?php
include 'header.php';

// Include your database connection file
include('assets/db/db_connection.php');

$id = $_SESSION['client_id'];

// Define variables to store updated data
$clientName = $clientEmail = $clientPhone = $clientAddress = $clientAbout = '';

// Fetch client data from the database
$sql = "SELECT c.*, cl.client_name, cl.client_email, cl.client_phone, cl.client_adress, cl.client_about
FROM clients cl
INNER JOIN categories c ON cl.category_id = c.id
WHERE cl.id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the client data as an associative array
    $row = $result->fetch_assoc();
    $clientName = $row['client_name'];
    $clientEmail = $row['client_email'];
    $clientPhone = $row['client_phone'];
    $clientAddress = $row['client_adress'];
    $clientAbout = $row['client_about'];
    $categoryName = $row['name'];
} else {
    echo "Client not found.";
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated data from the form
    $clientName = $_POST['client_name'];
    $clientPhone = $_POST['client_phone'];
    $clientAddress = $_POST['client_adress'];
    $clientAbout = $_POST['client_about'];

    // Perform database update
    $sqlUpdate = "UPDATE clients SET
    client_name = '$clientName',
    client_phone = '$clientPhone',
    client_adress = '$clientAddress',
    client_about = '$clientAbout'
    WHERE id = $id";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>
        <!-- partial -->

        <div class="page-content">
          
          <div class="row">
            <div class="col-md-6 mx-auto">
            <h4 class="mt-3 mb-3">Profile</h4>
           
             <div class="card">
              <div class="card-body">
                  <form method="post"  id="update-profile-form">
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
                                    id="client_name"
                                    name="client_name"
                                    value="<?php echo $clientName; ?>"
                                />
                              </div>
                              
                              <div class="mb-3">
                                <label class="form-label">Phone </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Phone Number"
                                    id="client_phone"
                                    name="client_phone"
                                    value="<?php echo $clientPhone; ?>"
                                    
                                />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Address </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Your Address"
                                    id="client_adress"
                                    name="client_adress"
                                    value="<?php echo $clientAddress; ?>"
                                    
                                />
                              </div>
                              
                              <div class="col-sm-12">
                                <div class="mb-3">
                                  <label class="form-label">Description</label>
                                  <textarea
                                      class="form-control"
                                      rows="3"
                                      id="client_about"
                                      name="client_about"
                                  ><?php echo $clientAbout; ?></textarea>
                                </div>
                              </div>


                            </div>

                          </div>
                        </div> 
                        <button type="submit" class="btn btn-primary submit">
                        Update Profile
                      </button>
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

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
