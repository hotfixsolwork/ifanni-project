<?php
include 'header.php';
require_once("ajax/db_connection.php");
?>
<!-- partial -->
<div class="page-content">
    <h4 class="mt-3 mb-3 mx-3">All Service</h4>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title d-flex justify-content-end mb-3">
                        <a href="add-service.php">
                            <button class="btn btn-primary me-2">
                                <i data-feather="plus"></i>Create New Service
                            </button>
                        </a> 
                        <button id="exportCsvBtn"  class="btn btn-primary me-2">Export to CSV</button>
                    </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Service Title</th>
                                    <th class="text-center">Service Categories</th>
                                    <!-- <th class="text-center">Country</th> -->
                                    <th class="text-center">View Details</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="countryTableBody">
                                <?php
                                // SQL query to retrieve service cities with country names
                                $sql = "SELECT
                                        s.id AS id,
                                        s.service_title,
                                        c.name AS category_name,
                                        co.name AS country_name,
                                        ci.service_city AS city_name
                                    FROM service_provider_service AS s
                                    LEFT JOIN categories AS c ON s.category_id = c.id
                                    LEFT JOIN countries AS co ON s.country_id = co.id
                                    LEFT JOIN service_cities AS ci ON s.city_id = ci.id
                                    ORDER BY s.id DESC"; // Order by the actual database ID in descending order

                                $result = $conn->query($sql);
                                $customId = 1; // Initialize the custom ID
                                if ($result->num_rows > 0) {
                                    $customId= 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $customId . "</td>";
                                        // echo "<td class='text-center'>" . $row["id"] . "</td>";
                                        // echo "<td class='text-center'>" . $row["service_title"] . "</td>";
                                        echo "<td class='text-center'>" . (strlen($row["service_title"]) > 20 ? substr($row["service_title"], 0, 20) . '...' : $row["service_title"]) . "</td>";
                                        echo "<td class='text-center'>" . ($row["category_name"] ? $row["category_name"] : "No categories available") . "</td>";
                                       // echo "<td class='text-center'>" . ($row["country_name"] ? $row["country_name"] : "No Country available") . "</td>";
                                        // Check if there are images associated with the job
                                       // if (!empty($row["images"])) {
                                        //    $images = explode(",", $row["images"]);
                                         //   echo "<td class='text-center'>";
                                         //   foreach ($images as $image) {
                                               
                                           //     echo "<img src='job_uploads/" . $image . "' width='100' height='100' alt='Image'>";
                                           // }
                                           // echo "</td>";
                                       // } else {
                                       //     echo "<td class='text-center'>No images available</td>";
                                       // }
                                       echo "<td class='text-center'>
                                        <a href='view-service.php?id=" . $row["id"] . "' class='btn btn-success me-3 mb-2'><i data-feather='eye'></i></a>
                                                
                                            </td>";
                                        echo "<td class='text-center'>
                                        <a href='edit-service.php?id=" . $row["id"] . "' class='btn btn-success me-3 mb-2'><i data-feather='edit'></i></a>
                                                <button class='btn btn-danger me-2'><i data-feather='trash'></i></button>
                                            </td>";
                                        echo "</tr>";
                                        $customId++;
                                        
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>No service cities found.</td></tr>";
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
    class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
    <p class="text-muted mb-1 mb-md-0">
        Copyright © 2022
        <a href="https://www.ifanni" target="_blank">Ifanni.sa</a>.
    </p>
</footer>
<!-- partial -->

<script src="assets/vendors/core/core.js"></script>
<script src="assets/vendors/feather-icons/feather.min.js"></script>
<script src="assets/js/template.js"></script>
<script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
<script src="assets/js/data-table.js"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="assets/js/dashboard-light.js"></script>
<script>
    $(document).ready(function () {
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
