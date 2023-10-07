<?php
include 'header.php';
require_once("ajax/db_connection.php");
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3 mx-3">All Complete Jobs</h4>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!--<h6 class="card-title d-flex justify-content-end mb-3">
                    <a href="add-new-service-area.php">
                      <button class="btn btn-primary me-2">
                        <i data-feather="plus"></i>All Jobs
                      </button>
                    </a>
                  </h6>-->
                  <div class="table-responsive">
                  <table id="dataTableExample" class="table table-bordered">
                      <thead>
                          <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Job Title</th>
                          <th class="text-center">Client Name</th>
                          <!-- <th class="text-center">Job Budget</th> -->
                          <th class="text-center">Client Email</th>
                          <!-- <th class="text-center">Client Phone</th> -->
                          <!-- <th class="text-center">Client Address</th> -->
                          <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody id="jobTableBody">
                                <?php
                              
                                // SQL query to retrieve service cities with country names
                                $sql = "
                                    SELECT j.id, j.job_title, j.budget, c.client_name AS client_name, c.client_email AS client_email, c.client_phone AS client_phone, c.client_adress AS client_adress
                                    FROM client_job j
                                    INNER JOIN clients c ON j.client_id = c.id
                                    WHERE j.job_status = 3
                                ";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $row["id"] . "</td>";
                                        echo "<td class='text-center'>" . $row["job_title"] . "</td>";
                                        echo "<td class='text-center'>" . $row["client_name"] . "</td>";
                                        // echo "<td class='text-center'>" . $row["budget"] . "</td>";
                                        echo "<td class='text-center'>" . $row["client_email"] . "</td>";
                                        // echo "<td class='text-center'>" . $row["client_phone"] . "</td>";
                                        // echo "<td class='text-center'>" . $row["client_adress"] . "</td>";
                                        echo "<td class='text-center'>
                                        <a href='view-complete-job.php?id=".$row["id"]."' class='btn btn-primary me-3 mb-2'><i data-feather='eye'></i></a>
                                                <button class='btn btn-danger me-2'><i data-feather='trash'></i></button>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No Cancelled Job found.</td></tr>";
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
