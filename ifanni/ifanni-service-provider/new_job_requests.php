<?php
include 'header.php';
require_once("db_connection.php");
$service_provider_id = $_SESSION['service-provider_id'];
// PHP code to fetch clients from the database
$query = "
    SELECT spn.id, spn.service_provider_id, spn.job_id, spn.text, cj.job_title
    FROM service_provider_new_job_request AS spn
    JOIN client_job AS cj ON spn.job_id = cj.id
    WHERE spn.service_provider_id = ".$service_provider_id." order by spn.id DESC
";
$result = $conn->query($query);



// Close the database connection

?>
<!-- partial -->
<div class="page-content">
    <h4 class="mt-3 mb-3 mx-3">New Job Requests</h4>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!--<h6 class="card-title d-flex justify-content-end mb-3">
                      <a href="add-country.php">
                        <button class="btn btn-primary me-2">
                          <i data-feather="plus"></i>All country
                        </button>
                      </a>
                    </h6>-->

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Job Title</th>
                                <th class="text-center">Details from Moderator</th>
                                <th class="text-center">Job Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody id="countryTableBody">
                            <?php
                            if ($result->num_rows > 0) {
                                $customId = 1; // Initialize the custom ID
                                while ($row = $result->fetch_assoc()) {

                                    $query1 = "SELECT * FROM moderator_job_response_notification WHERE job_id = '".$row['job_id']."' AND service_provider_id = '$service_provider_id' LIMIT 1";
                                    $result1 = $conn->query($query1);

                                    $job_status = "Pending";
                                    if ($result1 && $result1->num_rows > 0) {
                                        $row1 = $result1->fetch_assoc();

                                        // Now you can access all the column values like this:

                                        $job_status = $row1['job_status'];
                                        //found

                                    }
                                    else{
                                        $job_status = "Pending";
                                    }

                                    echo "<tr>";
                                   
                                    echo "<td class='text-center'>" . $customId . "</td>";
                                    echo "<td class='text-center'>" . $row['job_title'] . "</td>";
                                    echo "<td class='text-center'>" . $row['text'] . "</td>";
                                    echo "<td class='text-center'><b>" . strtoupper($job_status) . "</b></td>";

                                    echo "<td class='text-center'>
                          <a href='view-details-job.php?id=" . $row['job_id'] . "' class='btn btn-primary'>View Details</a>
      
                         
                        </td>";
                                    echo "</tr>";
                                    $customId++;
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No UnRead Jobs found!</td></tr>";
                            }
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
