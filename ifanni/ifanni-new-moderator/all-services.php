<?php
include 'header.php';
require_once("ajax/db_connection.php");
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3 mx-3">All Services</h4>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                  <div class="table-responsive">
                  <table id="dataTableExample" class="table table-bordered">
                      <thead>
                          <tr>
                          <th class="text-center">ID</th>
                                    <th class="text-center">Service Title</th>
                                    <th class="text-center">Description</th>
                                    <!-- <th class="text-center">Category</th> -->
                                    <!-- <th class="text-center">Country</th> -->
                                    <!-- <th class="text-center">City</th> -->
                                    <th class="text-center">Service Provider</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody id="countryTableBody">
                                <?php
                              
                                
                              $sql = "SELECT 
                              sps.id AS sps_id,
                              sps.service_title,
                              sps.description,
                              cat.name AS category,
                              cou.name AS country,
                              cit.service_city AS city,
                              
                              sp.service_provider_name,
                              sp.service_provider_email,
                              sp.service_provider_phone
                          FROM service_provider_service AS sps
                          INNER JOIN categories AS cat ON sps.category_id = cat.id
                          INNER JOIN countries AS cou ON sps.country_id = cou.id
                          INNER JOIN service_cities AS cit ON sps.city_id = cit.id
                          INNER JOIN service_provider AS sp ON sps.service_provider_id = sp.id
                          order by sps.id DESC";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                  $customId = 1; // Initialize the custom ID
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $customId . "</td>";
                                        echo "<td class='text-center'>" . $row["service_title"] . "</td>";
                                        echo "<td class='text-center'>" . (strlen($row["description"]) > 25 ? substr($row["description"], 0, 25) . '...' : $row["description"]) . "</td>";

                                        // echo "<td class='text-center'>" . $row["category"] . "</td>";
                                        // echo "<td class='text-center'>" . $row["country"] . "</td>";
                                        // echo "<td class='text-center'>" . $row["city"] . "</td>";
                                        echo "<td class='text-center'>" . $row["service_provider_name"] . "</td>";
                                        echo "<td class='text-center'>" . $row["service_provider_phone"] . "</td>";
                                         echo "<td class='text-center'>
                                                <a href='view-service-detail.php?sps_id=" . $row["sps_id"] . "' class='btn btn-primary me-3 mb-2'>View Detail</a>
                                            </td>";

                                        echo "</tr>";
                                        $customId++;
                                    }
                                } else {
                                    echo "<tr><td colspan='8' class='text-center'>No Service Providers found.</td></tr>";
                                }

                                // Close the database connection
                                $conn->close();
                                ?>
                        </tbody>
                  </table>
                    
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
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    <script>
        $(document).ready(function()
        {
        if ($.fn.DataTable.isDataTable('#dataTableExample3')) {
            // Destroy the existing DataTable
            $('#dataTableExample3').DataTable().destroy();
        }
        $('#dataTableExample3').DataTable({
            "order": [[0, "desc"]] // 0 represents the first column (ID) in the table
            // Add other DataTable options here
        });
        });
</script>
    
    <!-- End custom js for this page -->
    
  </body>
</html>
