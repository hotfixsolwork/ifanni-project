<?php
include 'header.php';
require_once("ajax/db_connection.php");
?>
<!-- partial -->
<div class="page-content">
    <h4 class="mt-3 mb-3 mx-3">All Jobs</h4>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title d-flex justify-content-end mb-3">
                        <a href="add-job.php">
                            <button class="btn btn-primary me-2">
                                <i data-feather="plus"></i>Create New Job
                            </button>
                        </a>
                    </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-bordered">
                            <thead class ="">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Job Title</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">View Detail</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="countryTableBody">
                                <?php
                                // SQL query to retrieve service cities with country names
                                $sql = "SELECT c.id, c.job_title, c.description, GROUP_CONCAT(cf.files) AS images, GROUP_CONCAT(jc.name) AS categories
                                    FROM client_job c
                                    LEFT JOIN client_job_files cf ON c.id = cf.job_id
                                    LEFT JOIN categories jc ON c.category_id = jc.id
                                    GROUP BY c.id
                                    order by c.id DESC
                                    ";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $customId = 1; // Initialize the custom ID
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $customId . "</td>";
                                        echo "<td class='text-center'>" . $row["job_title"] . "</td>";
                                        // echo "<td class='text-center'>" . $row["description"] . "</td>";
                                        echo "<td class='text-center'>" . (strlen($row["description"]) > 20 ? substr($row["description"], 0, 20) . '...' : $row["description"]) . "</td>";
                                        // echo "<td class='text-center'>" . ($row["categories"] ? $row["categories"] : "No categories available") . "</td>";
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
                                        <a href='view-job-detail.php?job_id=" . $row["id"] . "' class='btn btn-success me-3'><i data-feather='eye'></i></a>
                                               
                                            </td>";
                                        echo "<td class='text-center'>
                                        <a href='edit-job.php?job_id=" . $row["id"] . "' class='btn btn-success me-3'><i data-feather='edit'></i></a>
                                        <a href='remove-job.php?remove_id=" . $row["id"] . "' class='btn btn-danger me-3'><i data-feather='trash'></i></a>

                                                
                                            </td>";
                                        echo "</tr>";
                                        $customId++;
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>No Job found.</td></tr>";
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
<style>
    /* Add borders to the table */
.table-bordered {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ddd; /* Border color for the entire table */
}

/* Add borders to table header cells */
.table-bordered thead th {
    border: 1px solid #ddd; /* Border color for table header cells */
}

/* Add borders to table body cells */
.table-bordered tbody td {
    border: 1px solid #ddd; /* Border color for table body cells */
}

/* Add borders to table footer cells (if applicable) */
.table-bordered tfoot td {
    border: 1px solid #ddd; /* Border color for table footer cells */
}

</style>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
</body>
</html>
