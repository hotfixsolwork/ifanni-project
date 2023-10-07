<?php
include 'header.php';
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3 mx-3">All Invoices</h4>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  

                  <div class="table-responsive">
                    <table id="job dataTableExample" class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Job Title</th>
                          <!-- <th class="text-center">Category</th> -->
                         
                          <!-- <th class="text-center">Deadline Date</th> -->
                          <!-- <th class="text-center">Job Type</th> -->
                       
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!--<tr>
                          <td class="py-1 text-center">
                            <img
                              src="http://via.placeholder.com/36x36"
                              alt="image"
                            />
                          </td>
                          <td class="text-center">Mechanical Equipment Faul</td>
                          <td class="text-center">Electronices</td>
                          <td class="text-center">SAR 400</td>
                          <td class="text-center">Active</td>
                          <td class="text-center">Offline</td>
                          <td class="text-center">
                            <button class="btn btn-primary me-2">
                              <i data-feather="edit"></i>
                            </button>
                            <button class="btn btn-info me-2">
                              <i data-feather="eye"></i>
                            </button>
                            <button class="btn btn-danger me-2">
                              <i data-feather="trash"></i>
                            </button>
                          </td>
                        </tr>-->
                        <tr>
                        <?php
                            showjob();
                          ?>
                        </tr>
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
<?php
function showjob()
{

    $datas  = DB::query("select * from invoice where client_id = '".$_SESSION['client_id']."'");
    if(DB::count() > 0)
    {
        foreach($datas as $data)
        {
            $id = $data['id'];
            $job_id = $data['job_id'];

            $getJobtitle1 = DB::queryFirstRow("select * from client_job where id = '$job_id'");
            $getJobtitle = $getJobtitle1['job_title'];
       
           


            echo"<tr><th class='text-center' scope='row'>$id</th>

                <td class='text-center'>$getJobtitle</td>
               
                <td class='text-center'>
                <a href='view-invoice-detail.php?invoice_id=$id' class='btn btn-success me-3 mb-2'>View Invoice</a>
              </td>
               
                </tr>";


        }
    }
    else
    {
        echo "0 results";
    }
}
function validation($var)
{
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}




 ?> 
