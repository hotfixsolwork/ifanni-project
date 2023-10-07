<?php
include 'header.php';
require_once("ajax/db_connection.php");
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3 mx-3">All Reponse From Service Provider</h4>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h6 class="card-title d-flex justify-content-end mb-3">
                    
                    <button id="exportCsvBtn"  class="btn btn-primary me-2">Export to CSV</button>
                  </h6>

                  <div class="table-responsive">
                  <table id="dataTableExample" class="table table-bordered">
                      <thead>
                          <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Job Title</th>
                          <th class="text-center">Service Provider Name</th>
                          <th class="text-center">Service Provider Email</th>
                          <th class="text-center">Service Provider Phone</th>
                          <!-- <th class="text-center">Service Provider Address</th> -->
                          <th class="text-center">Price Quote By Service Provider</th>
                          <th class="text-center">Job Status</th>
                          <th class="text-center">Vew Details</th>
                          
                          <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody id="countryTableBody">
                                <?php
                              
                                
                                $sql = "SELECT m.id, cj.job_title, m.details, m.job_status , m.price_quote_by_service_provider, sp.service_provider_name,sp.service_provider_email,sp.service_provider_phone,sp.service_provider_address
                                    FROM moderator_job_response_notification m
                                    INNER JOIN client_job cj ON m.job_id = cj.id
                                    INNER JOIN service_provider sp ON m.service_provider_id = sp.id
                                    ORDER BY m.id DESC";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                  $customId = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $customId . "</td>";
                                        // echo "<td class='text-center'>" . $row["id"] . "</td>";
                                        echo "<td class='text-center'>" . $row["job_title"] . "</td>";
                                        echo "<td class='text-center'>" . $row["service_provider_name"] . "</td>";
                                        echo "<td class='text-center'>" . $row["service_provider_email"] . "</td>";
                                        echo "<td class='text-center'>" . $row["service_provider_phone"] . "</td>";
                                        // echo "<td class='text-center'>" . $row["service_provider_address"] . "</td>";
                                        echo "<td class='text-center'>" . $row["price_quote_by_service_provider"] . "</td>";
                                        echo "<td class='text-center'>" . $row["job_status"] . "</td>";


                                        echo "<td class='text-center'>
                                        <a href='view-response-form-service-provider.php?view_id=".$row["id"]."' class='btn btn-success me-3 mb-2'><i data-feather='eye'></i></a>";
                                            echo "<td class='text-center'>
                                                
                                            <button class='btn btn-danger me-2'><i data-feather='trash'></i></button>
                                        </td>";
                                        echo "</tr>";
                                        $customId++;
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
    
    
    
    <script>
        document.getElementById("exportCsvBtn").addEventListener("click", function () {
            exportTableToCSV('dataTable.csv');
        });

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll('table tr');
            
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll('td, th');
                
                for (var j = 0; j < cols.length; j++) {
                    row.push(cols[j].innerText);
                }
                
                csv.push(row.join(','));
            }

            // Download the CSV file
            var csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
            var downloadLink = document.createElement('a');
            downloadLink.href = URL.createObjectURL(csvFile);
            downloadLink.download = filename;
            downloadLink.style.display = 'none';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    </script>
    
  </body>
</html>
