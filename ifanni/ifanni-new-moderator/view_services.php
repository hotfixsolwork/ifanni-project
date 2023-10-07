<?php
include 'header.php';
require_once("ajax/db_connection.php");

if (isset($_GET['id'])) {
    $service_provider_id = $_GET['id'];
    // Now you have the service provider's ID, and you can use it in your queries or logic.
} else {
    echo "Service provider ID is missing in the URL.";
}
?>
<!-- partial -->
<div class="page-content">
    <h4 class="mt-3 mb-3 mx-3">All Service</h4>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableExample3" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Service Provider Name</th>
                                    <th class="text-center">Service Provider Email</th>
                                    <th class="text-center">Service Provider Phone</th>
                                    <th class="text-center">Service Name</th>
                                    <th class="text-center">Service Detail</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="countryTableBody">
                            <?php
                                // Check if service_provider_id is set in the GET data
                                if (isset($service_provider_id)) {
                                    // Fetch service provider data
                                    $sql_provider = "SELECT * FROM service_provider WHERE id = $service_provider_id";
                                    $result_provider = $conn->query($sql_provider);

                                    if ($result_provider->num_rows > 0) {
                                        $row_provider = $result_provider->fetch_assoc();
                                        $service_provider_name = $row_provider['service_provider_name'];
                                        $service_provider_email = $row_provider['service_provider_email'];
                                        $service_provider_phone = $row_provider['service_provider_phone'];

                                        // Fetch service data for the specified service provider
                                        $sql_services = "SELECT * FROM service_provider_service WHERE service_provider_id = $service_provider_id";
                                        $result_services = $conn->query($sql_services);

                                        // Output data of each service provider and associated services
                                        while ($row_services = $result_services->fetch_assoc()) {
                                            $service_provider_service_id = $row_services['id'];
                                            $serviceTitle = $row_services['service_title'];
                                            $description = $row_services['description'];

                                            echo "<tr>";
                                            echo "<td class='text-center'>$service_provider_service_id</td>";
                                            echo "<td class='text-center'>$service_provider_name</td>";
                                            echo "<td class='text-center'>$service_provider_email</td>";
                                            echo "<td class='text-center'>$service_provider_phone</td>";
                                            echo "<td class='text-center'>$serviceTitle</td>";
                                            echo "<td class='text-center'>$description</td>";
                                            echo "<td class='text-center'><a href='view-service-detail.php?sps_id=$service_provider_service_id' class='btn btn-success me-3 mb-2'><i data-feather='eye'></i></a><button class='btn btn-danger me-2'><i data-feather='trash'></i></button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>Service Provider not found.</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center'>Service provider ID is missing in the request.</td></tr>";
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
<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
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
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#dataTableExample3')) {
            // Destroy the existing DataTable
            $('#dataTableExample3').DataTable().destroy();
        }
        $('#dataTableExample3').DataTable({
            "order": [
                [0, "desc"]
            ] // 0 represents the first column (ID) in the table
            // Add other DataTable options here
        });
    });
</script>

<!-- End custom js for this page -->

</body>

</html>
