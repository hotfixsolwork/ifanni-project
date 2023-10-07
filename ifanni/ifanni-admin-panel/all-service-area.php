n<?php
include 'header.php';
require_once("ajax/db_connection.php");
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3 mx-3">All Service Area</h4>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title d-flex justify-content-end mb-3">
                    <a href="add-new-service-area.php">
                      <button class="btn btn-primary me-2">
                        <i data-feather="plus"></i>All Service Area
                      </button>
                    </a>
                  </h6>

                  <div class="table-responsive">
                  <table id="dataTableExample" class="table table-bordered">
                      <thead>
                          <tr>
                              <th class="text-center">ID</th>
                              <th class="text-center">Service Area</th>
                              <th class="text-center">Service City</th>
                              <th class="text-center">Country Name</th>
                              <th class="text-center">Create Date</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody id="countryTableBody">
                                <?php
                              
                                // SQL query to retrieve service cities with country names
                                $sql = "
                              SELECT sa.id, sa.service_area, c.name AS country_name, sc.service_city, sa.create_date
                              FROM service_areas sa
                              INNER JOIN countries c ON sa.country_id = c.id
                              INNER JOIN service_cities sc ON sa.service_city_id = sc.id
                          ";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $row["id"] . "</td>";
                                        echo "<td class='text-center'>" . $row["service_area"] . "</td>";
                                        echo "<td class='text-center'>" . $row["service_city"] . "</td>";
                                        echo "<td class='text-center'>" . $row["country_name"] . "</td>";
                                        echo "<td class='text-center'>" . $row["create_date"] . "</td>";
                                        echo "<td class='text-center'>
                                                <button class='btn btn-primary me-2'><i data-feather='edit'></i></button>
                                                <button class='btn btn-danger me-2'><i data-feather='trash'></i></button>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No service cities found.</td></tr>";
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
    
    
    
    <!-- End custom js for this page -->
    
  </body>
</html>
